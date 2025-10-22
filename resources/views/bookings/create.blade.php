@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    {{-- Photo Section --}}
    <div class="w-full h-64 lg:h-96 relative rounded-lg overflow-hidden shadow-lg">
        <img src="{{ $futsal->photo[0] ?? '/placeholder.png' }}" alt="{{ $futsal->name }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-green-900 bg-opacity-30 flex flex-col justify-end p-6 rounded-lg">
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
                <p class="text-gray-700 whitespace-pre-line">{{ $futsal->description }}</p>
            </div>

            {{-- Features --}}
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="font-semibold text-green-600 mb-2 text-lg">Features & Amenities</h2>
                <div class="flex flex-wrap gap-2">
                    @php
                        $features = ['5-a-side', 'Parking', 'Cafeteria', 'Locker Room'];
                    @endphp
                    @foreach ($features as $feature)
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">{{ $feature }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Pricing --}}
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="font-semibold text-green-600 mb-2 text-lg">Pricing Details</h2>
                <table class="w-full text-left border border-gray-200 rounded">
                    <thead class="bg-green-50">
                        <tr>
                            <th class="py-2 px-3">Day</th>
                            <th class="py-2 px-3">Price (NRs./hour)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pricing = [
                                ['day' => 'Weekdays', 'price' => $futsal->price],
                                ['day' => 'Saturday', 'price' => $futsal->price + 300],
                            ];
                        @endphp
                        @foreach ($pricing as $p)
                        <tr class="border-t border-gray-100">
                            <td class="py-2 px-3">{{ $p['day'] }}</td>
                            <td class="py-2 px-3">{{ number_format($p['price']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Contact --}}
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <h2 class="font-semibold text-green-600 mb-2 text-lg">Contact Information</h2>
                <p><span class="font-semibold">Phone:</span> {{ $futsal->phone }}</p>
                <p><span class="font-semibold">Location:</span> {{ $futsal->location }}</p>
            </div>
        </div>

        {{-- Right Column - Booking Form --}}
        <div class="w-full lg:w-1/3 bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 space-y-4">
            <form action="{{ route('bookings.store', $futsal->id) }}" method="POST">
                @csrf
                <div class="flex justify-between items-center mb-2">
                    <h2 class="font-semibold text-green-600 text-lg">Book Your Slot</h2>
                    <span class="font-bold text-lg">{{ number_format($futsal->price) }} NRs./hour</span>
                </div>

                {{-- Date Picker --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Select Date:</label>
                    <input type="date" name="date" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                {{-- Time Slots --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Select Time:</label>
                    <div class="grid grid-cols-3 gap-2">
                        @php
                            $hours = [
                                "6-7","7-8","8-9","9-10","10-11","11-12",
                                "12-13","13-14","14-15","15-16","16-17","17-18",
                                "18-19","19-20","20-21"
                            ];
                        @endphp
                        @foreach ($hours as $hour)
                        <label class="cursor-pointer bg-green-50 text-green-700 hover:bg-green-100 px-2 py-2 rounded text-sm font-medium flex justify-center items-center">
                            <input type="radio" name="hour" value="{{ $hour }}" class="hidden" required>
                            {{ $hour }}
                        </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full py-3 rounded text-white font-semibold text-lg bg-green-600 hover:bg-green-700 transition-colors duration-200">
                    BOOK NOW
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
