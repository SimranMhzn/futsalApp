<?php

namespace App\Http\Controllers;

use App\Models\Futsal;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FutsalController extends Controller
{
    /**
     * Show futsals for the logged-in user.
     * Owners → see their futsals.
     * Players → see all futsals available for booking.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'owner') {
            // owner sees only their futsals
            $futsals = $user->futsals()->orderByDesc('created_at')->get();
        } else {
            // player sees all futsals
            $futsals = Futsal::orderByDesc('created_at')->get();
        }

        return view('futsals.index', compact('futsals', 'user'));
    }

    /**
     * Admin dashboard: list all futsals and users.
     */
    public function adminIndex()
    {
        $futsals = Futsal::latest()->get();
        $user = Auth::user();
        $userCount = User::count();

        return view('futsals.adminIndex', compact('futsals', 'user', 'userCount'));
    }

    /**
     * Owners can register a new futsal.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'price'       => 'nullable|numeric',
            'location'    => 'nullable|string|max:255',
            'link'        => 'nullable|url',
            'side_no'     => 'nullable|integer',
            'ground_no'   => 'nullable|integer',
            'description' => 'nullable|string',
            'photo.*'     => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $futsal = new Futsal($validated);
        $futsal->user_id = Auth::id();

        // ✅ Handle amenities (checkboxes → booleans)
        $futsal->shower_facility = $request->has('shower_facility');
        $futsal->parking_space   = $request->has('parking_space');
        $futsal->changing_room   = $request->has('changing_room');
        $futsal->restaurant      = $request->has('restaurant');
        $futsal->wifi            = $request->has('wifi');
        $futsal->open_ground     = $request->has('open_ground');

        // ✅ Handle photo uploads (multiple)
        if ($request->hasFile('photo')) {
            $photos = [];
            foreach ($request->file('photo') as $file) {
                $path = $file->store('futsal_photos', 'public');
                $photos[] = asset('storage/' . $path);
            }
            $futsal->photo = $photos;
        }

        $futsal->save();

        return redirect()->route('futsals.index')->with('success', 'Futsal registered successfully.');
    }

    /**
     * Edit futsal details.
     */
    public function edit(string $id)
    {
        $futsal = Futsal::findOrFail($id);
        return view('futsals.edit', compact('futsal'));
    }

    /**
     * Update futsal details.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'price'       => 'nullable|numeric',
            'location'    => 'nullable|string|max:255',
            'link'        => 'nullable|url',
            'side_no'     => 'nullable|integer',
            'ground_no'   => 'nullable|integer',
            'description' => 'nullable|string',
            'photo.*'     => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $futsal = Futsal::findOrFail($id);
        $futsal->fill($validated);

        // ✅ Update amenities
        $futsal->shower_facility = $request->has('shower_facility');
        $futsal->parking_space   = $request->has('parking_space');
        $futsal->changing_room   = $request->has('changing_room');
        $futsal->restaurant      = $request->has('restaurant');
        $futsal->wifi            = $request->has('wifi');
        $futsal->open_ground     = $request->has('open_ground');

        // ✅ Update photos
        if ($request->hasFile('photo')) {
            $photos = [];
            foreach ($request->file('photo') as $file) {
                $path = $file->store('futsal_photos', 'public');
                $photos[] = asset('storage/' . $path);
            }
            $futsal->photo = $photos;
        }

        $futsal->save();

        return redirect()->route('futsals.index')->with('success', 'Futsal updated successfully.');
    }

    /**
     * Delete futsal.
     */
    public function destroy(string $id)
    {
        $futsal = Futsal::findOrFail($id);
        $futsal->delete();

        return redirect()->route('futsals.index')->with('success', 'Futsal deleted successfully.');
    }

    /**
     * Player books a futsal.
     */
    public function book(Request $request, string $futsalId)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
        ]);

        Booking::create([
            'futsal_id' => $futsalId,
            'user_id'   => Auth::id(),
            'date'      => $request->date,
            'time'      => $request->time,
            'status'    => 'booked',
        ]);

        return redirect()->route('futsals.index')->with('success', 'Booking successful!');
    }

    /**
     * Show bookings of the logged-in player.
     */
    public function myBookings()
    {
        $user = Auth::user();

        if ($user->role !== 'player') {
            abort(403, 'Only players can view bookings.');
        }

        $bookings = $user->bookings()->with('futsal')->orderByDesc('date')->get();

        return view('bookings.index', compact('bookings'));
    }
}
