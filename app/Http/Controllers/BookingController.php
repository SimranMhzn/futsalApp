<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Futsal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Allow both user and futsal authentication.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() && !Auth::guard('futsal')->check()) {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }

    /**
     * Show booking form for a specific futsal (user side).
     */
    public function create(Futsal $futsal)
    {
        return view('booking.create', compact('futsal'));
    }

    /**
     * Store a new booking (user side).
     */
    public function store(Request $request)
    {
        $request->validate([
            'futsal_id' => 'required|exists:futsals,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|integer|min:0|max:23',
            'end_time' => 'required|integer|gt:start_time',
        ]);

        // Ensure only normal users can create bookings
        if (Auth::guard('futsal')->check()) {
            return redirect()->back()->with('error', 'Futsal accounts cannot make bookings.');
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['start_time'] = sprintf('%02d:00:00', $request->start_time);
        $data['end_time'] = sprintf('%02d:00:00', $request->end_time);
        $data['status'] = 'booked';

        Booking::create($data);

        return redirect()->route('user.home')->with('success', 'Booking successful!');
    }

    /**
     * Show booking history for either a user or a futsal owner.
     * (Automatically detects guard.)
     */
    public function index()
    {
        if (Auth::guard('futsal')->check()) {
            // Futsal side
            $futsal = Auth::guard('futsal')->user();
            $bookings = Booking::where('futsal_id', $futsal->id)
                ->with('user')
                ->orderBy('date', 'desc')
                ->get();

            return view('futsal.bookings.history', compact('bookings', 'futsal'));
        } else {
            // User side
            $user = Auth::user();
            $bookings = Booking::where('user_id', $user->id)
                ->with('futsal')
                ->orderBy('date', 'desc')
                ->get();

            return view('booking.history', compact('bookings', 'user'));
        }
    }

    /**
     * Futsal-specific booking history route (optional if index() auto-detects).
     */
    public function futsalHistory()
    {
        $futsal = Auth::guard('futsal')->user();

        $bookings = Booking::where('futsal_id', $futsal->id)
            ->with('user')
            ->orderBy('date', 'desc')
            ->get();

        return view('futsal.bookings.history', compact('bookings', 'futsal'));
    }

    /**
     * Delete a booking (user side only).
     */
    public function destroy($id)
    {
        if (Auth::guard('futsal')->check()) {
            return redirect()->back()->with('error', 'Futsal accounts cannot delete user bookings.');
        }

        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->delete();

        return redirect()->route('booking.history')->with('success', 'Booking deleted successfully!');
    }

    /**
     * Alternative history method (user only).
     */
    public function history()
    {
        $bookings = Auth::user()->bookings()->latest()->get();
        return view('booking.history', compact('bookings'));
    }

    /**
     * Update an existing booking (user side only).
     */
    public function update(Request $request, $id)
    {
        if (Auth::guard('futsal')->check()) {
            return redirect()->back()->with('error', 'Futsal accounts cannot update user bookings.');
        }

        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|integer|min:0|max:23',
            'end_time' => 'required|integer|gt:start_time',
        ]);

        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->update([
            'date' => $request->date,
            'start_time' => sprintf('%02d:00:00', $request->start_time),
            'end_time' => sprintf('%02d:00:00', $request->end_time),
        ]);

        return redirect()->route('booking.history')->with('success', 'Booking updated successfully!');
    }
}
