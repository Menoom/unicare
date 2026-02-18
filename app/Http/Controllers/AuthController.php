<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Mail\DoctorOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $isStaff = $request->input('login_type') === 'staff';

        // Use different error bag keys so patient/staff errors don't clash
        if ($isStaff) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ], [], [
                'email' => 'staff_email',
                'password' => 'staff_password',
            ]);
        } else {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($isStaff) {
                // Staff login: verify user actually has doctor or admin role
                $role = $request->input('role', 'doctor');
                if ($user->role !== $role) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    $errorKey = $isStaff ? 'staff_email' : 'email';
                    return back()->withErrors([
                        $errorKey => 'You do not have ' . $role . ' access.',
                    ])->onlyInput('email', 'login_type', 'role');
                }

                return redirect()->intended('doctor-dashboard');
            }

            // Patient login: verify user has patient role
            if ($user->role !== 'patient') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Please use the Staff Portal to login.',
                ])->onlyInput('email', 'login_type');
            }

            return redirect()->intended('dashboard');
        }

        $errorKey = $isStaff ? 'staff_email' : 'email';
        return back()->withErrors([
            $errorKey => 'The provided credentials do not match our records.',
        ])->onlyInput('email', 'login_type', 'role');
    }

    /**
     * Show the registration form
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Handle doctor registration — Step 1: Validate form, send OTP to email
     */
    public function registerDoctor(Request $request)
    {
        $validated = $request->validate([
            'doc_name' => ['required', 'string', 'max:255'],
            'doc_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'doc_password' => ['required', 'confirmed', Password::defaults()],
            'doc_specialization' => ['required', 'string', 'max:255'],
            'doc_experience_years' => ['required', 'integer', 'min:0'],
            'doc_consultation_fee' => ['required', 'numeric', 'min:0'],
            'doc_job_type' => ['required', 'in:private,hospital_based'],
        ]);

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP + form data + expiry in session
        $request->session()->put('doctor_otp', $otp);
        $request->session()->put('doctor_otp_expires_at', now()->addMinutes(2));
        $request->session()->put('doctor_reg_data', $validated);

        // Send OTP via email
        Mail::to($validated['doc_email'])->send(new DoctorOtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to ' . $validated['doc_email'],
        ]);
    }

    /**
     * Handle doctor registration — Step 2: Verify OTP and create account
     */
    public function verifyDoctorOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $storedOtp = $request->session()->get('doctor_otp');
        $expiresAt = $request->session()->get('doctor_otp_expires_at');
        $regData = $request->session()->get('doctor_reg_data');

        // Check if OTP session data exists
        if (!$storedOtp || !$expiresAt || !$regData) {
            return response()->json([
                'success' => false,
                'message' => 'No OTP session found. Please register again.',
            ], 422);
        }

        // Check if OTP has expired
        if (now()->greaterThan($expiresAt)) {
            return response()->json([
                'success' => false,
                'expired' => true,
                'message' => 'OTP has expired. Please resend a new OTP.',
            ], 422);
        }

        // Check if OTP matches
        if ($request->input('otp') !== $storedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please try again.',
            ], 422);
        }

        // OTP is valid — create the user and doctor profile
        $user = DB::transaction(function () use ($regData) {
            $user = User::create([
                'name' => $regData['doc_name'],
                'email' => $regData['doc_email'],
                'password' => Hash::make($regData['doc_password']),
                'role' => 'doctor',
            ]);

            Doctor::create([
                'user_id' => $user->id,
                'specialization' => $regData['doc_specialization'],
                'experience_years' => $regData['doc_experience_years'],
                'consultation_fee' => $regData['doc_consultation_fee'],
                'job_type' => $regData['doc_job_type'],
            ]);

            return $user;
        });

        // Clear OTP session data
        $request->session()->forget(['doctor_otp', 'doctor_otp_expires_at', 'doctor_reg_data']);

        Auth::login($user);

        return response()->json([
            'success' => true,
            'redirect' => route('doctor.dashboard'),
        ]);
    }

    /**
     * Resend OTP for doctor registration
     */
    public function resendDoctorOtp(Request $request)
    {
        $regData = $request->session()->get('doctor_reg_data');

        if (!$regData) {
            return response()->json([
                'success' => false,
                'message' => 'No registration data found. Please fill the form again.',
            ], 422);
        }

        // Generate new 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Update session
        $request->session()->put('doctor_otp', $otp);
        $request->session()->put('doctor_otp_expires_at', now()->addMinutes(2));

        // Send new OTP via email
        Mail::to($regData['doc_email'])->send(new DoctorOtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'New OTP sent to ' . $regData['doc_email'],
        ]);
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Show dashboard (placeholder)
     */
    public function dashboard()
    {
        return view('dashboard');
    }
}
