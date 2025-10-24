@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">All Blogs</h1>
        <a href="{{ route('blogs.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Create Blog
        </a>
    </div>

    @if(session('success'))
        <p class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</p>
    @endif

    <div class="grid md:grid-cols-2 gap-6">
        @forelse($blogs as $blog)
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-bold mb-2">{{ $blog->title }}</h2>
                <p class="text-sm text-gray-500 mb-2">✍️ {{ $blog->author }} • 📅 {{ $blog->date_created }}</p>
                <p class="text-gray-700 mb-4">{{ Str::limit($blog->content, 150) }}</p>
                <div class="flex gap-2">
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this blog?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No blogs available.</p>
        @endforelse
    </div>
</div>
@endsection
