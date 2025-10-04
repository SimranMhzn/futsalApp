@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
        <section class="flex flex-col items-center justify-center text-center py-24 px-4 bg-gradient-to-r from-green-500 to-green-950 text-white">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4">
                Book Your Futsal Court Instantly
            </h1>
            <p class="text-lg md:text-xl mb-8">
                Find available courts near you and reserve your spot in seconds.
            </p>
            <a href="{{ route('futsals.index') }}"
               class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg border-2 border-white transition-transform hover:scale-105">
                Book Now
            </a>
        </section>

        <section class="max-w-6xl mx-auto py-20 px-4">
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-12 text-center">
                Why Choose FutsalHub?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="border border-green-400 p-6 rounded-lg bg-white hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold mb-2 text-center text-green-600">Quick Booking</h3>
                    <p class=" text-center">Book your favourite futsal court in less than a minute. No phone calls needed.</p>
                </div>
                <div class="border border-green-400 p-6 rounded-lg bg-white hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold mb-2 text-center text-green-600">Find Nearby Courts</h3>
                    <p class=" text-center">Discover the best futsal courts near your location with real-time availability.</p>
                </div>
                <div class="border border-green-400 p-6 rounded-lg bg-white hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold mb-2 text-center text-green-600">Verified Venues</h3>
                    <p class=" text-center">All futsal courts are verified for quality and facilities. Play with confidence.</p>
                </div>
            </div>
        </section>

        <section class="bg-gray-100 dark:bg-gray-800 py-20 px-4">
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-16 text-center">
                How It Works
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
                <div class="text-center p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="text-green-600 text-5xl mb-4">1️⃣</div>
                    <h3 class="font-bold mb-2 text-gray-900 dark:text-white">Select Court</h3>
                    <p class="text-gray-700 dark:text-gray-300">Browse available futsal courts near you.</p>
                </div>
                <div class="text-center p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="text-green-600 text-5xl mb-4">2️⃣</div>
                    <h3 class="font-bold mb-2 text-gray-900 dark:text-white">Pick Time</h3>
                    <p class="text-gray-700 dark:text-gray-300">Choose your preferred slot and date.</p>
                </div>
                <div class="text-center p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="text-green-600 text-5xl mb-4">3️⃣</div>
                    <h3 class="font-bold mb-2 text-gray-900 dark:text-white">Confirm & Pay</h3>
                    <p class="text-gray-700 dark:text-gray-300">Complete payment online and receive instant confirmation.</p>
                </div>
            </div>
        </section>
    </div>

    <div class="bg-green-700 text-white">
        <div class="text-center py-12">
            <h2 class="text-2xl font-bold mb-2">
                Ready to Find Your Perfect Futsal Court?
            </h2>
            <p class="mb-6">
                Join thousands of futsal players who book courts through FutsalHub
                every day. <br />
                Fast, easy, and reliable.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('futsals.index') }}"
                   class="bg-white text-green-700 font-bold py-2 px-6 rounded-lg hover:bg-gray-100">
                    Browse Futsals
                </a>
                <a href="{{ route('register') }}"
                   class="bg-transparent text-white font-bold py-2 px-6 rounded-lg border-2 border-white hover:bg-green-800">
                    Create Free Account
                </a>

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="bg-red-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-700">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>

    <footer class="bg-green-900 px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-200">
            <div>
                <h3 class="font-bold text-lg text-white">FutsalHub</h3>
                <p class="mt-2 text-sm">
                    The easiest way to book futsal courts near you. Play more, worry less.
                </p>
                <div class="flex gap-4 mt-4 text-xl">
                    <a href="#" class="hover:text-white cursor-pointer">📘</a>
                    <a href="#" class="hover:text-white cursor-pointer">📷</a>
                    <a href="#" class="hover:text-white cursor-pointer">🐦</a>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-lg text-white">Quick Links</h3>
                <ul class="mt-2 space-y-2 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('futsals.index') }}" class="hover:underline">Find Futsals</a></li>
                    <li><a href="#" class="hover:underline">About Us</a></li>
                    <li><a href="#" class="hover:underline">Contact</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-lg text-white">Contact Us</h3>
                <ul class="mt-2 space-y-2 text-sm">
                    <li>Kathmandu, Nepal</li>
                    <li>info@futsalhub.app</li>
                    <li>+977 9800000000</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-500 mt-8 pt-4 flex flex-col md:flex-row justify-between text-sm text-gray-300">
            <p>© 2025 FutsalHub. All rights reserved.</p>
            <div class="flex gap-4 mt-2 md:mt-0">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Terms of Service</a>
            </div>
        </div>
    </footer>
@endsection
