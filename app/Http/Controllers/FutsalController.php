<?php

namespace App\Http\Controllers;

use App\Models\Futsal;
use Illuminate\Http\Request;

class FutsalController extends Controller
{
    // ✅ Show all futsals
    public function index()
    {
        $futsals = Futsal::all();
        return view('futsals.index', compact('futsals'));
    }

    // ✅ Show form to create a new futsal
    public function create()
    {
        return view('futsals.create');
    }

    // ✅ Store new futsal
    public function store(Request $request)
    {
        $request->validate([
    'name' => 'required|string|max:255',
    'phone' => 'required|string|max:20',
    'email' => 'required|email|max:255',
    'price' => 'required|numeric',
    'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
]);

        // 2️⃣ Upload the photo
        $photoUrl = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('futsal_photos', 'public');
            $photoUrl = asset('storage/' . $path);
        }

        // 3️⃣ Save to database
        Futsal::create([
            'name'            => $request->name,
            'phone'           => $request->phone,
            'email'           => $request->email, 
            'price'           => $request->price,
            'location'        => $request->location,
            'link'            => $request->link,
            'side_no'         => $request->side_no,
            'ground_no'       => $request->ground_no,
            'description'     => $request->description,
            'photo'           => $photoUrl,
            'shower_facility' => $request->boolean('shower_facility'),
            'parking_space'   => $request->boolean('parking_space'),
            'changing_room'   => $request->boolean('changing_room'),
            'restaurant'      => $request->boolean('restaurant'),
            'wifi'            => $request->boolean('wifi'),
            'open_ground'     => $request->boolean('open_ground'),
        ]);

        return redirect()->route('futsals.index')->with('success', 'Futsal registered successfully!');
    }

    // ✅ Show one futsal detail
    public function show($id)
    {
        $futsal = Futsal::findOrFail($id);
        return view('futsals.show', compact('futsal'));
    }

    // ✅ Show form to edit futsal
    public function edit($id)
    {
        $futsal = Futsal::findOrFail($id);
        return view('futsals.edit', compact('futsal'));
    }

    // ✅ Update futsal info
    public function update(Request $request, $id)
    {
        $futsal = Futsal::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle new photo if uploaded
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('futsal_photos', 'public');
            $futsal->photo = asset('storage/' . $path);
        }

        $futsal->update($request->except('photo'));

        return redirect()->route('futsals.index')->with('success', 'Futsal updated successfully!');
    }

    // ✅ Delete futsal
    public function destroy($id)
    {
        $futsal = Futsal::findOrFail($id);
        $futsal->delete();

        return redirect()->route('futsals.index')->with('success', 'Futsal deleted successfully!');
    }
}
