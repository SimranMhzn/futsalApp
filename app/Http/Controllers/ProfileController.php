<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Futsal;

class ProfileController extends Controller
{
    public function show()
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
    public function update(Request $request)
    {
        // Detect which guard is active
        $user = Auth::guard('futsal')->check()
            ? Auth::guard('futsal')->user()
            : Auth::user();

        // Determine if futsal or user/admin
        $isFutsal = Auth::guard('futsal')->check();

        // Base validation
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ];

        // Add futsal-specific fields if futsal
        if ($isFutsal) {
            $rules = array_merge($rules, [
                'location' => 'nullable|string|max:255',
                'price' => 'nullable|numeric|min:0',
            ]);
        }

        // Password update rules
        if ($request->filled('new_password')) {
            $rules['current_password'] = 'required|string';
            $rules['new_password'] = 'required|string|min:8|confirmed';
        }

        $validated = $request->validate($rules);

        // Check for duplicate email
        if ($isFutsal) {
            $emailExists = Futsal::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->exists();
        } else {
            $emailExists = User::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->exists();
        }

        if ($emailExists) {
            return back()->with('error', 'Email already exists.');
        }

        // Handle password update
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }

            $user->password = Hash::make($request->new_password);
        }

        // Update common fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Futsal-specific fields
        if ($isFutsal) {
            $user->location = $request->location;
            $user->price = $request->price;

            $user->shower_facility = $request->has('shower_facility');
            $user->parking_space = $request->has('parking_space');
            $user->changing_room = $request->has('changing_room');
            $user->restaurant = $request->has('restaurant');
            $user->wifi = $request->has('wifi');
            $user->open_ground = $request->has('open_ground');
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    // Real-time password validation (for Alpine.js async check)
    public function validatePassword(Request $request)
    {
        $request->validate(['current_password' => 'required|string']);

        $user = Auth::guard('futsal')->check()
            ? Auth::guard('futsal')->user()
            : Auth::user();

        $isValid = Hash::check($request->current_password, $user->password);

        return response()->json(['valid' => $isValid]);
    }
}
