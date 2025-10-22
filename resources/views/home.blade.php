@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="flex flex-col bg-emerald-800 px-14 py-24 text-white text-center md:text-left">
    <div>
        <h1 class="mb-2 text-3xl font-bold md:text-5xl">Book Your Perfect Futsal Court in Seconds</h1>
        <p class="mb-8 text-lg md:text-s">
            Find available courts near you and reserve your spot in seconds. No hassle, no waiting.
        </p>
    </div>
    <a href="{{ route('futsals.index') }}"
        class="w-48 rounded-xl border-2 border-white p-2.5 text-center transition-transform hover:scale-105 bg-white text-emerald-800 font-semibold">
        Find Futsals Now
    </a>
</section>

<section class="mx-auto max-w-6xl px-4 py-20">
    <h2 class="mb-12 text-center text-4xl font-semibold text-gray-900 dark:text-white">Why Choose FutsalHub?</h2>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

        <div class="border-green-400 p-6 text-center rounded-2xl bg-white dark:bg-gray-800 shadow hover:shadow-lg transition">
            <div class="mb-3 flex justify-center">
                <div class="rounded-full bg-emerald-200 p-3">
                    <i class="fa-solid fa-clock text-green-600 text-3xl"></i>
                </div>
            </div>
            <h3 class="mb-2 text-xl font-bold text-green-600">Quick Booking</h3>
            <p>Book your favourite futsal court in less than a minute. No phone calls needed.</p>
        </div>

        <div class="border-green-400 p-6 text-center rounded-2xl bg-white dark:bg-gray-800 shadow hover:shadow-lg transition">
            <div class="mb-3 flex justify-center">
                <div class="rounded-full bg-emerald-200 p-3">
                    <i class="fa-solid fa-location-dot text-green-600 text-3xl"></i>
                </div>
            </div>
            <h3 class="mb-2 text-xl font-bold text-green-600">Find Nearby Courts</h3>
            <p>Discover the best futsal courts near your location with real-time availability.</p>
        </div>

        <!-- Card 3 -->
        <div class="border-green-400 p-6 text-center rounded-2xl bg-white dark:bg-gray-800 shadow hover:shadow-lg transition">
            <div class="mb-3 flex justify-center">
                <div class="rounded-full bg-emerald-200 p-3">
                    <i class="fa-solid fa-check-circle text-green-600 text-3xl"></i>
                </div>
            </div>
            <h3 class="mb-2 text-xl font-bold text-green-600">Verified Venues</h3>
            <p>All futsal courts are verified for quality and facilities. Play with confidence.</p>
        </div>
    </div>
</section>

<!-- Featured Futsals Section -->
{{-- @include('components.featured-futsals') --}}

<!-- How It Works -->
<section class="bg-gray-50 px-6 py-20 dark:bg-gray-800">
    <h2 class="mb-16 text-center text-4xl font-semibold text-gray-900 dark:text-white">How It Works</h2>
    <div class="mx-auto grid max-w-6xl grid-cols-1 gap-10 md:grid-cols-3">
        <div class="rounded-2xl bg-white p-8 text-center shadow-md hover:shadow-xl dark:bg-gray-700">
            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-2xl font-bold text-white">1</div>
            <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Find a Futsal Court</h3>
            <p class="text-gray-600 dark:text-gray-300">Browse futsal courts and filter by location, price, or facilities.</p>
        </div>

        <div class="rounded-2xl bg-white p-8 text-center shadow-md hover:shadow-xl dark:bg-gray-700">
            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-2xl font-bold text-white">2</div>
            <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Choose your time slot</h3>
            <p class="text-gray-600 dark:text-gray-300">Select a slot that fits your schedule with real-time availability.</p>
        </div>

        <div class="rounded-2xl bg-white p-8 text-center shadow-md hover:shadow-xl dark:bg-gray-700">
            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-2xl font-bold text-white">3</div>
            <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Book & Play</h3>
            <p class="text-gray-600 dark:text-gray-300">Complete your booking with secure payment and get instant confirmation.</p>
        </div>
    </div>

    <div class="mt-14 flex justify-center">
        <a href="{{ route('futsals.index') }}"
           class="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white shadow-md hover:scale-105 hover:bg-green-700 transition">
           Find a Court Now
        </a>
    </div>
</section>

<!-- Call to Action -->
<div class="bg-green-700 text-white text-center py-12">
    <h2 class="mb-2 text-2xl font-bold">Ready to Find Your Perfect Futsal Court?</h2>
    <p class="mb-6">Join thousands of players booking futsals every day. Fast, easy, and reliable.</p>
    <a href="{{ route('futsals.index') }}"
       class="inline-block bg-white text-green-700 font-bold px-6 py-2 rounded-xl hover:bg-gray-100 transition">
       Browse Futsals
    </a>
</div>

<!-- Futsal Owner Section -->
<section class="px-6 py-16 text-center dark:bg-gray-700">
    <h2 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white">Are you a Futsal Owner?</h2>
    <p class="mb-8 text-gray-700 dark:text-gray-300">Register your futsal and start getting bookings from players near you!</p>
    <a href="{{ route('futsals.create') }}"
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
                <li><a href="{{ route('futsals.index') }}" class="hover:underline">Find Futsals</a></li>
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
