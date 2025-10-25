@extends('layouts.app')

@section('content')
<section class="flex flex-col bg-emerald-800 text-white text-center md:text-left">
    <div class="bg-emerald-800 text-white px-14 py-24 items-center">
    <h1 class="mb-4 text-3xl font-bold md:text-5xl">Futsal Blogs</h1>
    <p class="mb-8 text-lg md:text-xl">Discover insights about the best futsal facilities and tips</p>
    {{-- Add Create Blog Button --}}
    @auth('futsal')
        <div class="mt-6">
            <a href="{{ route('futsal.blogs.create') }}" class="bg-white text-green-700 font-semibold px-6 py-3 rounded-xl shadow hover:bg-gray-100 transition">
                Create Blog
            </a>
        </div>
    @endauth
    </div>
</section>

<div class="max-w-6xl mx-auto py-10 px-6">
    <div class="grid md:grid-cols-2 gap-8">
        @foreach($blogs as $blog)
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded font-semibold">
                        {{ $blog->location ?? 'Unknown' }}
                    </span>
                </div>

                <h2 class="text-xl font-bold mb-2">{{ $blog->title }}</h2>
                <p class="text-sm text-gray-500 mb-4">
                    📅 {{ \Carbon\Carbon::parse($blog->date_created)->format('F j, Y') }} 
                    • ✍️ {{ $blog->author }}
                </p>
                <p class="text-gray-700 mb-4">{{ Str::limit($blog->content, 150) }}</p>

            </div>
        @endforeach
    </div>

    @if($blogs->isEmpty())
        <p class="text-center text-gray-600 mt-10">No blogs available yet.</p>
    @endif
</div>
@endsection
