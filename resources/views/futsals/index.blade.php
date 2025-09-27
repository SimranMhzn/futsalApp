@extends('layouts.app')

@section('title', 'Futsals')

@section('content')

<div>
  <form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Logout</button>
  </form>
</div>

<div class="mt-8">
  <h1 class="text-3xl font-bold text-center text-blue-700 dark:text-gray-50">Futsals</h1>
  <form action="{{ route('futsals.store') }}" method="POST" class="max-w-2xl mx-auto px-12">
    @csrf
    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
    <textarea id="message" name="futsal" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
    <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
  </form>
</div>

@foreach ($futsals as $fu)
  <div class="max-w-2xl mx-auto mt-16">
    <div class="flex items-start gap-2.5">
      <img class="w-8 h-8 rounded-full" src="{{ asset('uploads/market.jpg') }}" alt="Jese image">
      <div class="flex flex-col w-full leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
          <div class="flex items-center space-x-2 rtl:space-x-reverse">
            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->name }}</span>
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


<!-- <div>
  <img src="{{ asset('uploads/farmer.jpg') }}" alt="Farmer">
</div> -->











@endsection