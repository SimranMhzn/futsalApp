@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-10 rounded-2xl shadow-lg mt-10" x-data="registerForm()">
    <h2 class="text-3xl font-bold mb-6 text-center text-green-700">Register as User</h2>

    <form x-ref="form" method="POST" action="{{ route('register.user.form') }}" @submit.prevent="submitForm">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" x-model="name" @input="validateName"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                   required>
            <template x-if="errors.name">
                <span class="text-red-600 text-sm" x-text="errors.name"></span>
            </template>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" x-model="email" @input="validateEmail"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                   required>
            <template x-if="errors.email">
                <span class="text-red-600 text-sm" x-text="errors.email"></span>
            </template>
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Phone</label>
            <input type="text" name="phone" x-model="phone" @input="validatePhone"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                   required>
            <template x-if="errors.phone">
                <span class="text-red-600 text-sm" x-text="errors.phone"></span>
            </template>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Password</label>
            <input type="password" name="password" x-model="password" @input="validatePassword"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                   required>
            <template x-if="errors.password">
                <span class="text-red-600 text-sm" x-text="errors.password"></span>
            </template>
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label class="block font-semibold mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" x-model="password_confirmation" @input="validatePasswordConfirmation"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                   required>
            <template x-if="errors.password_confirmation">
                <span class="text-red-600 text-sm" x-text="errors.password_confirmation"></span>
            </template>
        </div>

        <button type="submit" :disabled="!isFormValid"
                class="w-full bg-green-700 text-white py-2 rounded hover:bg-green-800 font-semibold disabled:opacity-50">
            Register
        </button>
    </form>

    <p class="text-center mt-4 text-gray-600 text-sm">
        Already have an account? <a href="{{ route('login.user.form') }}" class="text-green-700 font-semibold">Login</a>
    </p>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
function registerForm() {
    return {
        name: '',
        email: '',
        phone: '',
        password: '',
        password_confirmation: '',
        errors: {},
        get isFormValid() {
            return Object.keys(this.errors).length === 0 &&
                   this.name && this.email && this.phone && this.password && this.password_confirmation;
        },
        validateName() {
            this.errors.name = this.name.length < 3 ? 'Name must be at least 3 characters' : '';
            if (!this.errors.name) delete this.errors.name;
        },
        validateEmail() {
            const regex = /^\S+@\S+\.\S+$/;
            this.errors.email = !regex.test(this.email) ? 'Invalid email address' : '';
            if (!this.errors.email) delete this.errors.email;
        },
        validatePhone() {
            const regex = /^[0-9]{10,15}$/;
            this.errors.phone = !regex.test(this.phone) ? 'Phone must be 10-15 digits' : '';
            if (!this.errors.phone) delete this.errors.phone;
        },
        validatePassword() {
            this.errors.password = this.password.length < 6 ? 'Password must be at least 6 characters' : '';
            if (!this.errors.password) delete this.errors.password;
            this.validatePasswordConfirmation();
        },
        validatePasswordConfirmation() {
            this.errors.password_confirmation =
                this.password_confirmation !== this.password ? 'Passwords do not match' : '';
            if (!this.errors.password_confirmation) delete this.errors.password_confirmation;
        },
        submitForm() {
            this.validateName();
            this.validateEmail();
            this.validatePhone();
            this.validatePassword();
            this.validatePasswordConfirmation();

            if (this.isFormValid) {
                this.$refs.form.submit();
            }
        }
    }
}
</script>
@endsection
