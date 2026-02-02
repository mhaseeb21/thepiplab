<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('public.posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('public.posts.show', compact('post'));
    }
}
