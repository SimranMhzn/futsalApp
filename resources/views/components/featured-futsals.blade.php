@php
$futsals = [
    [
        'id' => 1,
        'name' => 'Imperial rulz futsal',
        'location' => 'Sagbari, Kaushaltar',
        'price' => 1200,
        'image' => '/futsalCover1.webp',
        'rating' => null,
    ],
    [
        'id' => 2,
        'name' => 'Budhhanagar Futsal',
        'location' => 'Sankhamul, Kathmandu',
        'price' => 1500,
        'image' => '/futsalCover2.webp',
        'rating' => null,
    ],
];
@endphp

<x-featured-futsals :futsals="$futsals" onFindFutsals="{{ route('futsals.index') }}" />
