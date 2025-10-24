@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold text-green-700 mb-6 text-center">
        My Futsal Registration Status
    </h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center gap-6 mb-4">
            @if($futsal->photo)
                <img src="{{ asset('storage/' . $futsal->photo) }}" 
                     alt="{{ $futsal->name }}" class="w-32 h-32 object-cover rounded">
            @endif
            <div>
                <h2 class="text-xl font-semibold">{{ $futsal->name }}</h2>
                <p class="text-gray-600">Email: {{ $futsal->email }}</p>
                <p class="text-gray-600">Location: {{ $futsal->location }}</p>
                <p class="text-gray-600">Phone: {{ $futsal->phone }}</p>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-lg font-semibold">
                Registration Status:
                @if($futsal->status == 'pending')
                    <span class="text-yellow-600">Pending Approval</span>
                @elseif($futsal->status == 'approved')
                    <span class="text-green-600">Approved</span>
                @elseif($futsal->status == 'rejected')
                    <span class="text-red-600">Rejected</span>
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
