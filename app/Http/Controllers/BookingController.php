<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Futsal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() && !Auth::guard('futsal')->check()) {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }
    public function create(Futsal $futsal)
    {
        return view('booking.create', compact('futsal'));
    }

    public function store(Request $request)
{
    $request->validate([
        'futsal_id'  => 'required|exists:futsals,id',
        'date'       => 'required|date|after_or_equal:today',
        'start_time' => 'required|date_format:H:i',
        'end_time'   => 'required|date_format:H:i|after:start_time',
    ]);

    if (Auth::guard('futsal')->check()) {
        return redirect()->back()->with('error', 'Futsal accounts cannot make bookings.');
    }

    // Check overlapping bookings
    $isTaken = Booking::where('futsal_id', $request->futsal_id)
        ->where('date', $request->date)
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                  ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('start_time', '<=', $request->start_time)
                        ->where('end_time', '>=', $request->end_time);
                  });
        })
        ->exists();

    if ($isTaken) {
        return redirect()->back()->with('error', 'The selected time slot is not available. Please choose another.');
    }

    Booking::create([
        'futsal_id'  => $request->futsal_id,
        'user_id'    => Auth::id(),
        'date'       => $request->date,
        'start_time' => $request->start_time,
        'end_time'   => $request->end_time,
        'status'     => 'booked',
    ]);

    return redirect()->route('user.home')->with('success', 'Booking successful!');
}


    public function index()
    {
        if (Auth::guard('futsal')->check()) {
            $futsal = Auth::guard('futsal')->user();
            $bookings = Booking::where('futsal_id', $futsal->id)
                ->with('user')
                ->orderBy('date', 'desc')
                ->get();

            return view('futsal.bookings.history', compact('bookings', 'futsal'));
        } else {
            $user = Auth::user();
            $bookings = Booking::where('user_id', $user->id)
                ->with('futsal')
                ->orderBy('date', 'desc')
                ->get();

            return view('booking.history', compact('bookings', 'user'));
        }
    }

    public function futsalHistory()
    {
        $futsal = Auth::guard('futsal')->user();

        $bookings = Booking::where('futsal_id', $futsal->id)
            ->with('user')
            ->orderBy('date', 'desc')
            ->get();

        return view('futsal.bookings.history', compact('bookings', 'futsal'));
    }

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

    public function history()
    {
        $bookings = Auth::user()->bookings()->latest()->get();
        return view('booking.history', compact('bookings'));
    }

    public function update(Request $request, Booking $booking)
{
    $request->validate([
        'date' => 'required|date|after_or_equal:today',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ]);

    // Prevent futsal accounts from updating
    if (Auth::guard('futsal')->check()) {
        return redirect()->back()->with('error', 'Futsal accounts cannot update bookings.');
    }

    // Keep futsal_id before deleting
    $futsalId = $booking->futsal_id;

    if (!$futsalId) {
        return redirect()->back()->with('error', 'Futsal ID is missing. Cannot update booking.');
    }

    // Delete the old booking
    $booking->delete();

    // Check for overlapping bookings
    $exists = Booking::where('futsal_id', $futsalId)
        ->where('date', $request->date)
        ->where(function ($q) use ($request) {
            $q->whereBetween('start_time', [$request->start_time, $request->end_time])
              ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
              ->orWhere(function ($inner) use ($request) {
                  $inner->where('start_time', '<=', $request->start_time)
                        ->where('end_time', '>=', $request->end_time);
              });
        })
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'This time slot is already booked.');
    }

    // Create a new booking with updated times
    Booking::create([
        'futsal_id'  => $futsalId,
        'user_id'    => Auth::id(),
        'date'       => $request->date,
        'start_time' => $request->start_time,
        'end_time'   => $request->end_time,
        'status'     => 'booked',
    ]);

    return redirect()->route('booking.history')
        ->with('success', 'Booking updated successfully (old booking replaced).');
}


}
