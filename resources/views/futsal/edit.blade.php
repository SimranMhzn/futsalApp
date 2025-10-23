@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-6">Edit Futsal</h2>

    <form action="{{ route('futsals.update', $futsal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Futsal Name</label>
            <input type="text" name="name" value="{{ old('name', $futsal->name) }}" class="w-full border p-2 rounded">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Location</label>
            <input type="text" name="location" value="{{ old('location', $futsal->location) }}" class="w-full border p-2 rounded">
            @error('location') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Contact</label>
            <input type="text" name="contact" value="{{ old('contact', $futsal->contact) }}" class="w-full border p-2 rounded">
            @error('contact') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update</button>
    </form>
</div>
@endsection
