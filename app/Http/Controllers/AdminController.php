<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    /**
     * Store a new doctor (creates user + doctor profile).
     */
    public function storeDoctor(Request $request)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'max:255', 'unique:users,email'],
            'mobile'            => ['required', 'string', 'max:20', 'unique:users,mobile'],
            'password'          => ['required', 'string', 'min:8'],
            'specialization'    => ['required', 'string', 'max:255'],
            'experience_years'  => ['required', 'integer', 'min:0'],
            'consultation_fee'  => ['required', 'numeric', 'min:0'],
            'job_type'          => ['required', 'in:private,hospital_based'],
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'mobile'   => $validated['mobile'],
                'password' => Hash::make($validated['password']),
                'role'     => 'doctor',
            ]);

            Doctor::create([
                'user_id'          => $user->id,
                'specialization'   => $validated['specialization'],
                'experience_years' => $validated['experience_years'],
                'consultation_fee' => $validated['consultation_fee'],
                'job_type'         => $validated['job_type'],
            ]);

            return $user;
        });

        return response()->json([
            'success' => true,
            'message' => 'Doctor account created successfully.',
            'doctor'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
}
