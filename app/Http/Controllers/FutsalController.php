<?php

namespace App\Http\Controllers;

use App\Models\Futsal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FutsalController extends Controller
{
    public function index(Request $request)
{
    $query = Futsal::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('name', 'like', "%$search%")
              ->orWhere('location', 'like', "%$search%");
    }

    $futsals = $query->get()->map(function ($futsal) {
        $futsal->photo = $futsal->photo ? asset('storage/' . $futsal->photo) : null;
        return $futsal;
    });

    // Return partial for AJAX request
    if ($request->ajax()) {
        return view('futsal.partials.list', compact('futsals'));
    }

    return view('futsal.index', compact('futsals'));
}


    public function create()
    {
        return view('futsals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'price' => 'required|numeric',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
            'side_no' => 'nullable|numeric',
            'ground_no' => 'nullable|numeric',
            'location' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['role'] = 'futsal';

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('futsal_photos', 'public');
        }

        $checkboxes = ['shower_facility', 'parking_space', 'changing_room', 'restaurant', 'wifi', 'open_ground'];
        foreach ($checkboxes as $cb) {
            $data[$cb] = $request->has($cb) ? 1 : 0;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        Futsal::create($data);

        return redirect()->route('futsal.index')->with('success', 'Futsal registered successfully!');
    }

    public function show($id)
    {
        $futsal = Futsal::findOrFail($id);
        return view('futsal.show', compact('futsal'));
    }

    public function edit($id)
    {
        $futsal = Futsal::findOrFail($id);
        return view('futsal.edit', compact('futsal'));
    }

    public function update(Request $request, $id)
    {
        $futsal = Futsal::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($request->hasFile('photo')) {
            $futsal->photo = $request->file('photo')->store('futsal_photos', 'public');
        }

        $data = $request->except('photo');

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $checkboxes = ['shower_facility', 'parking_space', 'changing_room', 'restaurant', 'wifi', 'open_ground'];
        foreach ($checkboxes as $cb) {
            $data[$cb] = $request->has($cb) ? 1 : 0;
        }

        $futsal->update($data);

        return redirect()->route('futsal.index')->with('success', 'Futsal updated successfully!');
    }

    public function destroy($id)
    {
        $futsal = Futsal::findOrFail($id);
        $futsal->delete();

        return redirect()->route('futsal.index')->with('success', 'Futsal deleted successfully!');
    }
}
