<?php

namespace App\Http\Controllers;

use App\Models\Futsal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FutsalController extends Controller
{
    public function index() {
        
        $user = Auth::user();
        $futsals = $user->futsals->sortByDesc('created_at');
        return view('futsals.index', compact('futsals', 'user'));
    } 

    public function adminIndex() {
        $futsals = Futsal::latest()->get();
        $user = Auth::user();
        $userCount = User::count();
        return view('futsals.adminIndex', compact('futsals', 'user', 'userCount'));
    }

    public function store(Request $request){
        // validation
        $request->validate([
            'futsal' => 'required|string|max:255',
        ]);

        // save
        Futsal::create([
            'futsal' => $request->futsal,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('futsals.index');
    }

    public function edit(string $id) {
        $futsal = Futsal::findOrFail($id);

        return view('futsals.edit', compact('futsal'));
    }

    public function update(Request $request, string $id) {
        // validation
        $request->validate([
            'futsal' => 'required|string|max:255',
        ]);

        // update
        $futsal = Futsal::findOrFail($id);
        // $futsal->futsal = $request->futsal;
        // $futsal->save();

        $futsal->update([
            'futsal' => $request->futsal,
        ]);

        return redirect()->route('futsals.index');
    }

    public function destroy(string $id) {
        $futsal = Futsal::findOrFail($id);
        $futsal->delete();

        return redirect()->route('futsals.index');
    }
}