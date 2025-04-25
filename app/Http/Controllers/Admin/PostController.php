<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;

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
    public function store(StoreRequest $request)
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
    public function update(UpdateRequest $request, Post $post)
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
            $this->alert("success", "Post was deleted");
        } else {
            $this->alert("warning", "Post not found");
        }
        return redirect(dashboard_route('dashboard.posts.index'));
    }
}
