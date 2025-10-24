<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Show profile page
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

    // Validate current password in real-time (AJAX)
    public function validatePassword(Request $request)
    {
        $request->validate(['current_password' => 'required|string']);

        if (Auth::guard('futsal')->check()) {
            $user = Auth::guard('futsal')->user();
        } else {
            $user = Auth::user();
        }

        return response()->json([
            'valid' => Hash::check($request->current_password, $user->password)
        ]);
    }

    // Update profile and facilities
    public function update(Request $request)
    {
        if (Auth::guard('futsal')->check()) {
            $user = Auth::guard('futsal')->user();

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'location' => 'nullable|string|max:255',
                'price' => 'nullable|numeric|min:0',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
                'price' => $request->price,
                'shower_facility' => $request->has('shower_facility'),
                'parking_space' => $request->has('parking_space'),
                'changing_room' => $request->has('changing_room'),
                'restaurant' => $request->has('restaurant'),
                'wifi' => $request->has('wifi'),
                'open_ground' => $request->has('open_ground'),
            ]);
        } else {
            $user = Auth::user();

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
            ]);

            $user->update($request->only(['name', 'email', 'phone']));
        }

        // Password update (if provided)
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Incorrect current password.']);
            }

            $request->validate([
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
