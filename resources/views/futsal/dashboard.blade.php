@extends('layouts.app')

@section('content')
<section class="bg-green-700 text-white py-16 text-center rounded-b-3xl shadow-lg">
    <h1 class="text-4xl font-bold">Futsal Dashboard</h1>
    <p class="mt-2 text-lg">Welcome back, {{ Auth::guard('futsal')->user()->name ?? 'Futsal Owner' }}!</p>
</section>

<div class="max-w-6xl mx-auto py-10 px-6">
    <div class="grid md:grid-cols-2 gap-8">
        <a href="{{ route('futsal.create') }}"
           class="block bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300 text-center">
            <h2 class="text-xl font-bold text-green-700 mb-2">➕ Add New Futsal</h2>
            <p class="text-gray-600">List a new futsal facility for players to find and book.</p>
        </a>

        <a href="{{ route('futsal.blogs.create') }}"
           class="block bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300 text-center">
            <h2 class="text-xl font-bold text-green-700 mb-2">📝 Write Blog</h2>
            <p class="text-gray-600">Share futsal news, training tips, or your facility updates.</p>
        </a>
    </div>
</div>
@endsection
