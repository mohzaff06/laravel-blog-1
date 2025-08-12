<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'tags'])->get()->sortByDesc('created_at');
        $html = view('posts.index', compact('posts'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }

    public function home()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function getPostsByCategory(Category $category)
    {
        $posts = $category->posts()->with(['user', 'tags'])->get()->sortByDesc('created_at');
        $html = view('posts.index', compact('posts'))->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'body'        => 'required|string|min:3|max:15000',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4056',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts_images', 'public');
        }

        $post = Post::create($validated + ['user_id' => Auth::id()]);

        if (!empty($validated['tags'])) {
            $tags = explode(',', $request->validate(['tags' => 'nullable|string'])['tags']);
            $tagIds = collect($tags)->map(fn($tagName) =>
            Tag::firstOrCreate(['name' => trim($tagName)])->id
            );
            $post->tags()->sync($tagIds);
        }

        return toastResponse(
            type: 'success',
            message: 'Post created successfully!',
            redirectTo: '/post/' . $post->id,
            statusCode: 201,
        );
    }


    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post','categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'body'        => 'required|string|min:3|max:15000',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4056',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $validated['image'] = $request->file('image')->store('posts_images', 'public');
        }

        $post->update($validated);

        if (!empty($validated['tags'])) {
            $tags = explode(',', $request->validate(['tags' => 'nullable|string'])['tags']);
            $tagIds = collect($tags)->map(fn($tagName) =>
            Tag::firstOrCreate(['name' => trim($tagName)])->id
            );
            $post->tags()->sync($tagIds);
        }

        return toastResponse(
            type: 'success',
            message: 'Post updated successfully!',
            redirectTo: '/post/' . $post->id
        );
    }

    public function destroy(Post $post)
    {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->tags()->detach();

        $post->delete();

        return toastResponse(
            type: 'success',
            message: 'Post deleted successfully!',
            redirectTo: '/'
        );
    }
    public function search(Request $request)
    {
        $validated = $request->validate([
            'q' => 'min:0|max:255',
        ]);
        $query = trim($validated['q']);

        $terms = collect(preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY));

        $posts = Post::query()
            ->with(['user', 'tags'])
            ->where(function ($outer) use ($terms) {
                foreach ($terms as $term) {
                    $like = "%{$term}%";
                    $outer->orWhere('title', 'like', $like)
                        ->orWhere('body', 'like', $like)
                        ->orWhereHas('tags', function ($q) use ($like) {
                            $q->where('name', 'like', $like);
                        });
                }
            })
            ->get()
            ->sortByDesc('created_at');

        $html = view('posts.index', compact('posts'))->render();

        return response()->json([
            'status' => true,
            'html'   => $html,
        ]);
    }

}
