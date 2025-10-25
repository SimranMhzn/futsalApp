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

        // Admin-only access for CRUD
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
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
        return view('admin.blogs.create');
    }

    public function adminIndex()
    {
        $blogs = Blog::orderBy('date_created', 'desc')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $guard = Auth::guard('futsal')->user(); // check if futsal user is logged in

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'date_created' => 'required|date',
        ]);

        // Set author automatically if futsal user
        if ($guard) {
            $validated['author'] = $guard->name; // assuming futsal model has name field
        } elseif ($user && $user->is_admin) {
            $validated['author'] = $request->author ?? 'Admin';
        }

        // Optionally, store role
        $validated['role'] = $guard ? 'futsal' : 'admin';

        Blog::create($validated);

        if ($guard) {
            return redirect()->route('futsal.index')->with('success', 'Blog created successfully!');
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
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

