@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-12 px-6" x-data="profileForm()">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-700 to-emerald-600 text-white py-10 rounded-t-2xl text-center shadow-lg">
            <h1 class="text-4xl font-extrabold tracking-wide">My Profile</h1>
            <p class="mt-2 text-sm opacity-90">View your account information</p>
        </div>

        {{-- Profile Card --}}
        <div class="bg-white p-10 rounded-b-2xl shadow-xl border border-gray-100 relative mt-6">

            {{-- Success Message --}}
            @if (session('success'))
                <div
                    class="mb-6 p-4 text-green-800 bg-green-100 border border-green-300 rounded-md text-sm font-medium flex items-center gap-2">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Profile Header --}}
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-semibold text-gray-800">Account Details</h2>
                <button x-show="!editMode" @click="editMode = true"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition flex items-center gap-2">
                    Edit Details
                </button>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" @submit.prevent="submitForm">
                @csrf
                @method('PUT')

                {{-- Profile Fields --}}
                <div class="grid sm:grid-cols-2 gap-6">
                    @if ($roleType === 'futsal')
                        @foreach ([['label' => 'Futsal Name', 'name' => 'name', 'value' => $user->name], ['label' => 'Email', 'name' => 'email', 'value' => $user->email], ['label' => 'Phone', 'name' => 'phone', 'value' => $user->phone], ['label' => 'Location', 'name' => 'location', 'value' => $user->location], ['label' => 'Price', 'name' => 'price', 'value' => $user->price ?? '—']] as $field)
                            <div>
                                <label class="block text-sm font-semibold text-gray-500 mb-1">{{ $field['label'] }}</label>
                                <p class="text-gray-800" x-show="!editMode">{{ $field['value'] }}</p>
                                <input type="text" name="{{ $field['name'] }}" value="{{ $field['value'] }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-700"
                                    x-show="editMode">
                            </div>
                        @endforeach

                        {{-- Facilities --}}
                        <div class="col-span-2 bg-gray-50 p-4 rounded-lg border">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Facilities</h3>
                            <ul class="list-disc list-inside text-gray-800" x-show="!editMode">
                                @if ($user->shower_facility)
                                    <li>Shower</li>
                                @endif
                                @if ($user->parking_space)
                                    <li>Parking</li>
                                @endif
                                @if ($user->changing_room)
                                    <li>Changing Room</li>
                                @endif
                                @if ($user->restaurant)
                                    <li>Restaurant</li>
                                @endif
                                @if ($user->wifi)
                                    <li>WiFi</li>
                                @endif
                                @if ($user->open_ground)
                                    <li>Open Ground</li>
                                @endif
                            </ul>

                            <div x-show="editMode" class="grid sm:grid-cols-2 gap-3">
                                @foreach (['shower_facility', 'parking_space', 'changing_room', 'restaurant', 'wifi', 'open_ground'] as $facility)
                                    <label
                                        class="flex items-center space-x-2 bg-white border rounded-lg p-2 cursor-pointer hover:bg-green-50">
                                        <input type="checkbox" name="{{ $facility }}" value="1"
                                            class="text-green-600 focus:ring-green-500"
                                            {{ $user->$facility ? 'checked' : '' }}>
                                        <span class="capitalize text-gray-700">{{ str_replace('_', ' ', $facility) }}</span>
                                    </label>
                                @endforeach
                            </div>

                        </div>
                    @else
                        @foreach ([['label' => 'Name', 'name' => 'name', 'value' => $user->name], ['label' => 'Email', 'name' => 'email', 'value' => $user->email], ['label' => 'Phone', 'name' => 'phone', 'value' => $user->phone], ['label' => 'Role', 'name' => 'role', 'value' => ucfirst($user->role)]] as $field)
                            <div>
                                <label class="block text-sm font-semibold text-gray-500 mb-1">{{ $field['label'] }}</label>
                                <p class="text-gray-800" x-show="!editMode">{{ $field['value'] }}</p>
                                <input type="text" name="{{ $field['name'] }}" value="{{ $field['value'] }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-700"
                                    x-show="editMode">
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- Password Update Section --}}
                <div class="col-span-2 mt-6 border-t pt-6" x-show="editMode">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Update Password</h3>

                    {{-- Current Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-500 mb-1">Current Password</label>
                        <input type="password" name="current_password" x-model="current_password"
                            @input.debounce.500ms="checkCurrentPassword()"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-700"
                            placeholder="Enter current password">
                        <template x-if="current_password_error">
                            <p class="text-red-600 text-sm mt-1" x-text="current_password_error"></p>
                        </template>
                    </div>

                    {{-- New Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-500 mb-1">New Password</label>
                        <input type="password" name="new_password" x-model="new_password" @input="validatePassword()"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-700"
                            placeholder="Enter new password">
                        <template x-if="new_password_error">
                            <p class="text-red-600 text-sm mt-1" x-text="new_password_error"></p>
                        </template>
                    </div>

                    {{-- Confirm New Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-500 mb-1">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" x-model="confirm_password"
                            @input="validatePassword()"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-700"
                            placeholder="Re-enter new password">
                        <template x-if="confirm_password_error">
                            <p class="text-red-600 text-sm mt-1" x-text="confirm_password_error"></p>
                        </template>
                    </div>
                </div>

                {{-- Save Buttons --}}
                <div class="flex justify-end gap-4 mt-8" x-show="editMode">
                    <button type="submit" :disabled="hasErrors"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 disabled:opacity-50">
                        Save Changes
                    </button>
                    <button type="button" @click="editMode = false"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function profileForm() {
            return {
                editMode: false,
                current_password: '',
                new_password: '',
                confirm_password: '',
                current_password_error: '',
                new_password_error: '',
                confirm_password_error: '',
                hasErrors: false,

                validatePassword() {
                    this.new_password_error = '';
                    this.confirm_password_error = '';
                    this.hasErrors = false;

                    if (this.new_password && this.new_password.length < 8) {
                        this.new_password_error = 'Password must be at least 8 characters.';
                        this.hasErrors = true;
                    }

                    if (this.confirm_password && this.new_password !== this.confirm_password) {
                        this.confirm_password_error = 'Passwords do not match.';
                        this.hasErrors = true;
                    }
                },

                async checkCurrentPassword() {
                    if (!this.current_password) {
                        this.current_password_error = '';
                        this.hasErrors = false;
                        return;
                    }

                    try {
                        const res = await fetch("{{ route('profile.validate-password') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                current_password: this.current_password
                            })
                        });
                        const data = await res.json();
                        if (!data.valid) {
                            this.current_password_error = 'Current password is incorrect.';
                            this.hasErrors = true;
                        } else {
                            this.current_password_error = '';
                            this.hasErrors = false;
                        }
                    } catch (e) {
                        console.error(e);
                    }
                },

                submitForm(event) {
                    this.validatePassword();
                    if (this.hasErrors) return;
                    event.target.submit();
                }
            }
        }
    </script>
@endsection
