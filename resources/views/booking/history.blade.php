@extends('layouts.app')

@section('title', 'Booking History')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    <h1 class="text-3xl font-bold text-green-700 mb-6 text-center">Your Booking History</h1>

    @if($bookings->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow">
                <thead>
                    <tr class="bg-green-600 text-white text-left">
                        <th class="py-3 px-4">Futsal Name</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4">Start Time</th>
                        <th class="py-3 px-4">End Time</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $booking->futsal->name }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                            <td class="py-3 px-4">
                                @if($booking->status === 'pending')
                                    <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full text-sm">Pending</span>
                                @elseif($booking->status === 'booked')
                                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-sm">Booked</span>
                                @elseif($booking->status === 'cancelled')
                                    <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-sm">Cancelled</span>
                                @elseif($booking->status === 'completed')
                                    <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-sm">Completed</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-700 text-center mt-6">You have not made any bookings yet.</p>
    @endif
</div>
@endsection
