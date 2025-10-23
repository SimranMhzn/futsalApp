<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Futsal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Require authentication for all methods.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show booking form for a specific futsal.
     */
    public function create(Futsal $futsal)
    {
        return view('booking.create', compact('futsal'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'futsal_id' => 'required|exists:futsals,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|integer|min:0|max:23',
            'end_time' => 'required|integer|gt:start_time',
        ]);

        // Prepare data array
        $data = $request->all();
        $data['user_id'] = Auth::id(); // manually assign user_id
        $data['start_time'] = sprintf('%02d:00:00', $request->start_time);
        $data['end_time'] = sprintf('%02d:00:00', $request->end_time);
        $data['status'] = 'booked';

        // Create booking
        $booking = Booking::create($data);

        return redirect()->route('user.home')->with('success', 'Booking successful!');
    }


    /**
     * Show all bookings for the logged-in user.
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('futsal')
            ->orderBy('date', 'desc')
            ->get();

        return view('booking.history', compact('bookings'));
    }

    public function destroy($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail(); // Ensure user can only delete their own bookings

        $booking->delete();

        return redirect()->route('booking.history')->with('success', 'Booking deleted successfully!');
    }

}
