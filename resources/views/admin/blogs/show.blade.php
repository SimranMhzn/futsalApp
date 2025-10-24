@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-2xl shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">{{ $blog->title }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('blogs.edit', $blog->id) }}" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">
                Edit
            </a>
            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this blog?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <p class="text-sm text-gray-500 mb-6">
        📅 {{ \Carbon\Carbon::parse($blog->date_created)->format('F j, Y') }} • ✍️ {{ $blog->author }} • 📍 {{ $blog->location ?? 'Unknown' }}
    </p>

    <p class="text-gray-700 leading-relaxed">{{ $blog->content }}</p>

    <a href="{{ route('blogs.index') }}" class="inline-block mt-6 text-green-600 font-semibold hover:underline">
        ← Back to Blog List
    </a>
</div>
@endsection
