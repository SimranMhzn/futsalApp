@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6 bg-white rounded-2xl shadow">
    <h1 class="text-3xl font-bold mb-6">Create Blog</h1>

    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf

        <label class="block mb-2 font-semibold">Title</label>
        <input type="text" name="title" class="w-full border px-4 py-2 rounded mb-4" value="{{ old('title') }}">
        @error('title') <p class="text-red-600">{{ $message }}</p> @enderror

        <label class="block mb-2 font-semibold">Content</label>
        <textarea name="content" class="w-full border px-4 py-2 rounded mb-4" rows="6">{{ old('content') }}</textarea>
        @error('content') <p class="text-red-600">{{ $message }}</p> @enderror

        <label class="block mb-2 font-semibold">Author</label>
        <input type="text" name="author" class="w-full border px-4 py-2 rounded mb-4" value="{{ old('author') }}">
        @error('author') <p class="text-red-600">{{ $message }}</p> @enderror

        <label class="block mb-2 font-semibold">Location</label>
        <input type="text" name="location" class="w-full border px-4 py-2 rounded mb-4" value="{{ old('location') }}">
        @error('location') <p class="text-red-600">{{ $message }}</p> @enderror

        <label class="block mb-2 font-semibold">Date Created</label>
        <input type="date" name="date_created" class="w-full border px-4 py-2 rounded mb-4" value="{{ old('date_created') }}">
        @error('date_created') <p class="text-red-600">{{ $message }}</p> @enderror

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Create Blog</button>
    </form>
</div>
@endsection
