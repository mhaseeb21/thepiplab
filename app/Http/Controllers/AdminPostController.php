<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'required|string',
            'type'        => 'required|in:blog,news',
            'cover_image' => 'nullable|image|max:5120', // 5MB
            'is_published'=> 'nullable|boolean',
        ]);

        $slug = Str::slug($data['title']);
        $slug = $this->uniqueSlug($slug);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('posts/covers', 'public');
        }

        $isPublished = $request->boolean('is_published', false);

        Post::create([
            'title'        => $data['title'],
            'slug'         => $slug,
            'excerpt'      => $data['excerpt'] ?? null,
            'content'      => $data['content'],
            'type'         => $data['type'],
            'cover_image'  => $coverPath,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? now() : null,
            'created_by'   => auth()->id(),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'required|string',
            'type'        => 'required|in:blog,news',
            'cover_image' => 'nullable|image|max:5120',
            'is_published'=> 'nullable|boolean',
        ]);

        if ($data['title'] !== $post->title) {
            $base = Str::slug($data['title']);
            $post->slug = $this->uniqueSlug($base, $post->id);
        }

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $post->cover_image = $request->file('cover_image')->store('posts/covers', 'public');
        }

        $post->title = $data['title'];
        $post->excerpt = $data['excerpt'] ?? null;
        $post->content = $data['content'];
        $post->type = $data['type'];

        $newPublished = $request->boolean('is_published', false);
        if ($newPublished && !$post->is_published) {
            $post->published_at = now();
        }
        if (!$newPublished) {
            $post->published_at = null;
        }
        $post->is_published = $newPublished;

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function togglePublish(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->published_at = $post->is_published ? now() : null;
        $post->save();

        return back()->with('success', 'Publish status updated.');
    }

    public function destroy(Post $post)
    {
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }
        $post->delete();

        return back()->with('success', 'Post deleted.');
    }

    private function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base;
        $i = 2;

        while (
            Post::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
