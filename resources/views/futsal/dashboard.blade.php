@extends('layouts.app')

@section('content')
<section class="bg-green-700 text-white py-16 text-center rounded-b-3xl shadow-lg">
    <h1 class="text-4xl font-bold">Futsal Dashboard</h1>
    <p class="mt-2 text-lg">Welcome back, {{ Auth::guard('futsal')->user()->name ?? 'Futsal Owner' }}!</p>
</section>

<div class="max-w-6xl mx-auto py-10 px-6">
    <div class="flex justify-center gap-6 flex-wrap">
        

        <a href="{{ route('futsal.blogs.create') }}"
           class="block bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-300 text-center">
            <h2 class="text-xl font-bold text-green-700 mb-2">📝 Write Blog</h2>
            <p class="text-gray-600">Share futsal news, training tips, or your facility updates.</p>
        </a>
    </div>
</div>
 
<div class="max-w-6xl mx-auto py-6 px-6">
    <h2 class="text-2xl font-semibold mb-4">Your Blogs</h2>

    @if(!empty($blogs) && $blogs->count())
        <div class="space-y-4">
            @foreach($blogs as $blog)
                <div class="bg-white p-4 rounded-lg shadow">
                    <a href="{{ route('blog.show', $blog->id) }}" class="text-lg font-bold text-green-700 hover:underline">{{ $blog->title }}</a>
                    <p class="text-sm text-gray-500 mt-1">{{ $blog->date_created ? \Carbon\Carbon::parse($blog->date_created)->format('M d, Y') : '' }}</p>
                    <p class="text-gray-700 mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 150) }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">You haven't published any blogs yet. Use "Write Blog" to create your first post.</p>
    @endif
</div>
@endsection
