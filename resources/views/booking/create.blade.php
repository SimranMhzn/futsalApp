@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6 flex justify-center items-center space-y-6">
        <div class="w-full lg:w-1/3 bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 space-y-4">
            <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="futsal_id" value="{{ $futsal->id }}">
                <input type="hidden" name="start_time" id="start_time">
                <input type="hidden" name="end_time" id="end_time">

                <h2 class="font-semibold text-green-600 text-lg mb-2">Book Your Slot</h2>

                {{-- Date Picker --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Select Date:</label>
                    <input type="date" name="date" id="bookingDate"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required min="{{ date('Y-m-d') }}">
                </div>

                {{-- Futsal Hours Info --}}
                <div class="mb-2 text-green-700">
                    <p><strong>Futsal Hours:</strong> {{ date('h:i A', strtotime($futsal->open_time)) }} -
                        {{ date('h:i A', strtotime($futsal->close_time)) }}</p>
                        <p class="text-sm text-green-900">(Please select valid time schedule as per the openning and closing time.)</p>
                </div>

                {{-- Start Time Picker --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Select Start Time:</label>
                    <input type="text" id="start_time_input"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Select Start Time" required>
                </div>

                {{-- Duration Dropdown --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Select Duration (hours):</label>
                    <select id="duration_select"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="">-- Select Duration --</option>
                        <option value="1">1 hour</option>
                        <option value="2">2 hours</option>
                        <option value="3">3 hours</option>
                    </select>
                </div>

                {{-- Validation Messages --}}
                <p id="dateError" class="text-red-600 text-sm hidden mb-1">Please select a valid date (today or later).</p>
                <p id="timeError" class="text-red-600 text-sm hidden mb-1">Start time or duration is invalid. Booking
                    exceeds futsal closing time.</p>
                <p id="durationError" class="text-red-600 text-sm hidden mb-2">Please select a valid duration.</p>

                {{-- Book Button --}}
                <button type="submit" id="bookButton"
                    class="w-full py-3 rounded text-white font-semibold text-lg bg-gray-400 cursor-not-allowed" disabled>
                    BOOK NOW
                </button>
            </form>
        </div>
    </div>

    {{-- Flatpickr JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize Flatpickr for start time
        flatpickr("#start_time_input", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minuteIncrement: 15,
            allowInput: true,
            minTime: "{{ $futsal->open_time }}",
            maxTime: "{{ $futsal->close_time }}"
        });

        const bookingForm = document.getElementById('bookingForm');
        const dateInput = document.getElementById('bookingDate');
        const startInput = document.getElementById('start_time_input');
        const durationSelect = document.getElementById('duration_select');
        const bookButton = document.getElementById('bookButton');

        const startHidden = document.getElementById('start_time');
        const endHidden = document.getElementById('end_time');

        const dateError = document.getElementById('dateError');
        const timeError = document.getElementById('timeError');
        const durationError = document.getElementById('durationError');

        const futsalOpen = "{{ $futsal->open_time }}";
        const futsalClose = "{{ $futsal->close_time }}";

        function validateForm() {
            let valid = true;

            // Date Validation
            const today = new Date();
            const selectedDate = new Date(dateInput.value);
            if (!dateInput.value || selectedDate < new Date(today.toDateString())) {
                dateError.classList.remove('hidden');
                valid = false;
            } else {
                dateError.classList.add('hidden');
            }

            // Duration Validation
            const duration = parseInt(durationSelect.value);
            if (!duration) {
                durationError.classList.remove('hidden');
                valid = false;
            } else {
                durationError.classList.add('hidden');
            }

            // Start Time Validation
            const startTime = startInput.value;
            if (!startTime) {
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

                if (start < openTime || end > closeTime) {
                    timeError.classList.remove('hidden');
                    valid = false;
                } else {
                    timeError.classList.add('hidden');
                    startHidden.value = startTime;
                    endHidden.value = end.toTimeString().slice(0, 5);
                }
            }

            // Enable/Disable Book Button
            if (valid) {
                bookButton.disabled = false;
                bookButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                bookButton.classList.add('bg-green-600', 'hover:bg-green-700', 'cursor-pointer');
            } else {
                bookButton.disabled = true;
                bookButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                bookButton.classList.remove('bg-green-600', 'hover:bg-green-700', 'cursor-pointer');
            }
        }

        // Event listeners
        dateInput.addEventListener('input', validateForm);
        startInput.addEventListener('input', validateForm);
        durationSelect.addEventListener('input', validateForm);

        // Prevent invalid submission
        bookingForm.addEventListener('submit', function(e) {
            validateForm();
            if (bookButton.disabled) e.preventDefault();
        });

        // Set min date
        const todayISO = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', todayISO);
    </script>
@endsection
