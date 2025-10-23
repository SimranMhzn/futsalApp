<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Futsal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showUserRegistrationForm()
    {
        return view('auth.register_user');
    }


    public function showFutsalRegistrationForm()
    {
        return view('auth.register_futsal');
    }

    public function registerUser(Request $request)
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
        return redirect()->route('user.home')->with('success', 'Account created successfully!');
    }

    public function registerFutsal(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i',
            'phone' => 'required|digits:10',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ], [
            'email.regex' => 'Email must be a valid Gmail address.',
            'phone.digits' => 'Phone number must be exactly 10 digits.',
            'password.regex' => 'Password must contain at least one uppercase, one lowercase, one number, and one special character.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role ?? 'futsal',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('futsal.home');
    }

    public function showUserLoginForm()
    {
        return view('auth.login_user');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('user.home');
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }

    public function showFutsalLoginForm()
    {
        return view('auth.login_futsal');
    }

    public function loginFutsal(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('futsal')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('futsal.home'));
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function profile()
    {
        return view('profile');
    }
}
