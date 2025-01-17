<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.pages.post.list', [
            'items' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.post.create', [
            'types' => Post::STATUSES,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.pages.post.edit', [
            'item' => $post,
            'status' => $post->status,
            'statuses' => Post::STATUSES,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post) {
            $post->deleteTranslations();
            if ($post->image) {
                $post->image->delete();
            }
            $post->delete();
            session()->flash("success", "Post was deleted");
        } else {
            session()->flash("warning", "Post not found");
        }
        return redirect(dashboard_route('dashboard.posts.index'));
    }
}
