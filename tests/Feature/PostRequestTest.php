<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PostRequestTest extends TestCase
{

    public function authenticated()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
    }
    /**
     * A basic feature test example.
    */

    public function testGetPosts()
    {
        $this->authenticated();
        $user = User::factory()->create();
        Post::factory()->count(4)->create(['user_id' => $user->id]);

        $response = $this->get("api/users/{$user->id}/posts");

        $response->assertStatus(200);
        $this->assertCount(4, $response->json('data'));
    }
}
