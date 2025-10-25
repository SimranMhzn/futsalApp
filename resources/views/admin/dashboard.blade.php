@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-green-100 p-6 rounded-2xl text-center shadow">
            <h2 class="text-3xl font-bold text-green-700">{{ $userCount }}</h2>
            <p class="text-gray-600">Registered Users</p>
        </div>
        <div class="bg-blue-100 p-6 rounded-2xl text-center shadow">
            <h2 class="text-3xl font-bold text-blue-700">{{ $futsalCount }}</h2>
            <p class="text-gray-600">Approved Futsals</p>
        </div>
        <div class="bg-yellow-100 p-6 rounded-2xl text-center shadow">
            <h2 class="text-3xl font-bold text-yellow-700">{{ $pendingFutsals }}</h2>
            <p class="text-gray-600">Pending Futsals</p>
        </div>
        <div class="bg-purple-100 p-6 rounded-2xl text-center shadow">
            <h2 class="text-3xl font-bold text-purple-700">{{ $blogCount }}</h2>
            <p class="text-gray-600">Total Blogs</p>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Users</h3>
            <ul class="divide-y divide-gray-200">
                @forelse ($recentUsers as $user)
                    <li class="py-2 flex justify-between text-gray-700">
                        <span>{{ $user->name }}</span>
                        <span class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                    </li>
                @empty
                    <li class="py-2 text-gray-500">No recent users.</li>
                @endforelse
            </ul>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Futsals</h3>
            <ul class="divide-y divide-gray-200">
                @forelse ($recentFutsals as $futsal)
                    <li class="py-2 flex justify-between text-gray-700">
                        <span>{{ $futsal->name }}</span>
                        <span class="text-sm text-gray-500">{{ $futsal->created_at->diffForHumans() }}</span>
                    </li>
                @empty
                    <li class="py-2 text-gray-500">No recent futsals.</li>
                @endforelse
            </ul>
        </div>
    </div>

    
    {{-- Quick Actions --}}
    <div class="flex flex-wrap justify-center gap-6 mb-10 mt-30">
        <a href="{{ route('admin.futsals.pending') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-lg shadow">Review Pending Futsals</a>
        <a href="{{ route('admin.blogs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow">Create New Blog</a>
    </div>
</div>
@endsection
