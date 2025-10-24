<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        // Only admin can access certain methods
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    // -------------------------
    // PUBLIC METHODS (Everyone)
    // -------------------------
    
    // Show all blogs
    public function index()
    {
        $blogs = Blog::orderBy('date_created', 'desc')->get();

        // Admin sees admin view; others see public view
        if(auth()->check() && auth()->user()->is_admin) {
            return view('admin.blogs.index', compact('blogs'));
        }

        return view('blogs.index', compact('blogs'));
    }

    // Show single blog
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        if(auth()->check() && auth()->user()->is_admin) {
            return view('admin.blogs.show', compact('blog')); // optional admin detail page
        }

        return view('blogs.show', compact('blog'));
    }

    // -------------------------
    // ADMIN METHODS (Admin Only)
    // -------------------------

    // Show form to create a new blog
    public function create()
    {
        return view('admin.blogs.create');
    }

    // Store new blog
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'date_created' => 'required|date',
        ]);

        Blog::create($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    // Show edit form
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    // Update blog
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'date_created' => 'required|date',
        ]);

        $blog->update($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    // Delete blog
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
