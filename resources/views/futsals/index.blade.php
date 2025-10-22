@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-10">
        <h1 class="text-3xl font-bold text-green-700 mb-10 text-center">⚽ All Registered Futsals</h1>

        @if(session('success'))
            <p class="bg-green-100 text-green-700 p-3 mb-6 rounded">{{ session('success') }}</p>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @forelse($futsals as $futsal)
                <div class="border rounded-lg overflow-hidden shadow hover:shadow-lg transition bg-gray-50">
                    @if($futsal->photo)
                        <img src="{{ $futsal->photo }}" alt="{{ $futsal->name }}" class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 w-full bg-gray-200 flex items-center justify-center text-gray-500">
                            No Image
                        </div>
                    @endif

                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-green-700">{{ $futsal->name }}</h2>
                        <p class="text-gray-600">{{ $futsal->location }}</p>
                        <p class="text-sm text-gray-500">Phone: {{ $futsal->phone }}</p>
                        <p class="text-sm text-gray-500">Email: {{ $futsal->email }}</p>
                        <p class="text-sm text-gray-500">Price: NPR {{ $futsal->price }}/hr</p>

                        <a href="{{ route('futsals.show', $futsal->id) }}" class="mt-3 inline-block text-green-600 hover:underline">View Details →</a>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-center w-full col-span-2">No futsals registered yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
