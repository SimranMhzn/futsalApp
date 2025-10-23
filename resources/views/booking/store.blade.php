@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden text-center p-8">
        {{-- Success Icon --}}
        <div class="flex justify-center mb-6">
            <div class="bg-green-100 text-green-600 rounded-full p-4">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-12 w-12" 
                     fill="none" 
                     viewBox="0 0 24 24" 
                     stroke="currentColor" 
                     stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        {{-- Heading --}}
        <h1 class="text-3xl font-bold text-green-700 mb-2">Booking Confirmed! 🎉</h1>
        <p class="text-gray-600 mb-8">
            Your futsal booking has been successfully recorded.  
            We’ll notify you if there are any updates regarding your booking.
        </p>

        {{-- Booking Summary --}}
        <div class="bg-gray-50 rounded-lg p-6 text-left mx-auto max-w-md">
            <h2 class="font-semibold text-green-600 text-lg mb-3">Booking Details</h2>
            <div class="space-y-2 text-gray-700">
                <p><span class="font-medium">🏟️ Futsal:</span> {{ $booking->futsal->name }}</p>
                <p><span class="font-medium">📍 Location:</span> {{ $booking->futsal->location }}</p>
                <p><span class="font-medium">📅 Date:</span> {{ \Carbon\Carbon::parse($booking->date)->format('F j, Y') }}</p>
                <p><span class="font-medium">⏰ Time:</span> {{ $booking->start_time }}:00 - {{ $booking->end_time }}:00</p>
                <p><span class="font-medium">💰 Price:</span> Rs. {{ number_format($booking->futsal->price) }} / hour</p>
                <p><span class="font-medium">📌 Status:</span> 
                    <span class="text-yellow-600 capitalize">{{ $booking->status }}</span>
                </p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('futsal.index') }}" 
               class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                🔙 Back to Futsals
            </a>
            <a href="{{ route('user.bookings') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-lg transition">
                📋 View My Bookings
            </a>
        </div>
    </div>
</div>
@endsection
