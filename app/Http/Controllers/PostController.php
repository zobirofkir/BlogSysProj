<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index(User $user)
    {
        return PostResource::collection( $user->posts );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request, User $user)
    {
        $post = Post::create(array_merge(
            $request->validated(),
            ['user_id' => $user->id]
        ));
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $request->validated();
        return PostResource::make(
            $post->refresh()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return $post->delete();
    }
}
