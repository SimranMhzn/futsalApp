<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function __construct()
    {
        // Admin-only access for admin management actions (adminIndex, edit, update, destroy)
        // NOTE: We intentionally do NOT attach the generic 'auth' middleware here because
        // futsal routes use the 'auth:futsal' guard at the route level. Having a global
        // 'auth' middleware would prevent futsal-guarded routes from working.
        $this->middleware('admin')->only(['adminIndex', 'edit', 'update', 'destroy']);
    }

    // -------------------------
    // PUBLIC METHODS
    // -------------------------

    public function index()
    {
        $blogs = Blog::orderBy('date_created', 'desc')->get();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.blogs.index', compact('blogs'));
        }

        return view('blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        if (auth()->check() && auth()->user()->role === 'admin') {
            // admin views are under admin.blogs.*
            return view('admin.blogs.show', compact('blog'));
        }

        return view('blogs.show', compact('blog'));
    }

    // -------------------------
    // ADMIN METHODS (Admin Only)
    // -------------------------

    public function create()
    {
        // If an admin is logged in via the default guard, show admin create view
        if (auth()->check() && auth()->user()->role === 'admin') {
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
        // Debug: log auth state at the start of store to help track unexpected logouts
        Log::info('BlogController@store called', [
            'auth_check_default' => Auth::check(),
            'auth_user_default_id' => optional(Auth::user())->id,
            'auth_guard_futsal_check' => Auth::guard('futsal')->check(),
            'auth_guard_futsal_id' => optional(Auth::guard('futsal')->user())->id,
            'session_id' => $request->session()->getId(),
        ]);

        $admin = Auth::user();
        $futsal = Auth::guard('futsal')->user();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'required|string|max:100',
        ]);
        // Build only the attributes that exist on the blogs table / model
        if ($futsal) {
            $author = $futsal->name;
        } elseif ($admin && ($admin->role ?? null) === 'admin') {
            $author = $admin->name ?? 'Admin';
        } else {
            return back()->with('error', 'Unauthorized access.');
        }

        $blogData = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'location' => $validated['location'],
            'author' => $author,
            'date_created' => now(),
        ];

        Blog::create($blogData);

        // Log after create to capture state post-write
        Log::info('BlogController@store completed create', [
            'auth_check_default_post' => Auth::check(),
            'auth_user_default_id_post' => optional(Auth::user())->id,
            'auth_guard_futsal_check_post' => Auth::guard('futsal')->check(),
            'auth_guard_futsal_id_post' => optional(Auth::guard('futsal')->user())->id,
            'session_id_post' => $request->session()->getId(),
        ]);
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

