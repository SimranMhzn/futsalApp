<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Futsal;
use App\Models\Blog;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with stats and recent activity.
     */
    public function dashboard()
    {
        // Basic stats
        $userCount = User::count();
        $futsalCount = Futsal::where('status', 'approved')->count();
        $pendingFutsals = Futsal::where('status', 'pending')->count();
        $blogCount = Blog::count();

        // Recent activity (optional)
        $recentUsers = User::latest()->take(5)->get();
        $recentFutsals = Futsal::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'userCount',
            'futsalCount',
            'pendingFutsals',
            'blogCount',
            'recentUsers',
            'recentFutsals'
        ));
    }
    public function create()
    {
        return view('admin.create');
    }

    // Store new blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'location' => 'nullable|string|max:100',
            'date_created' => 'required|date',
        ]);

        Blog::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => $request->input('author'),
            'location' => $request->input('location'),
            'date_created' => $request->input('date_created'),
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully!');
    }
}
