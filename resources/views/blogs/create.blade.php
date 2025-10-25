@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Create Blog</h1>

    <form action="{{ route('futsal.blogs.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Title</label>
            <input type="text" name="title" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Content</label>
            <textarea name="content" rows="8" class="w-full border p-2" required></textarea>
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded">Create Blog</button>
    </form>
</div>
@endsection
