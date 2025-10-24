<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FutsalHub')</title>
    @vite(['resources/css/app.css'])
</head>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="relative z-50 flex items-center justify-between bg-emerald-600 px-6 py-3 text-white shadow">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <a href="{{ url('/') }}">
                <img src="/futsalLogo.png" alt="Futsal Logo" class="h-10 w-auto rounded-full" />
            </a>
        </div>

        <ul class="flex items-center space-x-6">
            @guest
                <!-- Guest Links -->
                <li><a href="{{ url('/') }}" class="hover:text-yellow-300">Home</a></li>
                <li><a href="{{ route('futsal.index') }}" class="hover:text-yellow-300">Find Futsal</a></li>
                <li><a href="{{ route('blog.index') }}" class="hover:text-yellow-300">Blog</a></li>
            @else
                @php
                    $role = auth()->user()->role ?? 'user';
                @endphp

                @if ($role === 'admin')
                    <!-- Admin Links -->
                    <li><a href="{{ route('blog.index') }}" class="hover:text-yellow-300">Manage Blogs</a></li>
                    <li><a href="{{ route('futsal.index') }}" class="hover:text-yellow-300">Manage Futsals</a></li>
                    <li><a href="{{ route('admin.futsals.pending') }}" class="hover:text-yellow-300">Pending Futsals</a></li> 
                    <li><a href="{{ url('/profile') }}" class="hover:text-yellow-300">Profile</a></li>
                @elseif($role === 'user')
                    <!-- Normal User Links -->
                    <li><a href="{{ url('/') }}" class="hover:text-yellow-300">Home</a></li>
                    <li><a href="{{ route('futsal.index') }}" class="hover:text-yellow-300">Find Futsal</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-yellow-300">Blog</a></li>
                    <li><a href="{{ url('/profile') }}" class="hover:text-yellow-300">Profile</a></li>
                    <li><a href="{{ route('booking.history') }}" class="hover:text-yellow-300">Booking History</a></li>
                @elseif($role === 'futsal')
                    <!-- Futsal Links -->
                    <li><a href="{{ route('futsal.home') }}" class="hover:text-yellow-300">Dashboard</a></li>
                    <li><a href="{{ route('futsal.create') }}" class="hover:text-yellow-300">Add Futsal</a></li>
                    <li><a href="{{ route('futsal.index') }}" class="hover:text-yellow-300">My Futsals</a></li>
                @endif
            @endguest

            <li><span class="mx-2 h-6 border-l border-yellow-300"></span></li>

            <!-- Authentication Links -->
            @guest
                <li class="relative group">
                    <a href="#" class="hover:text-yellow-300 flex items-center">Login ▾</a>
                    <ul
                        class="absolute left-0 top-full mt-1 w-44 rounded bg-white text-gray-900 shadow-lg opacity-0 invisible group-hover:visible group-hover:opacity-100 transition-opacity duration-200">
                        <li><a href="{{ route('login.user.form') }}" class="block px-4 py-2 hover:bg-gray-200">Login as
                                User</a></li>
                        <li><a href="{{ route('login.futsal.form') }}" class="block px-4 py-2 hover:bg-gray-200">Login as
                                Futsal</a></li>
                        <li><a href="{{ route('login.admin.form') }}" class="block px-4 py-2 hover:bg-gray-200">Login as
                                Admin</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('register.user.form') }}">
                        <button
                            class="rounded bg-yellow-300 px-4 py-1 font-semibold text-green-900 transition hover:bg-yellow-400">
                            Register
                        </button>
                    </a>
                </li>
            @else
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

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

</body>

</html>
