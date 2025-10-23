@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6 flex justify-center items-center space-y-6 ">
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

                {{-- Time Slots --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Select Time:</label>
                    <div class="grid grid-cols-3 gap-2" id="timeSlots">
                        @php
                            $hours = [
                                '6-7',
                                '7-8',
                                '8-9',
                                '9-10',
                                '10-11',
                                '11-12',
                                '12-13',
                                '13-14',
                                '14-15',
                                '15-16',
                                '16-17',
                                '17-18',
                                '18-19',
                                '19-20',
                                '20-21',
                            ];
                        @endphp
                        @foreach ($hours as $hour)
                            <button type="button"
                                class="time-btn bg-green-50 text-green-700 px-2 py-2 rounded text-sm font-medium transition"
                                data-start="{{ explode('-', $hour)[0] }}" data-end="{{ explode('-', $hour)[1] }}">
                                {{ $hour }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <button type="submit" id="bookButton"
                    class="w-full py-3 rounded text-white font-semibold text-lg bg-gray-400 cursor-not-allowed" disabled>
                    BOOK NOW
                </button>
            </form>
        </div>
    </div>

    <script>
        const dateInput = document.getElementById('bookingDate');
        const timeButtons = document.querySelectorAll('.time-btn');
        const bookButton = document.getElementById('bookButton');
        const startTimeInput = document.getElementById('start_time');
        const endTimeInput = document.getElementById('end_time');

        let selectedDate = null;
        let selectedStart = null;
        let selectedEnd = null;

        // Handle date change
        dateInput.addEventListener('change', function() {
            selectedDate = this.value;
            toggleBookButton();
        });

        // Handle time selection
        timeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Deselect all buttons
                timeButtons.forEach(b => b.classList.remove('bg-green-700', 'text-white'));
                timeButtons.forEach(b => b.classList.add('bg-green-50', 'text-green-700'));

                // Select current button
                this.classList.add('bg-green-700', 'text-white');
                this.classList.remove('bg-green-50', 'text-green-700');

                // Set hidden inputs
                selectedStart = this.dataset.start;
                selectedEnd = this.dataset.end;
                startTimeInput.value = selectedStart;
                endTimeInput.value = selectedEnd;

                toggleBookButton();
            });
        });

        function toggleBookButton() {
            if (selectedDate && selectedStart && selectedEnd) {
                bookButton.disabled = false;
                bookButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                bookButton.classList.add('bg-green-600', 'hover:bg-green-700', 'cursor-pointer');
            } else {
                bookButton.disabled = true;
                bookButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                bookButton.classList.remove('bg-green-600', 'hover:bg-green-700', 'cursor-pointer');
            }
        }

        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    </script>
@endsection
