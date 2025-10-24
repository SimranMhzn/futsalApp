@extends('layouts.app')

@section('content')
<section class="bg-green-700 text-white py-16 text-center rounded-b-3xl shadow-lg">
    <h1 class="text-4xl font-bold">Futsal Blogs</h1>
    <p class="mt-2 text-lg">Discover insights about the best futsal facilities and tips</p>
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

                <a href="{{ route('blogs.show', $blog->id) }}" class="text-green-600 font-semibold hover:underline">
                    Read Full Blog →
                </a>
            </div>
        @endforeach
    </div>

    @if($blogs->isEmpty())
        <p class="text-center text-gray-600 mt-10">No blogs available yet.</p>
    @endif
</div>
@endsection
