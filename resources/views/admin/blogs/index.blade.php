@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-6">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-emerald-800">Manage Blogs</h1>
        <a href="{{ route('admin.blogs.create') }}"
           class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition">
           + Create Blog
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 shadow-sm text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Blog Cards --}}
    <div class="flex flex-col items-center space-y-8">
        @foreach($blogs as $blog)
        <div x-data="{ showDetails: false, showEdit: false }"
             class="bg-white w-full md:w-4/5 lg:w-3/4 xl:w-3/4 p-8 rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 border border-gray-100 cursor-pointer">

            {{-- Card clickable to show details --}}
            <div @click="showDetails = true">
                <h2 class="text-2xl font-bold mb-3 text-gray-800">{{ $blog->title }}</h2>
                <p class="text-gray-700 leading-relaxed">{{ Str::limit($blog->content, 120) }}</p>
                <p class="text-sm text-gray-500 mt-3">
                    Author: <span class="font-medium text-emerald-800">{{ $blog->author ?? 'Admin' }}</span> • Created at: <span class="font-medium text-emerald-800">{{ $blog->created_at ? $blog->created_at->format('M d, Y') : 'N/A' }}</span>
                </p>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-2 mt-4">
                <button @click.stop="showEdit = true"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                    Edit
                </button>
                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this blog?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                        Delete
                    </button>
                </form>
            </div>

            {{-- Modal: Blog Details --}}
            <div x-show="showDetails" 
                 x-transition.opacity.scale.duration.300ms
                 class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 p-4">
                <div @click.away="showDetails = false" 
                     class="bg-white rounded-3xl p-8 max-w-2xl w-full shadow-2xl relative">
                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">{{ $blog->title }}</h2>
                        <button @click="showDetails = false" class="text-gray-500 hover:text-gray-800">&times;</button>
                    </div>
                    {{-- Body --}}
                    <p class="text-sm text-gray-500 mb-3">
                        Author: {{ $blog->author ?? 'Admin' }} • Created at: {{ $blog->created_at ? $blog->created_at->format('M d, Y') : 'N/A' }}
                    </p>
                    <p class="text-gray-700 leading-relaxed">{{ $blog->content }}</p>
                </div>
            </div>

            {{-- Modal: Edit Blog --}}
            <div x-show="showEdit" 
                 x-transition.opacity.scale.duration.300ms
                 class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 p-4">
                <div @click.away="showEdit = false" class="bg-white rounded-3xl p-8 max-w-2xl w-full shadow-2xl relative">
                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Edit Blog</h2>
                        <button @click="showEdit = false" class="text-gray-500 hover:text-gray-800">&times;</button>
                    </div>

                    {{-- Edit Form --}}
                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-1">Title</label>
                            <input type="text" name="title" value="{{ $blog->title }}" 
                                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-emerald-300">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-1">Content</label>
                            <textarea name="content" rows="5" 
                                      class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-emerald-300">{{ $blog->content }}</textarea>
                        </div>

                        {{-- Footer buttons --}}
                        <div class="flex justify-end gap-3 mt-6">
                            <button type="button" @click="showEdit = false" 
                                    class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                            <button type="submit" 
                                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection
