@extends('layouts.app')

@section('title', 'My Booking History')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    <h1 class="text-3xl font-bold text-green-700 mb-6 text-center">Your Futsal Booking History</h1>

    <!-- Search Form for Date -->
    <div class="mb-6 flex justify-between items-center">
        <form method="GET" action="{{ route('booking.history') }}" class="w-full max-w-xs">
            <div class="flex space-x-2">
                <input type="date" name="search_date" id="search_date" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                    value="{{ request('search_date') }}">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Search</button>
            </div>
        </form>
    </div>

    @if($bookings->isEmpty())
        <div class="alert alert-info text-center">No bookings found for the selected date.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow">
                <thead>
                    <tr class="bg-green-600 text-white text-left">
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">User</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4">Start Time</th>
                        <th class="py-3 px-4">End Time</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $index => $booking)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4">{{ $booking->user->name ?? 'Unknown User' }}</td>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
