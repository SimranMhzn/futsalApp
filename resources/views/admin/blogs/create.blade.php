@extends('layouts.app')

@section('title', 'Create Blog')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-8 bg-white shadow-lg rounded-3xl mt-15">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.blogs.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block font-semibold mb-2 text-gray-700">Title</label>
            <input type="text" name="title"
                class="w-full border-gray-300 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500"
                value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-2 text-gray-700">Content</label>
            <textarea name="content" rows="6"
                class="w-full border-gray-300 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500"
                required>{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-2 text-gray-700">Location</label>
            <input type="text" name="location"
                class="w-full border-gray-300 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500"
                value="{{ old('location') }}" required>
            @error('location')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <input type="hidden" name="author" value="">
        <input type="hidden" name="date_created" value="{{ now()->format('Y-m-d') }}">

        <div class="text-center">
            <button type="submit"
                class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                Publish Blog
            </button>
        </div>
    </form>
</div>
@endsection
