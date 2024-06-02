<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get The Users Request
     *
     * @return void
     */
    public function testGetUsers() : void
    {
        User::factory()->count(3)->create();
        $response = $this->get('/api/users');
        $this->assertCount(3, $response->json('data'));
    }

    /**
     * Create The User Request 
     * 
     * @return void
     */

    public function testCreateUser() : void
     {
        $userFormRequest = [
            "name" => "zobir",
            "email" => "zobirofkif@gmail.com",
            "password" => "zobirO123@@@"
        ];
        
        $response = $this->post('/api/users', $userFormRequest);
        $response->assertStatus(201);
     }

     /**
      * create update Request
      *
      * @return void
      */
     public function testUserUpdate() : void
     {
        $userForm = [
            "name" => "zobirofk",
            "email" => "zobirofkirA8@gmail.com",
            "password" => "This is me Holla"
        ];

        $user = User::factory()->create();

        $response = $this->put("/api/users/$user->id", $userForm);
        $response->assertStatus(200);
     }


     /**
      * Create Delete Request
      *
      * @return void
      */
     public function testUserDelete() : void
     {
        $user = User::factory()->create();
        $response = $this->delete("/api/users/$user->id");
        $response->assertStatus(200);
     }
}
