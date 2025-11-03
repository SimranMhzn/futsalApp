@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-10">
            <h1 class="text-3xl font-bold text-green-700 mb-10 text-center">🏟️ Register Your Futsal</h1>

            @if (session('error'))
                <p class="bg-red-100 text-red-700 p-3 mb-6 rounded">{{ session('error') }}</p>
            @endif
            @if (session('success'))
                <p class="bg-green-100 text-green-700 p-3 mb-6 rounded">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 p-4 mb-4 rounded">
                    <ul class="list-disc pl-5 text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('register.futsal.form') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Info -->
                <section class="space-y-4">
                    <h2 class="text-2xl font-semibold text-green-700">Basic Information</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Futsal Name *"
                            class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-green-500">
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone Number *"
                            class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-green-500">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Gmail Address *"
                            class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-green-500">
                        <input type="number" name="price" value="{{ old('price') }}"
                            placeholder="Price per hour (NPR) *"
                            class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-green-500">
                        <input type="text" name="location" value="{{ old('location') }}" placeholder="Location"
                            class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-green-500">
                        <input type="text" name="link" value="{{ old('link') }}" placeholder="Google Maps Link"
                            class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-green-500">
                    </div>
                </section>

                <!-- Password Section -->
                <section class="space-y-4 mt-6">
                    <h2 class="text-2xl font-semibold text-green-700">Account Password</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input type="password" id="password" name="password" placeholder="Password"
                            class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-green-500">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm Password"
                            class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-green-500">
                    </div>
                    <p id="password-feedback" class="text-red-600 text-sm mt-1 hidden">Passwords do not match</p>
                </section>

                <!-- Facilities -->
                <section class="space-y-4 mt-6">
                    <h2 class="text-2xl font-semibold text-green-700">Facilities & Features</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input type="number" name="side_no" min="0" value="{{ old('side_no') }}"
                            placeholder="Players per side" class="border p-3 rounded-lg w-full">
                        <input type="number" name="ground_no" min="0" value="{{ old('ground_no') }}"
                            placeholder="Number of Grounds" class="border p-3 rounded-lg w-full">
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-4">
                        @foreach (['shower_facility' => 'Shower Facility', 'parking_space' => 'Parking Space', 'changing_room' => 'Changing Room', 'restaurant' => 'Restaurant', 'wifi' => 'WiFi', 'open_ground' => 'Open Ground'] as $key => $label)
                            <label class="flex items-center gap-2 p-2 border rounded-lg hover:bg-green-50 cursor-pointer">
                                <input type="checkbox" name="{{ $key }}" value="1"
                                    {{ old($key) ? 'checked' : '' }}>
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </section>

                <!-- Description -->
                <section class="space-y-2 mt-6">
                    <textarea name="description" placeholder="Description" rows="4"
                        class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-green-500">{{ old('description') }}</textarea>
                </section>

                <!-- Image -->
                <section class="space-y-2 mt-6">
                    <h2 class="text-2xl font-semibold text-green-700">Upload Image</h2>
                    <label
                        class="border-2 border-dashed rounded-lg flex flex-col items-center justify-center h-96 cursor-pointer hover:bg-gray-50 transition relative overflow-hidden">
                        <span id="photo-text" class="text-gray-400 text-lg">Click to upload (Required)</span>
                        <input type="file" name="photo" accept="image/*" class="hidden" id="photo-input" required>
                        <img id="photo-preview" class="absolute inset-0 w-full h-full object-cover hidden" alt="Preview">
                    </label>
                </section>
                <section class="space-y-2 mt-6">
                    <h2 class="text-2xl font-semibold text-green-700">Opening & Closing Time (24-hour)</h2>

                    <div class="grid grid-cols-2 gap-4 items-end">
                        <!-- Opening Time -->
                        <div>
                            <label class="block mb-1 font-medium">Opening Time</label>
                            <input type="time" name="open_time" value="{{ old('open_time') }}" required
                                class="border p-2 rounded w-full">
                        </div>

                        <!-- Closing Time -->
                        <div>
                            <label class="block mb-1 font-medium">Closing Time</label>
                            <input type="time" name="close_time" value="{{ old('close_time') }}" required
                                class="border p-2 rounded w-full">
                        </div>
                    </div>
                </section>


                <!-- Form Buttons -->
                <div class="flex justify-between mt-6">
                    <a href="{{ url()->previous() }}"
                        class="border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-100">← Back</a>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Submit
                        →</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Photo preview
        const input = document.getElementById('photo-input');
        const preview = document.getElementById('photo-preview');
        const text = document.getElementById('photo-text');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    text.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
                text.classList.remove('hidden');
            }
        });

        // Real-time password validation
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const feedback = document.getElementById('password-feedback');

        function validatePasswords() {
            if (passwordConfirmation.value === "") {
                feedback.classList.add('hidden');
                return;
            }
            if (password.value !== passwordConfirmation.value) {
                feedback.classList.remove('hidden');
            } else {
                feedback.classList.add('hidden');
            }
        }

        password.addEventListener('input', validatePasswords);
        passwordConfirmation.addEventListener('input', validatePasswords);
    </script>
@endsection
