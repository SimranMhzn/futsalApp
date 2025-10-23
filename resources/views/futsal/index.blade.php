@extends('layouts.app')

@section('content')
<section class="relative">

    <!-- Header -->
    <div class="bg-emerald-800 text-white px-14 py-24 items-center">
        <h1 class="mb-4 text-3xl font-bold md:text-5xl">Find Futsals</h1>
        <p class="mb-8 text-lg md:text-xl">Discover and book the best futsal courts in your area</p>
    </div>

    <div class="py-10 px-6 max-w-5xl mx-auto">

        <!-- Search -->
        <input
            type="text"
            id="searchInput"
            placeholder="Search by name or location..."
            class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-green-500 mb-6"
        />

        <!-- Futsal Listings -->
        <div id="futsalList">
            @include('futsal.partials.list', ['futsals' => $futsals])
        </div>

    </div>

</section>

<!-- AJAX Script -->
<script>
    const searchInput = document.getElementById('searchInput');
    const futsalList = document.getElementById('futsalList');

    searchInput.addEventListener('input', function() {
        const query = this.value;

        fetch(`{{ route('futsal.index') }}?search=${query}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            futsalList.innerHTML = html;
        })
        .catch(err => console.error(err));
    });
</script>
@endsection
