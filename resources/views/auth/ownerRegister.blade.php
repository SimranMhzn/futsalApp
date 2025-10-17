@extends('layouts.app')

@section('title', 'register')

@section('content')
<div class="mt-8 flex flex-col items-center">

    <form class="max-w-md w-full bg-green-50 p-5 rounded-xl shadow-lg" action="{{ route('register') }}" method="POST">
        @csrf
        <label class="block mb-2 text-center text-m font-bold text-green-950">
            Futsal owner registration form
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

        <!-- Password field -->
        <div class="mb-3 relative">
            <label for="password" class="block mb-2 text-sm font-semibold text-green-900">Password</label>
            <input type="password" id="password" name="password" 
                class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 pr-10" 
                placeholder="Create your password" required />

            <!-- Eye icon -->
            <span id="togglePassword" class="absolute right-3 top-9 cursor-pointer text-green-700">
                <!-- open-eye SVG -->
                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5
                        c4.477 0 8.268 2.943 9.542 7
                        -1.274 4.057-5.065 7-9.542 7
                        -4.477 0-8.268-2.943-9.542-7z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
            </span>

            <div class="mt-2 w-full h-1 bg-gray-200 rounded">
                <div id="password-strength" class="h-1 rounded"></div>
            </div>
            <p id="password-strength-text" class="mt-1 text-sm"></p>
        </div>

        <!-- Confirm Password field -->
        <div class="mb-3 relative">
            <label for="password_confirmation" class="block mb-2 text-sm font-semibold text-green-900">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="bg-white border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 pr-10"
                placeholder="Confirm your password" required />

            <span id="toggleConfirmPassword" class="absolute right-3 top-9 cursor-pointer text-green-700">
                <!-- open-eye SVG -->
                <svg id="confirmEyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5
                        c4.477 0 8.268 2.943 9.542 7
                        -1.274 4.057-5.065 7-9.542 7
                        -4.477 0-8.268-2.943-9.542-7z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
            </span>

            <p id="password-match-text" class="mt-1 text-sm"></p>
        </div>

        <button type="submit" class="w-full py-2.5 bg-green-700 hover:bg-green-800 text-white font-bold rounded-lg shadow-md transition duration-150">Register</button>
    </form>

    <div class="mt-1 text-center">
        <a href="/login" class="text-green-700 hover:underline font-semibold">Already have an account? Login here</a>
    </div>
</div>

<script>
// SVGs for both icons
const openEye = `
<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'
 stroke-width='2' stroke='currentColor' class='w-5 h-5'>
 <path stroke-linecap='round' stroke-linejoin='round'
 d='M2.458 12C3.732 7.943 7.523 5 12 5
 c4.477 0 8.268 2.943 9.542 7
 -1.274 4.057-5.065 7-9.542 7
 -4.477 0-8.268-2.943-9.542-7z' />
 <circle cx='12' cy='12' r='3' />
</svg>`;

const closedEye = `
<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'
 stroke-width='2' stroke='currentColor' class='w-5 h-5'>
 <path stroke-linecap='round' stroke-linejoin='round'
 d='M3 3l18 18M9.88 9.88A3 3 0 0114.12 14.12M12 5
 c4.477 0 8.268 2.943 9.542 7a10.056 10.056 0 01-1.614 2.73M6.708 6.708
 A10.056 10.056 0 002.458 12
 c1.274 4.057 5.065 7 9.542 7
 1.368 0 2.677-.23 3.885-.654' />
</svg>`;

// Toggle password visibility
function togglePassword(id, iconId) {
    const input = document.getElementById(id);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = closedEye;
    } else {
        input.type = "password";
        icon.innerHTML = openEye;
    }
}

document.getElementById("togglePassword").addEventListener("click", () => {
    togglePassword("password", "eyeIcon");
});

document.getElementById("toggleConfirmPassword").addEventListener("click", () => {
    togglePassword("password_confirmation", "confirmEyeIcon");
});

// Password strength and match
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
        matchText.textContent = "Passwords match";
        matchText.className = "text-green-600 text-sm";
    } else {
        matchText.textContent = "Passwords do not match";
        matchText.className = "text-red-600 text-sm";
    }
});
</script>
@endsection
