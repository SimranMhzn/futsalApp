@extends('layouts.app')
@section('title', 'Admin Futsals')

@section('content')
<div class="max-w-4xl mx-auto mt-8 space-y-8">
    <!-- logoutbutton -->
    <div>
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Logout</button>
    </form>
    </div>

    <div>
        <!-- {{ $userCount }} users are registered. -->
        
        <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $userCount }}</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">Total User</p>
        </a>

    </div>


    <div>
        <h1 class="text-3xl font-bold text-center text-blue-700 dark:text-gray-50">Admin Futsals</h1>
        <p class="text-center">Welcome, {{ $user->name }} (Admin)</p>

        <!-- <ul class="mt-8 space-y-4">
            @foreach ($futsals as $futsal)
                <li>
                    <strong>{{ $futsal->user->name }}:</strong> {{ $futsal->futsal }}

                    <br>
                    <small>Posted on: {{ $futsal->created_at->format('M d, Y \a\t h:i A') }}</small>
                </li>
                <hr>
            @endforeach -->

            @foreach ($futsals as $fu)
                <div class="max-w-2xl mx-auto mt-16">
                    <div class="flex items-start gap-2.5">
                    <img class="w-8 h-8 rounded-full" src="{{ asset('uploads/market.jpg') }}" alt="Jese image">
                    <div class="flex flex-col w-full leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $ch->user->name }}:</span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $ch->updated_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{ $ch->futsal }}</p>
                    </div>
                    <button id="dropdownMenuIconButton-{{ $ch->id }}" data-dropdown-toggle="dropdownDots-{{ $ch->id }}" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                        </svg>
                    </button>
                    <div id="dropdownDots-{{ $ch->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-40 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton-{{ $ch->id }}">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reply</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Forward</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Copy</a>
                            </li>
                            <li>
                                <a href="{{ route('futsals.edit', $ch->id) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                            <form action="{{ route('futsals.destroy', $ch->id) }}" method="POST" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-left">Delete</button>
                            </form>
                            </li>
                        </ul>
                    </div>
                    </div>

                </div>
            @endforeach
    </div>
</div>


@endsection