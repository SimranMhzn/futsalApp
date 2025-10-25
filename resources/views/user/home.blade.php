@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="flex flex-col md:flex-row items-center bg-emerald-800 px-8 md:px-14 py-24 text-white text-center md:text-left gap-8">
    <div class="md:w-1/2">
        <h1 class="mb-4 text-3xl font-bold md:text-5xl">Book Your Perfect Futsal Court in Seconds</h1>
        <p class="mb-8 text-lg md:text-xl">
            Find available courts near you and reserve your spot in seconds. No hassle, no waiting.
        </p>
        <a href="{{ route('futsal.index') }}" 
           class="inline-block w-48 rounded-xl border-2 border-white bg-white p-3 text-center font-semibold text-emerald-800 transition-transform hover:scale-105">
           Find Futsals Now
        </a>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20">
    <h2 class="mb-12 text-center text-4xl font-semibold text-gray-900">Why Choose FutsalHub?</h2>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

        <div class="p-6 text-center rounded-2xl bg-white shadow hover:shadow-lg transition">
            <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-2xl font-bold text-white">
                A
            </div>
            <h3 class="mb-2 text-xl font-bold text-green-600">Quick Booking</h3>
            <p>Book your favourite futsal court in less than a minute. No phone calls needed.</p>
        </div>

        <div class="p-6 text-center rounded-2xl bg-white shadow hover:shadow-lg transition">
            <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-2xl font-bold text-white">
                B
            </div>
            <h3 class="mb-2 text-xl font-bold text-green-600">Find Nearby Courts</h3>
            <p>Discover the best futsal courts near your location with real-time availability.</p>
        </div>

        <div class="p-6 text-center rounded-2xl bg-white shadow hover:shadow-lg transition">
            <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-2xl font-bold text-white">
                C
            </div>
            <h3 class="mb-2 text-xl font-bold text-green-600">Verified Venues</h3>
            <p>All futsal courts are verified for quality and facilities. Play with confidence.</p>
        </div>

    </div>
</section>



<!-- How It Works Section -->
<section class="bg-gree-900 px-6 py-20">
    <h2 class="mb-16 text-center text-4xl font-semibold text-white">How It Works</h2>
    <div class="mx-auto grid max-w-6xl grid-cols-1 gap-10 md:grid-cols-3">
        @foreach ([
            ['1', 'Find a Futsal Court', 'Browse futsal courts and filter by location, price, or facilities.'],
            ['2', 'Choose your time slot', 'Select a slot that fits your schedule with real-time availability.'],
            ['3', 'Book & Play', 'Complete your booking with secure payment and get instant confirmation.']
        ] as $step)
        <div class="rounded-2xl bg-white p-8 text-center shadow-md hover:shadow-xl">
            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-2xl font-bold text-white">
                {{ $step[0] }}
            </div>
            <h3 class="mb-3 text-xl font-bold text-green-600">{{ $step[1] }}</h3>
            <p class="text-gray-600">{{ $step[2] }}</p>
        </div>
        @endforeach
    </div>

    <div class="mt-14 flex justify-center">
        <a href="{{ route('futsal.index') }}" 
           class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white shadow-md hover:scale-105 hover:bg-green-700 transition">
           Find a Court Now
        </a>
    </div>
</section>


<!-- Futsal Owner Section -->
<section class="px-6 py-16 text-center">
    <h2 class="mb-4 text-3xl font-bold text-gray-900">Are you a Futsal Owner?</h2>
    <p class="mb-8 text-gray-700">Register your futsal and start getting bookings from players near you!</p>
    <a href="{{ route('register.futsal.form') }}" 
       class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white shadow-md hover:scale-105 hover:bg-green-700 transition">
       Register Your Futsal
    </a>
</section>

<!-- Footer -->
<footer class="bg-green-900 px-8 py-10 text-gray-200">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        <div>
            <h3 class="text-lg font-bold text-white">FutsalHub</h3>
            <p class="mt-2 text-sm">The easiest way to book futsal courts near you. Play more, worry less.</p>
            <div class="mt-4 flex gap-4 text-xl">
                <i class="fab fa-facebook hover:text-white cursor-pointer"></i>
                <i class="fab fa-instagram hover:text-white cursor-pointer"></i>
                <i class="fab fa-twitter hover:text-white cursor-pointer"></i>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-bold text-white">Quick Links</h3>
            <ul class="mt-2 space-y-2 text-sm">
                <li><a href="#" class="hover:underline">Home</a></li>
                <li><a href="{{ route('futsal.index') }}" class="hover:underline">Find Futsals</a></li>
                <li><a href="#" class="hover:underline">About Us</a></li>
                <li><a href="#" class="hover:underline">Contact</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-lg font-bold text-white">Contact Us</h3>
            <ul class="mt-2 space-y-2 text-sm">
                <li>Kathmandu, Nepal</li>
                <li>info@futsalhub.app</li>
                <li>+977 9800000000</li>
            </ul>
        </div>
    </div>

    <div class="mt-8 border-t border-gray-500 pt-4 flex flex-col md:flex-row justify-between text-sm text-gray-300">
        <p>© 2025 FutsalHub. All rights reserved.</p>
        <div class="mt-2 flex gap-4 md:mt-0">
            <a href="#" class="hover:underline">Privacy Policy</a>
            <a href="#" class="hover:underline">Terms of Service</a>
        </div>
    </div>
</footer>
@endsection
