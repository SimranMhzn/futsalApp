@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6 bg-white rounded-2xl shadow">
    <h1 class="text-3xl font-bold mb-6">Edit Blog</h1>

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2 font-semibold">Title</label>
        <input type="text" name="title" class="w-full border px-4 py-2 rounded mb-4" value="{{ old('title', $blog->title) }}">
        @error('title') <p class="text-red-600">{{ $message }}</p> @enderror

        <label class="block mb-2 font-semibold">Content</label>
        <textarea name="content" class="w-full border px-4 py-2 rounded mb-4" rows="6">{{ old('content', $blog->content) }}</textarea>
        @error('content') <p class="text-red-600">{{ $message }}</p> @enderror

        <label class="block mb-2 font-semibold">Author</label>
        <input type="text" name="author" class="w-full border px-4 py-2 rounded mb-4" value="{{ old('author', $blog->author) }}">
        @error('author') <p class="text-red-600">{{ $message }}</p> @enderror

        <label class="block mb-2 font-semibold">Location</label>
        <input type="text" name="location" class="w-full border px-4 py-2 rounded mb-4" value="{{ old('location', $blog->location) }}">
        @error('location') <p class="text-red-600">{{ $message
