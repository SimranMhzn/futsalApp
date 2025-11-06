<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        // Public access for index and show
        $this->middleware('auth')->except(['index', 'show']);

        // Admin-only access for admin management actions (adminIndex, edit, update, destroy)
        // Note: create/store are intentionally not restricted here so they can be
        // reached by route-level middleware for futsal (auth:futsal) or admin (auth,admin).
        $this->middleware('admin')->only(['adminIndex', 'edit', 'update', 'destroy']);
    }

    // -------------------------
    // PUBLIC METHODS
    // -------------------------

    public function index()
    {
        $blogs = Blog::orderBy('date_created', 'desc')->get();

        if (auth()->check() && auth()->user()->is_admin) {
            return view('admin.blogs.index', compact('blogs'));
        }

        return view('blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        if (auth()->check() && auth()->user()->is_admin) {
            return view('admin.blog.show', compact('blog'));
        }

        return view('blogs.show', compact('blog'));
    }

    // -------------------------
    // ADMIN METHODS (Admin Only)
    // -------------------------

    public function create()
    {
        // If an admin is logged in via the default guard, show admin create view
        if (auth()->check() && auth()->user()->is_admin) {
            return view('admin.blogs.create');
        }

        // If a futsal is logged in via futsal guard, return the public blogs.create
        if (\Illuminate\Support\Facades\Auth::guard('futsal')->check()) {
            return view('blogs.create');
        }

        // Fallback to admin create (route-level middleware should normally prevent reaching here)
        return view('admin.blogs.create');
    }

    public function adminIndex()
    {
        $blogs = Blog::orderBy('date_created', 'desc')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function store(Request $request)
    {
        $admin = Auth::user();
        $futsal = Auth::guard('futsal')->user();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'required|string|max:100',
        ]);

        if ($futsal) {
            $validated['author'] = $futsal->name;  
            $validated['role'] = 'futsal';
        } elseif ($admin && $admin->is_admin) {
            $validated['author'] = $admin->name ?? 'Admin';
            $validated['role'] = 'admin';
        } else {
            return back()->with('error', 'Unauthorized access.');
        }

        $validated['date_created'] = now();
        Blog::create($validated);
        if ($futsal) {
            return redirect()->route('futsal.index')
                ->with('success', 'Blog created successfully!');
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully!');
    }


    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'date_created' => 'nullable|date',
        ]);

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}

