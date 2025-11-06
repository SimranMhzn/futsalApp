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
                                    <button onclick="openUpdateModal(
                                        {{ $booking->id }},
                                        '{{ $booking->date }}',
                                        '{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}',
                                        '{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}'
                                    )"
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

            {{-- Start Time Picker --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700">Select Start Time:</label>
                <input type="text" id="updateStartTimeInput" placeholder="Select Start Time"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            {{-- Duration Dropdown --}}
            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700">Select Duration (hours):</label>
                <select id="updateDurationSelect" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="">-- Select Duration --</option>
                    <option value="1">1 hour</option>
                    <option value="2">2 hours</option>
                    <option value="3">3 hours</option>
                </select>
            </div>

            {{-- Validation Messages --}}
            <p id="updateDateError" class="text-red-600 text-sm hidden mb-1">Please select a valid date (today or later).</p>
            <p id="updateTimeError" class="text-red-600 text-sm hidden mb-1">Start time or duration is invalid. Booking exceeds futsal closing time.</p>
            <p id="updateDurationError" class="text-red-600 text-sm hidden mb-2">Please select a valid duration.</p>

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

{{-- Flatpickr + Validation JS --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
const updateForm = document.getElementById('updateForm');
const updateDateInput = document.getElementById('updateDate');
const startInput = document.getElementById('updateStartTimeInput');
const durationSelect = document.getElementById('updateDurationSelect');
const updateStartHidden = document.getElementById('update_start_time');
const updateEndHidden = document.getElementById('update_end_time');

const dateError = document.getElementById('updateDateError');
const timeError = document.getElementById('updateTimeError');
const durationError = document.getElementById('updateDurationError');
const updateBookButton = document.getElementById('updateBookButton');

// Set futsal hours (replace with actual futsal hours if needed)
const futsalOpen = "{{ $futsal->open_time ?? '06:00' }}";
const futsalClose = "{{ $futsal->close_time ?? '21:00' }}";

// Initialize Flatpickr
flatpickr("#updateStartTimeInput", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    minuteIncrement: 15,
    allowInput: true,
    minTime: futsalOpen,
    maxTime: futsalClose
});

// Function to calculate end_time and update hidden fields
function updateEndTime() {
    const startTime = startInput.value; // Flatpickr input value
    const duration = parseInt(durationSelect.value);

    if (startTime && duration) {
        const [hour, minute] = startTime.split(':').map(Number);
        const start = new Date();
        start.setHours(hour, minute, 0, 0);

        // Calculate end time
        const end = new Date(start.getTime() + duration * 60 * 60 * 1000);

        // Update hidden fields
        updateStartHidden.value = startTime;
        updateEndHidden.value = end.toTimeString().slice(0,5);
    }
}

// Validate modal form
function validateUpdateForm() {
    let valid = true;

    // Date validation
    const today = new Date();
    const selectedDate = new Date(updateDateInput.value);
    if(!updateDateInput.value || selectedDate < new Date(today.toDateString())) {
        dateError.classList.remove('hidden');
        valid = false;
    } else dateError.classList.add('hidden');

    // Duration validation
    const duration = parseInt(durationSelect.value);
    if(!duration) {
        durationError.classList.remove('hidden');
        valid = false;
    } else durationError.classList.add('hidden');

    // Time validation
    const startTime = startInput.value;
    if(!startTime) {
        timeError.classList.remove('hidden');
        valid = false;
    } else {
        const [hour, minute] = startTime.split(':').map(Number);
        const start = new Date();
        start.setHours(hour, minute);

        const end = new Date(start.getTime() + duration * 60 * 60 * 1000);

        const [closeHour, closeMinute] = futsalClose.split(':').map(Number);
        const closeTime = new Date();
        closeTime.setHours(closeHour, closeMinute);

        const [openHour, openMinute] = futsalOpen.split(':').map(Number);
        const openTime = new Date();
        openTime.setHours(openHour, openMinute);

        if(start < openTime || end > closeTime) {
            timeError.classList.remove('hidden');
            valid = false;
        } else {
            timeError.classList.add('hidden');
            updateStartHidden.value = startTime;
            updateEndHidden.value = end.toTimeString().slice(0,5);
        }
    }

    // Enable/disable update button
    if(valid) {
        updateBookButton.disabled = false;
        updateBookButton.classList.remove('bg-gray-400','cursor-not-allowed');
        updateBookButton.classList.add('bg-green-600','hover:bg-green-700','cursor-pointer');
    } else {
        updateBookButton.disabled = true;
        updateBookButton.classList.add('bg-gray-400','cursor-not-allowed');
        updateBookButton.classList.remove('bg-green-600','hover:bg-green-700','cursor-pointer');
    }
}

// Event listeners
updateDateInput.addEventListener('input', validateUpdateForm);
startInput.addEventListener('input', () => {
    updateEndTime();
    validateUpdateForm();
});
durationSelect.addEventListener('change', () => {
    updateEndTime();
    validateUpdateForm();
});
updateForm.addEventListener('submit', function(e){
    validateUpdateForm();
    if(updateBookButton.disabled) e.preventDefault();
});

// Modal open/close
const updateModal = document.getElementById('updateModal');
function openUpdateModal(bookingId, date, startTime, endTime) {
    updateModal.classList.remove('hidden');
    updateModal.classList.add('flex');
    updateForm.action = `/booking/${bookingId}`;

    // Set date
    updateDateInput.value = date;

    // Set start time in flatpickr
    startInput._flatpickr.setDate(startTime);

    // Calculate duration
    const [sh, sm] = startTime.split(':').map(Number);
    const [eh, em] = endTime.split(':').map(Number);
    const duration = (parseInt(eh) - parseInt(sh)) + ((parseInt(em) - parseInt(sm))/60);
    durationSelect.value = duration;

    updateEndTime();
    validateUpdateForm();
}

function closeUpdateModal() {
    updateModal.classList.add('hidden');
    updateModal.classList.remove('flex');
}

// Set minimum date
updateDateInput.setAttribute('min', new Date().toISOString().split('T')[0]);
</script>
@endsection
