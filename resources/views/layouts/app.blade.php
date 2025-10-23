<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FutsalHub')</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="relative z-50 flex items-center justify-between bg-emerald-600 px-4 py-3 text-white shadow">
        <div class="flex items-center space-x-2">
            <a href="{{ url('/') }}">
                <img src="/futsalLogo.png" alt="Futsal Logo" class="h-10 w-auto rounded-full" />
            </a>
        </div>

        <ul class="flex items-center space-x-6">
            <!-- Static Links -->
            <li><a class="hover:text-yellow-300" href="{{ url('/') }}">Home</a></li>
            <li><a class="hover:text-yellow-300" href="{{ route('futsal.index') }}">Find Futsal</a></li>
            <li><a class="hover:text-yellow-300" href="{{ url('/blog') }}">Blog</a></li>

            <li><span class="mx-2 h-6 border-l border-yellow-300"></span></li>

            <!-- Authentication Links -->
            @guest
                <!-- Login Dropdown -->
                <li class="relative group">
                    <a href="#" class="hover:text-yellow-300 flex items-center">Login ▾</a>
                    
                    <ul
                        class="absolute left-0 top-full mt-1 w-44 rounded bg-white text-gray-900 shadow-lg opacity-0 invisible group-hover:visible group-hover:opacity-100 transition-opacity duration-200">
                        <li>
                            <a href="{{ route('login.user.form') }}"
                               class="block px-4 py-2 hover:bg-gray-200">
                                Login as User
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login.futsal.form') }}"
                               class="block px-4 py-2 hover:bg-gray-200">
                                Login as Futsal
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Register Button -->
                <li>
                    <a href="{{ route('register.user.form') }}">
                        <button
                            class="rounded bg-yellow-300 px-4 py-1 font-semibold text-green-900 transition hover:bg-yellow-400">
                            Register
                        </button>
                    </a>
                </li>
            @else
                <!-- Authenticated Links -->
                <li><a class="hover:text-yellow-300" href="{{ url('/profile') }}">Profile</a></li>
                <li><a class="hover:text-yellow-300" href="{{ route('booking.history') }}">Booking History</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded bg-red-500 px-4 py-1 font-semibold text-white transition hover:bg-red-600">
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
