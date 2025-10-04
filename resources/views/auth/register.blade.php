@extends('layouts.app')

@section('title', 'register')

@section('content')
<div class="mt-8 flex flex-col items-center">

    <form class="max-w-md w-full bg-green-50 p-5 rounded-xl shadow-lg" action="{{ route('register') }}" method="POST">
        @csrf
        <label class="block mb-2 text-center text-m font-bold text-green-950">
            User registration form
        </label>

        <div class="mb-3">
            <label for="name" class="block mb-2 text-sm font-semibold text-green-900">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 @error('name') border-red-500 @enderror"
                placeholder="Enter your full name" required />
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="block mb-2 text-sm font-semibold text-green-900">Email Address</label>
            <input type="email" id="email" name="email" 
                pattern="[a-zA-Z0-9._%+-]+@gmail\.com" 
                class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" 
                placeholder="Enter your Gmail address" required />
        </div>

        <div class="mb-3">
            <label for="phone" class="block mb-2 text-sm font-semibold text-green-900">Contact Number</label>
            <input type="tel" id="phone" name="phone" 
                maxlength="10"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                pattern="[0-9]{10}" 
                class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" 
                placeholder="Enter your 10-digit contact number" required />
        </div>

        <div class="mb-3 relative">
            <label for="password" class="block mb-2 text-sm font-semibold text-green-900">Password</label>
            <input type="password" id="password" name="password" 
                class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 pr-10" 
                placeholder="Create your password" required />

            <span onclick="togglePassword('password')" class="absolute right-3 top-9 cursor-pointer text-green-700">👁</span>

            <div class="mt-2 w-full h-1 bg-gray-200 rounded">
                <div id="password-strength" class="h-1 rounded"></div>
            </div>
            <p id="password-strength-text" class="mt-1 text-sm"></p>
        </div>

        <div class="mb-3 relative">
            <label for="password_confirmation" class="block mb-2 text-sm font-semibold text-green-900">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 pr-10"
                placeholder="Confirm your password" required />

            <span onclick="togglePassword('password_confirmation')" class="absolute right-3 top-9 cursor-pointer text-green-700">👁</span>

            <p id="password-match-text" class="mt-1 text-sm"></p>
        </div>

        <button type="submit" class="w-full py-2.5 bg-green-700 hover:bg-green-800 text-white font-bold rounded-lg shadow-md transition duration-150">Register</button>
    </form>

    <div class="mt-1 text-center">
        <a href="/login" class="text-green-700 hover:underline font-semibold">Already have an account? Login here</a>
    </div>
</div>

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}

const password = document.getElementById("password");
const confirmPassword = document.getElementById("password_confirmation");
const strengthBar = document.getElementById("password-strength");
const strengthText = document.getElementById("password-strength-text");
const matchText = document.getElementById("password-match-text");

password.addEventListener("input", () => {
    const val = password.value;
    let strength = 0;

    if (val.match(/[a-z]/)) strength++;
    if (val.match(/[A-Z]/)) strength++;
    if (val.match(/[0-9]/)) strength++;
    if (val.match(/[@$!%*?&#]/)) strength++;
    if (val.length >= 8) strength++;

    const levels = [
        { w: "0%", color: "", text: "" },
        { w: "20%", color: "red", text: "Weak" },
        { w: "40%", color: "orange", text: "Fair" },
        { w: "60%", color: "yellow", text: "Good" },
        { w: "80%", color: "blue", text: "Strong" },
        { w: "100%", color: "green", text: "Very Strong" }
    ];

    const level = levels[strength];
    strengthBar.style.width = level.w;
    strengthBar.style.background = level.color;
    strengthText.textContent = level.text;
    strengthText.className = `text-${level.color}-600 text-sm`;
});

confirmPassword.addEventListener("input", () => {
    if (confirmPassword.value === password.value) {
        matchText.textContent = "Passwords match ";
        matchText.className = "text-green-600 text-sm";
    } else {
        matchText.textContent = "Passwords do not match ";
        matchText.className = "text-red-600 text-sm";
    }
});
</script>
@endsection
