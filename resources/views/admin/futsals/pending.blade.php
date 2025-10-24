@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    @if($futsals->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($futsals as $futsal)
                <a href="{{ route('futsal.show', $futsal->id) }}" class="block border rounded-xl shadow-md hover:shadow-xl transition p-4 bg-white">
                    {{-- Photo --}}
                    @if($futsal->photo)
                        <img src="{{ asset('storage/' . $futsal->photo) }}" 
                             alt="{{ $futsal->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-500">
                            No Image
                        </div>
                    @endif

                    {{-- Info --}}
                    <h2 class="text-xl font-semibold text-green-700 mb-1">{{ $futsal->name }}</h2>
                    <p class="text-gray-600 mb-1">{{ $futsal->email }}</p>
                    <p class="text-gray-600 mb-1">{{ $futsal->phone }}</p>
                    <p class="text-gray-600 mb-4">{{ $futsal->location }}</p>

                    
                </a>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-600 mt-6">No pending futsals.</p>
    @endif
</div>
@endsection
