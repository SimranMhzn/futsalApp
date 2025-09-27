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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Futsal::create([
            'name'     => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'phone'    => $request->phone,
            'price'    => $request->price,
            'service'  => $request->service,
            'photo'    => $request->photo,
            'user_id'  => Auth::id(), // link to owner
        ]);

        return redirect()->route('futsals.index');
    }

    public function edit(string $id)
    {
        $futsal = Futsal::findOrFail($id);
        return view('futsals.edit', compact('futsal'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $futsal = Futsal::findOrFail($id);

        $futsal->update([
            'name'        => $request->name,
            'location'    => $request->location,
            'description' => $request->description,
            'phone'       => $request->phone,
            'price'       => $request->price,
            'service'     => $request->service,
            'photo'       => $request->photo,
        ]);

        return redirect()->route('futsals.index');
    }

    public function destroy(string $id)
    {
        $futsal = Futsal::findOrFail($id);
        $futsal->delete();

        return redirect()->route('futsals.index');
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
            'user_id'   => Auth::id(), // player
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
