@extends('layouts.app')

@section('title', 'login')

@section('content')
<div class="mt-8 flex flex-col items-center">
    <form id="loginForm" class="max-w-md w-full bg-green-50 p-8 rounded-xl shadow-lg" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-semibold text-green-900">Email Address</label>
            <input type="email" id="email" name="email" class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Enter your email address" required />
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-semibold text-green-900">Password</label>
            <input type="password" id="password" name="password" class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Enter your password" required />
        </div>
        <button type="submit" class="w-full py-2.5 bg-green-700 hover:bg-green-800 text-white font-bold rounded-lg shadow-md transition duration-150">Login</button>
    </form>
    <div class="mt-4 text-center">
        <p>Don't have an account? </p>
        <a href="/register" class="text-green-700 hover:underline font-semibold">Register here</a>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const data = {
        email: formData.get('email'),
        password: formData.get('password'),
        _token: formData.get('_token')
    };

    try {
        const res = await fetch("{{ route('login') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await res.json();

        if (res.ok) {
            // Save user info in localStorage for React navbar
            localStorage.setItem('user', JSON.stringify(result.user));
            localStorage.setItem('token', 'session'); // placeholder for session

            // Redirect to home
            window.location.href = "/";
        } else {
            alert(result.message || 'Login failed');
        }
    } catch (err) {
        console.error(err);
        alert('An error occurred. Please try again.');
    }
});
</script>
@endsection
