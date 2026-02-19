<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                // Staff login: verify user actually has doctor role
                if ($user->role !== 'doctor') {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return back()->withErrors([
                        'staff_email' => 'You do not have doctor access.',
                    ])->onlyInput('email', 'login_type');
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
        ])->onlyInput('email', 'login_type');
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
