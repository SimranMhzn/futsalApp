<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i',
            ],
            'phone' => 'required|digits:10',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
        ], [
            'email.regex' => 'Email must be a valid Gmail address (example@gmail.com).',
            'phone.digits' => 'Phone number must be exactly 10 digits.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role ?? 'user',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('futsals.index');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Check Users table
        $user = \App\Models\User::where('email', $email)->first();
        if ($user && \Hash::check($password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('user.home'); // Redirect regular user
        }

        // Check Futsals table
        $futsal = \App\Models\Futsal::where('email', $email)->first();
        if ($futsal && \Hash::check($password, $futsal->password)) {
            Auth::login($futsal);
            $request->session()->regenerate();
            return redirect()->route('futsal.home'); // Redirect futsal owner
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }

    public function profile()
    {
        return view('profile'); // resources/views/profile.blade.php
    }
}