<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Real-time password validation
    public function validatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
        ]);

        // Use the appropriate guard if futsal
        $user = Auth::guard('futsal')->check() ? Auth::guard('futsal')->user() : Auth::user();

        $isValid = Hash::check($request->current_password, $user->password);

        return response()->json(['valid' => $isValid]);
    }

    // Optional: show profile
    public function show()
    {
        $user = Auth::guard('futsal')->check() ? Auth::guard('futsal')->user() : Auth::user();
        $roleType = Auth::guard('futsal')->check() ? 'futsal' : $user->role;

        return view('profile', compact('user', 'roleType'));
    }

    // Optional: update profile
    public function update(Request $request)
    {
        // Your existing update logic here...
    }
}

// Separate controller for User home
class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }
}
