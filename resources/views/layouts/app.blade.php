<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FutsalHub')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

    <nav class="relative z-50 flex items-center justify-between bg-emerald-600 px-4 py-3 text-white shadow">
        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}">
                <img src="/futsalLogo.png" alt="Futsal Logo" class="h-8 w-42 rounded-full" />
            </a>
        </div>

        <ul class="flex items-center space-x-6">
            <li><a class="hover:text-yellow-300" href="{{ route('home') }}">Home</a></li>
            <li><a class="hover:text-yellow-300" href="{{ route('futsals.index') }}">Find Futsal</a></li>
            <li><a class="hover:text-yellow-300" href="{{ route('blog') }}">Blog</a></li>
            <li><span class="mx-2 h-6 border-l border-yellow-300"></span></li>

            @guest
                <li><a href="{{ route('login') }}" class="hover:text-yellow-300">Login</a></li>
                <li>
                    <a href="{{ route('register') }}">
                        <button class="rounded bg-yellow-300 px-4 py-1 font-semibold text-green-900 transition hover:bg-yellow-400">
                            Register
                        </button>
                    </a>
                </li>
            @else
                <li><a class="hover:text-yellow-300" href="{{ route('profile') }}">Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="rounded bg-red-500 px-4 py-1 font-semibold text-white transition hover:bg-red-600"
                        >
                            Logout
                        </button>
                    </form>
                </li>
            @endguest
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>
