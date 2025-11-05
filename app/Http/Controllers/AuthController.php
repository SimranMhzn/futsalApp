<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Futsal;

class AuthController extends Controller
{
    /** ------------------------------
     *  Registration Forms
     * ------------------------------ */
    public function showUserRegistrationForm()
    {
        return view('auth.register_user');
    }

    public function showFutsalRegistrationForm()
    {
        return view('auth.register_futsal');
    }

    /** ------------------------------
     *  User Registration
     * ------------------------------ */
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
            'password.regex' => 'Password must contain at least one uppercase, one lowercase, one number, and one special character.',
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

    /** ------------------------------
     *  Futsal Registration
     * ------------------------------ */
    public function registerFutsal(Request $request)
    {
        // 1. Validate all fields including hour/minute
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:futsals',
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
            'price' => 'required|numeric',
            'open_time' => 'required',
            'close_time' => 'required',
        ], [
            'email.regex' => 'Email must be a valid Gmail address.',
            'phone.digits' => 'Phone number must be exactly 10 digits.',
            'password.regex' => 'Password must contain at least one uppercase, one lowercase, one number, and one special character.',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        $data['open_time'] .= ':00';
        $data['close_time'] .= ':00';


        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('futsal_photos', 'public');
        }

        // Boolean fields
        $features = ['shower_facility', 'parking_space', 'changing_room', 'restaurant', 'wifi', 'open_ground'];
        foreach ($features as $feature) {
            $data[$feature] = $request->has($feature) ? 1 : 0;
        }

        $data['password'] = Hash::make($data['password']);
        Futsal::create($data);

        return redirect()->route('user.home')
            ->with('success', 'Registration submitted! Wait for admin approval.');
    }

    /** ------------------------------
     *  Login Forms
     * ------------------------------ */
    public function showUserLoginForm()
    {
        return view('auth.login_user');
    }

    public function showFutsalLoginForm()
    {
        return view('auth.login_futsal');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login_admin');
    }

    /** ------------------------------
     *  Login Logic
     * ------------------------------ */
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

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.home');
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
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

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = User::where('email', $request->email)
            ->where('role', 'admin')
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::login($admin);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Welcome, Admin!');
        }

        return back()->withErrors(['email' => 'Invalid credentials or not an admin.'])->withInput();
    }

    /** ------------------------------
     *  Logout
     * ------------------------------ */
    public function logout(Request $request)
    {
        if (Auth::guard('futsal')->check()) {
            Auth::guard('futsal')->logout();
        } else {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /** ------------------------------
     *  Profile
     * ------------------------------ */
    public function profile()
    {
        if (Auth::guard('futsal')->check()) {
            $user = Auth::guard('futsal')->user();
            $roleType = 'futsal';
        } else {
            $user = Auth::user();
            $roleType = 'user';
        }

        return view('profile', compact('user', 'roleType'));
    }
}