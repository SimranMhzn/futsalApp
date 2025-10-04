@extends('layouts.app')

@section('title', 'register')

@section('content')
<div class="mt-8 flex flex-col items-center">
    <form class="w-full max-w-xl bg-green-50 p-6 rounded-xl shadow-lg space-y-6"
          action="{{ route('register') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf

        <h2 class="text-center text-xl font-bold text-green-950 mb-4">
            Futsal Owner Registration Form
        </h2>

        <div class="flex flex-col items-center">
            <img id="photoPreview" 
                 src="/images/default-futsal.png" 
                 class="w-32 h-32 rounded-full object-cover border border-green-300 mb-3" />
            <input type="file" id="photo" name="photo" class="hidden" accept="image/*" 
                   onchange="previewPhoto(event)" />
            <label for="photo" class="cursor-pointer px-4 py-2 bg-yellow-300 text-green-900 rounded hover:bg-yellow-400 font-semibold">
                Upload Logo
            </label>
        </div>

        <div>
            <label for="name" class="block mb-1 text-sm font-semibold text-green-900">Futsal Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="w-full p-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                   placeholder="Enter futsal name" required />
        </div>

        <div>
            <label for="email" class="block mb-1 text-sm font-semibold text-green-900">Email Address</label>
            <input type="email" id="email" name="email" 
                   pattern="[a-zA-Z0-9._%+-]+@gmail\.com" 
                   class="w-full p-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500" 
                   placeholder="Enter futsal's Gmail address" required />
        </div>

        <div>
            <label for="phone" class="block mb-1 text-sm font-semibold text-green-900">Contact Number</label>
            <input type="tel" id="phone" name="phone"
                   maxlength="10"
                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                   pattern="(01\d{7}|[0-9]{10})" 
                   class="w-full p-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                   placeholder="Enter contact number" required />
        </div>

        <div>
            <label for="price_time" class="block mb-1 text-sm font-semibold text-green-900">Price / Time</label>
            <input type="text" id="price_time" name="price_time" value="{{ old('price_time') }}"
                   class="w-full p-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                   placeholder="e.g. 1000 per hour" required />
        </div>

        <div>
            <label for="description" class="block mb-1 text-sm font-semibold text-green-900">Description</label>
            <textarea id="description" name="description"
                      class="w-full p-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                      placeholder="Enter futsal description" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 text-sm font-semibold text-green-900">Available Services</label>
            <div class="flex flex-wrap gap-4">
                <label class="flex items-center gap-1">
                    <input type="checkbox" name="services[]" value="Changing Room"> Changing Room
                </label>
                <label class="flex items-center gap-1">
                    <input type="checkbox" name="services[]" value="Parking"> Parking
                </label>
                <label class="flex items-center gap-1">
                    <input type="checkbox" name="services[]" value="Cafeteria"> Cafeteria
                </label>
                <label class="flex items-center gap-1">
                    <input type="checkbox" name="services[]" value="Equipment Rental"> Equipment Rental
                </label>
            </div>
        </div>

        <div>
            <label for="location" class="block mb-1 text-sm font-semibold text-green-900">Location</label>
            <input type="text" id="location" name="location" 
                   value="{{ old('location') }}"
                   class="w-full p-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                   placeholder="Enter your futsal location" required />
        </div>

        <div>
            <button type="submit" class="w-full py-2.5 bg-green-700 hover:bg-green-800 text-white font-bold rounded-lg shadow-md transition duration-150">
                Register
            </button>
        </div>
    </form>
</div>

<script>
function previewPhoto(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('photoPreview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
