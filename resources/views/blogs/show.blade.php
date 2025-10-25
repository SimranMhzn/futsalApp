@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-4xl font-bold mb-4">{{ $blog->title }}</h1>
    <p class="text-sm text-gray-500 mb-6">
        📅 {{ \Carbon\Carbon::parse($blog->date_created)->format('F j, Y') }} • ✍️ {{ $blog->author }}
    </p>

    <p class="text-gray-700 leading-relaxed">{{ $blog->content }}</p>

    <a href="{{ route('blog.index') }}" class="inline-block mt-6 text-green-600 font-semibold hover:underline">
        ← Back to Blogs
    </a>
</div>
@endsection
