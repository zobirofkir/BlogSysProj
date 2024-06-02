<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Get Post
     *
     * @return void
     */
    public function testGetPosts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            "user_id" => $user->id
        ]);
        $this->assertDatabaseHas("posts", $post->toArray());
    }

    /**
     * Test Create Post
     *
     * @return void
     */
    public function testCreatePost()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);
        $this->assertDatabaseHas('posts', $post->toArray());
    }

    /**
     * Test Show Post
     *
     * @return void
     */
    public function testShowPost()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            "user_id" => $user->id
        ]);
        $id = $post->id;
        $this->assertDatabaseHas('posts', ["id" => $id]);
    }

    /**
     * Test Update Post
     *
     * @return void
     */
    public function testUpdatePost()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            "user_id" => $user->id
        ]);
        $formUpdate = [
            "title" => "zobir",
            "image" => "http/zobir/ofkir.png",
            "description" => "hello world"
        ];

        $post->update($formUpdate);
        $this->assertDatabaseHas('posts', $post->toArray());
    }

    /**
     * Test Delete Post
     *
     * @return void
     */
    public function testDeletePost()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            "user_id" => $user->id
        ]);

        $id = $post->id;

        $post->delete();
        $this->assertDatabaseMissing('posts', ['id' => $id]);
    }
}
