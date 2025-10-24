@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">

    {{-- Photo Section as Background --}}
    <div class="w-full h-64 lg:h-96 relative rounded-lg overflow-hidden shadow-lg"
        style="background-image: url('{{ $futsal->photo ? asset('storage/' . $futsal->photo) : '/placeholder.png' }}'); 
               background-size: cover; 
               background-position: center;">
        <div class="absolute inset-0  bg-opacity-20 flex flex-col justify-end p-6 rounded-lg">
            <h1 class="text-3xl lg:text-4xl font-bold text-white">{{ $futsal->name }}</h1>
            <p class="text-white mt-1">{{ $futsal->location }}</p>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        {{-- Left Column --}}
        <div class="flex-1 space-y-6">

            {{-- About --}}
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="font-semibold text-green-600 mb-2 text-lg">About This Futsal</h2>
                <p class="text-gray-700 whitespace-pre-line">
                    {{ $futsal->description ?? 'No description available.' }}
                </p>
            </div>

            {{-- Facilities --}}
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="font-semibold text-green-600 mb-2 text-lg">Facilities & Amenities</h2>
                <div class="flex flex-wrap gap-2">
                    @if ($futsal->shower_facility)
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">🚿 Shower Facility</span>
                    @endif
                    @if ($futsal->parking_space)
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">🚗 Parking Space</span>
                    @endif
                    @if ($futsal->changing_room)
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">👕 Changing Room</span>
                    @endif
                    @if ($futsal->restaurant)
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">🍔 Restaurant</span>
                    @endif
                    @if ($futsal->wifi)
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">📶 WiFi</span>
                    @endif
                    @if ($futsal->open_ground)
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">🏞️ Open Ground</span>
                    @endif
                    @if (
                        !$futsal->shower_facility &&
                        !$futsal->parking_space &&
                        !$futsal->changing_room &&
                        !$futsal->restaurant &&
                        !$futsal->wifi &&
                        !$futsal->open_ground)
                        <span class="text-gray-500 italic">No facilities listed.</span>
                    @endif
                </div>
            </div>

            {{-- Contact --}}
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="font-semibold text-green-600 mb-2 text-lg">Contact Information</h2>
                <p><span class="font-semibold">📞 Phone:</span> {{ $futsal->phone }}</p>
                @if ($futsal->email)
                    <p><span class="font-semibold">📧 Email:</span> {{ $futsal->email }}</p>
                @endif
                <p><span class="font-semibold">📍 Location:</span> {{ $futsal->location }}</p>

                {{-- Book Now Button (only for normal users) --}}
                @if (auth()->check() && auth()->user()->role === 'user')
                    <div class="mt-6">
                        <a href="{{ route('booking.create', $futsal->id) }}"
                           class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                            BOOK NOW
                        </a>
                    </div>
                @endif
            </div>

            {{-- Action Buttons (only visible for admins) --}}
            @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="flex gap-2 justify-center">
                    <form action="{{ route('admin.futsals.approve', $futsal->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">
                            Approve
                        </button>
                    </form>
                    <form action="{{ route('admin.futsals.reject', $futsal->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full">
                            Reject
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
