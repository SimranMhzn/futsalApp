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
        $query = Futsal::where('status', 'approved');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('location', 'like', "%$search%");
            });
        }

        $futsals = $query->get()->map(function ($futsal) {
            $futsal->photo = $futsal->photo ? asset('storage/' . $futsal->photo) : null;
            return $futsal;
        });

        if ($request->ajax()) {
            return view('futsal.partials.list', compact('futsals'));
        }

        return view('futsal.index', compact('futsals'));
    }

    public function dashboard()
    {
        $futsal = auth()->guard('futsal')->user();
        return view('futsal.dashboard', compact('futsal'));
    }


    public function create()
    {
        return view('futsals.create');
    }

    public function store(Request $request)
{
    // Validation
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
        'open_hour' => 'required|integer|between:0,23',
        'open_minute' => 'required|integer|between:0,59',
        'close_hour' => 'required|integer|between:0,23',
        'close_minute' => 'required|integer|between:0,59',
    ]);

    // Prepare data
    $data = $request->except('photo', 'open_hour', 'open_minute', 'close_hour', 'close_minute');
    $data['user_id'] = Auth::id();
    $data['role'] = 'futsal';
    $data['status'] = 'pending';

    // Combine hour and minute into HH:MM
    $data['open_time'] = sprintf('%02d:%02d', $request->open_hour, $request->open_minute);
    $data['close_time'] = sprintf('%02d:%02d', $request->close_hour, $request->close_minute);

    // Handle photo
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('futsal_photos', 'public');
    }

    // Handle checkboxes
    $checkboxes = ['shower_facility', 'parking_space', 'changing_room', 'restaurant', 'wifi', 'open_ground'];
    foreach ($checkboxes as $cb) {
        $data[$cb] = $request->has($cb) ? 1 : 0;
    }

    // Handle password
    if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    }

    Futsal::create($data);

    return redirect()->route('futsal.index')->with('success', 'Futsal registered successfully!');
}


public function update(Request $request, $id)
{
    $futsal = Futsal::findOrFail($id);

    // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'price' => 'required|numeric',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'password' => 'nullable|string|min:6|confirmed',
        'open_hour' => 'required|integer|between:0,23',
        'open_minute' => 'required|integer|between:0,59',
        'close_hour' => 'required|integer|between:0,23',
        'close_minute' => 'required|integer|between:0,59',
    ]);

    $data = $request->except('photo', 'password', 'open_hour', 'open_minute', 'close_hour', 'close_minute');

    // Combine hour and minute into HH:MM
    $data['open_time'] = sprintf('%02d:%02d', $request->open_hour, $request->open_minute);
    $data['close_time'] = sprintf('%02d:%02d', $request->close_hour, $request->close_minute);

    // Handle photo
    if ($request->hasFile('photo')) {
        $futsal->photo = $request->file('photo')->store('futsal_photos', 'public');
    }

    // Handle checkboxes
    $checkboxes = ['shower_facility', 'parking_space', 'changing_room', 'restaurant', 'wifi', 'open_ground'];
    foreach ($checkboxes as $cb) {
        $data[$cb] = $request->has($cb) ? 1 : 0;
    }

    // Handle password
    if (!empty($request->password)) {
        $data['password'] = Hash::make($request->password);
    }

    $futsal->update($data);

    return redirect()->route('futsal.index')->with('success', 'Futsal updated successfully!');
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

    public function destroy($id)
    {
        $futsal = Futsal::findOrFail($id);
        $futsal->delete();

        return redirect()->route('futsal.index')->with('success', 'Futsal deleted successfully!');
    }
    public function pendingFutsals()
    {
        $futsals = Futsal::where('status', 'pending')->get();
        return view('admin.futsals.pending', compact('futsals'));
    }

    public function approveFutsal($id)
    {
        $futsal = Futsal::findOrFail($id);
        $futsal->update(['status' => 'approved']);

        return back()->with('success', 'Futsal approved successfully.');
    }

    public function rejectFutsal($id)
    {
        $futsal = Futsal::findOrFail($id);
        $futsal->update(['status' => 'rejected']);

        return back()->with('error', 'Futsal rejected.');
    }


}
