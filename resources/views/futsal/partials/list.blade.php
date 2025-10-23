@if($futsals->isEmpty())
    <p class="text-center text-gray-500 text-lg">No futsals found.</p>
@else
    <div class="space-y-6">
        @foreach($futsals as $futsal)
        <div class="flex flex-col md:flex-row bg-white shadow rounded-lg overflow-hidden">
            
            <!-- Futsal Image -->
            <div class="md:w-1/3">
                @if($futsal->photo)
                    <img src="{{ $futsal->photo }}" alt="{{ $futsal->name }}" class="w-full h-56 object-cover">
                @else
                    <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">
                        No Image
                    </div>
                @endif
            </div>

            <!-- Futsal Details -->
            <div class="p-6 flex flex-col justify-between md:w-2/3">
                <div>
                    <h2 class="text-xl font-bold mb-1">{{ $futsal->name }}</h2>
                    <p class="text-gray-600 mb-2">📍 {{ $futsal->location }}</p>
                    <p class="text-gray-500 mb-2">Phone: {{ $futsal->phone }}</p>
                    @if(!empty($futsal->email))
                        <p class="text-gray-500 mb-2">Email: {{ $futsal->email }}</p>
                    @endif

                    <!-- Facilities -->
                    <div class="flex flex-wrap gap-2 mt-3">
                        @if($futsal->shower_facility)
                            <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-md">Shower</span>
                        @endif
                        @if($futsal->parking_space)
                            <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-md">Parking</span>
                        @endif
                        @if($futsal->changing_room)
                            <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-md">Changing Room</span>
                        @endif
                        @if($futsal->restaurant)
                            <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-md">Restaurant</span>
                        @endif
                        @if($futsal->wifi)
                            <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-md">WiFi</span>
                        @endif
                        @if($futsal->open_ground)
                            <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-md">Open Ground</span>
                        @endif
                    </div>
                </div>

                <!-- Price & Booking Button -->
                <div class="flex justify-between items-center mt-6">
                    <p class="text-green-700 text-2xl font-bold">
                        Rs. {{ number_format($futsal->price) }} 
                        <span class="text-gray-500 text-sm font-normal">per hour</span>
                    </p>
                    <a href="{{ route('futsal.show', $futsal->id) }}" 
                       class="bg-gray-100 hover:bg-gray-200 text-gray-900 font-semibold px-6 py-2 rounded-md transition">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
