@extends('layouts.app')

@section('title', 'Booking History')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    <h1 class="text-3xl font-bold text-green-700 mb-6 text-center">Your Booking History</h1>

    @if($bookings->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow">
                <thead>
                    <tr class="bg-green-600 text-white text-left">
                        <th class="py-3 px-4">Futsal Name</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4">Start Time</th>
                        <th class="py-3 px-4">End Time</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $booking->futsal->name }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                            <td class="py-3 px-4">
                                @if($booking->status === 'pending')
                                    <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full text-sm">Pending</span>
                                @elseif($booking->status === 'booked')
                                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-sm">Booked</span>
                                @elseif($booking->status === 'cancelled')
                                    <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-sm">Cancelled</span>
                                @elseif($booking->status === 'completed')
                                    <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-sm">Completed</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    <button onclick="openUpdateModal({{ $booking->id }}, '{{ $booking->date }}', '{{ \Carbon\Carbon::parse($booking->start_time)->format('H') }}', '{{ \Carbon\Carbon::parse($booking->end_time)->format('H') }}')" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                        Update
                                    </button>
                                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-700 text-center mt-6">You have not made any bookings yet.</p>
    @endif
</div>

{{-- Update Modal --}}
<div id="updateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-green-600">Update Booking</h2>
            <button onclick="closeUpdateModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>

        <form id="updateForm" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Date Picker --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700">Select Date:</label>
                <input type="date" name="date" id="updateDate"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                    required min="{{ date('Y-m-d') }}">
            </div>

            {{-- Time Slots --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700">Select Time:</label>
                <div class="grid grid-cols-3 gap-2" id="updateTimeSlots">
                    @php
                        $hours = [
                            '6-7', '7-8', '8-9', '9-10', '10-11', '11-12',
                            '12-13', '13-14', '14-15', '15-16', '16-17',
                            '17-18', '18-19', '19-20', '20-21',
                        ];
                    @endphp
                    @foreach ($hours as $hour)
                        <button type="button"
                            class="update-time-btn bg-green-50 text-green-700 px-2 py-2 rounded text-sm font-medium transition hover:bg-green-100"
                            data-start="{{ explode('-', $hour)[0] }}" data-end="{{ explode('-', $hour)[1] }}">
                            {{ $hour }}
                        </button>
                    @endforeach
                </div>
            </div>

            <input type="hidden" name="start_time" id="update_start_time">
            <input type="hidden" name="end_time" id="update_end_time">

            <div class="flex space-x-3">
                <button type="button" onclick="closeUpdateModal()" 
                    class="flex-1 py-2 rounded border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" id="updateBookButton"
                    class="flex-1 py-2 rounded text-white font-semibold bg-gray-400 cursor-not-allowed" disabled>
                    Update Booking
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const updateModal = document.getElementById('updateModal');
    const updateForm = document.getElementById('updateForm');
    const updateDateInput = document.getElementById('updateDate');
    const updateTimeButtons = document.querySelectorAll('.update-time-btn');
    const updateBookButton = document.getElementById('updateBookButton');
    const updateStartTimeInput = document.getElementById('update_start_time');
    const updateEndTimeInput = document.getElementById('update_end_time');

    let updateSelectedDate = null;
    let updateSelectedStart = null;
    let updateSelectedEnd = null;

    function openUpdateModal(bookingId, date, startTime, endTime) {
        updateModal.classList.remove('hidden');
        updateModal.classList.add('flex');
        
        // Set form action
        updateForm.action = `/booking/${bookingId}`;
        
        // Set date
        updateDateInput.value = date;
        updateSelectedDate = date;
        
        // Highlight selected time slot
        updateTimeButtons.forEach(btn => {
            btn.classList.remove('bg-green-700', 'text-white');
            btn.classList.add('bg-green-50', 'text-green-700');
            
            if (btn.dataset.start === startTime && btn.dataset.end === endTime) {
                btn.classList.add('bg-green-700', 'text-white');
                btn.classList.remove('bg-green-50', 'text-green-700');
            }
        });
        
        updateSelectedStart = startTime;
        updateSelectedEnd = endTime;
        updateStartTimeInput.value = startTime;
        updateEndTimeInput.value = endTime;
        
        toggleUpdateButton();
    }

    function closeUpdateModal() {
        updateModal.classList.add('hidden');
        updateModal.classList.remove('flex');
        updateSelectedDate = null;
        updateSelectedStart = null;
        updateSelectedEnd = null;
    }

    // Handle date change
    updateDateInput.addEventListener('change', function() {
        updateSelectedDate = this.value;
        toggleUpdateButton();
    });

    // Handle time selection
    updateTimeButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            updateTimeButtons.forEach(b => b.classList.remove('bg-green-700', 'text-white'));
            updateTimeButtons.forEach(b => b.classList.add('bg-green-50', 'text-green-700'));

            this.classList.add('bg-green-700', 'text-white');
            this.classList.remove('bg-green-50', 'text-green-700');

            updateSelectedStart = this.dataset.start;
            updateSelectedEnd = this.dataset.end;
            updateStartTimeInput.value = updateSelectedStart;
            updateEndTimeInput.value = updateSelectedEnd;

            toggleUpdateButton();
        });
    });

    function toggleUpdateButton() {
        if (updateSelectedDate && updateSelectedStart && updateSelectedEnd) {
            updateBookButton.disabled = false;
            updateBookButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
            updateBookButton.classList.add('bg-green-600', 'hover:bg-green-700', 'cursor-pointer');
        } else {
            updateBookButton.disabled = true;
            updateBookButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            updateBookButton.classList.remove('bg-green-600', 'hover:bg-green-700', 'cursor-pointer');
        }
    }

    // Close modal when clicking outside
    updateModal.addEventListener('click', function(e) {
        if (e.target === updateModal) {
            closeUpdateModal();
        }
    });

    // Set minimum date
    const today = new Date().toISOString().split('T')[0];
    updateDateInput.setAttribute('min', today);
</script>
@endsection