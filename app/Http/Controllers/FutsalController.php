<?php

namespace App\Http\Controllers;

use App\Models\Futsal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FutsalController extends Controller
{
    // Return all futsals of the logged-in user
    public function index()
    {
        $futsals = Futsal::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return response()->json($futsals);
    }

    // Example store method for futsal registration
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'price' => 'nullable|numeric',
            'location' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'side_no' => 'nullable|integer',
            'ground_no' => 'nullable|integer',
            'description' => 'nullable|string',
            'photo.*' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $futsal = new Futsal($validated);
        $futsal->user_id = Auth::id();

        // Amenities
        $amenities = ['shower_facility','parking_space','changing_room','restaurant','wifi','open_ground'];
        foreach ($amenities as $amenity) {
            $futsal->$amenity = $request->has($amenity);
        }

        if ($request->hasFile('photo')) {
            $photos = [];
            foreach ($request->file('photo') as $file) {
                $path = $file->store('futsal_photos', 'public');
                $photos[] = asset('storage/' . $path);
            }
            $futsal->photo = $photos;
        }

        $futsal->save();

        return response()->json(['message' => 'Futsal registered successfully', 'futsal' => $futsal], 201);
    }
}
