@extends('layouts.app')

@section('title', 'Futsal Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-green-700 mb-6 text-center">Login as Futsal</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.futsal') }}" class="space-y-5">
            @csrf
            <input 
                type="email" 
                name="email" 
                placeholder="Email" 
                value="{{ old('email') }}" 
                required 
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
            >

            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
            >

            <button 
                type="submit" 
                class="w-full bg-green-700 text-white py-3 rounded-lg font-semibold hover:bg-green-800 transition"
            >
                Login as Futsal
            </button>
        </form>
    </div>
</div>
@endsection
