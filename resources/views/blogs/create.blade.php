@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Create Blog</h1>

    {{-- Choose the correct store route based on which guard is authenticated --}}
    @php
        $action = route('admin.blogs.store');
        if (\Illuminate\Support\Facades\Auth::guard('futsal')->check()) {
            $action = route('futsal.blogs.store');
        } elseif (auth()->check() && auth()->user()->is_admin) {
            $action = route('admin.blogs.store');
        }
    @endphp

    <form action="{{ $action }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-2">Title</label>
            <input type="text" name="title" class="w-full border p-2" value="{{ old('title') }}" required>
            @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2">Content</label>
            <textarea name="content" rows="8" class="w-full border p-2" required>{{ old('content') }}</textarea>
            @error('content')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2">Location</label>
            <input type="text" name="location" class="w-full border p-2" value="{{ old('location') }}" required>
            @error('location')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded">Create Blog</button>
    </form>
</div>
@endsection
