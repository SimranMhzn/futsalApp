@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-10 rounded-xl shadow-lg text-center">
    <h1 class="text-3xl font-bold text-green-700 mb-4">Welcome, {{ auth()->user()->name }}!</h1>
    <p class="text-gray-600 mb-6">You are logged in as a futsal owner.</p>

    <div class="flex justify-center gap-4">
        <a href="{{ route('futsals.create') }}" class="bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 font-semibold">
            Add New Futsal
        </a>

        <a href="{{ route('futsals.index') }}" class="bg-gray-200 text-green-700 px-6 py-3 rounded-lg hover:bg-gray-300 font-semibold">
            View Your Futsals
        </a>
    </div>
</div>
@endsection
