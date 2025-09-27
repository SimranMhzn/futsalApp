@extends('layouts.app')

@section('title', 'register')

@section('content')
<div class="mt-8 flex flex-col items-center">
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="max-w-md w-full bg-green-50 p-8 rounded-xl shadow-lg" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-semibold text-green-900">Full Name</label>
            <input type="text" id="name" name="name" class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Enter your full name" required />
        </div>
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-semibold text-green-900">Email Address</label>
            <input type="email" id="email" name="email" class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Enter your email address" required />
        </div>
        <div class="mb-5">
            <label for="phone" class="block mb-2 text-sm font-semibold text-green-900">Contact Number</label>
            <input type="tel" id="phone" name="phone" class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Enter your contact number" required />
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-semibold text-green-900">Password</label>
            <input type="password" id="password" name="password" class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Create your password" required />
        </div>
        <div class="mb-5">
            <label for="password_confirmation" class="block mb-2 text-sm font-semibold text-green-900">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Confirm your password" required />
        </div>
        <button type="submit" class="w-full py-2.5 bg-green-700 hover:bg-green-800 text-white font-bold rounded-lg shadow-md transition duration-150">Register</button>
    </form>
    <div class="mt-4 text-center">
        <a href="/login" class="text-green-700 hover:underline font-semibold">Already have an account? Login here</a>
    </div>
</div>
@endsection