@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1 class="text-3xl font-bold mb-6">Welcome, Admin!</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Manage Blogs Card -->
    <a href="{{ route('blogs.index') }}" class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
        <h2 class="text-xl font-bold mb-2">Manage Blogs</h2>
        <p class="text-gray-600">Create, edit, and delete blog posts.</p>
    </a>

    <!-- Manage Futsals Card -->
    <a href="{{ route('futsal.index') }}" class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
        <h2 class="text-xl font-bold mb-2">Manage Futsals</h2>
        <p class="text-gray-600">View and manage futsal listings.</p>
    </a>

    <!-- You can add more cards here for other admin actions -->
</div>
@endsection
