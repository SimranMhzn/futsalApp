@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-6">Add New Futsal</h2>

    <form action="{{ route('futsals.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Futsal Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 rounded">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Location</label>
            <input type="text" name="location" value="{{ old('location') }}" class="w-full border p-2 rounded">
            @error('location') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Contact</label>
            <input type="text" name="contact" value="{{ old('contact') }}" class="w-full border p-2 rounded">
            @error('contact') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create</button>
    </form>
</div>
@endsection
