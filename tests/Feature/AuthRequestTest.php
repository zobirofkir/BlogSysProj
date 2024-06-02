<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class AuthRequestTest extends TestCase
{
    /**
     * A basic feature test example.
    */

    public function testLoginUser()
    {
        $user = User::factory()->create([
            "name" => "zobir",
            "email" => "zobirofkir19@gmail.com",
            "password" => bcrypt("password")
        ]);

        $clientRepository = new ClientRepository();
        $clientRepository->createPersonalAccessClient( null, 'token', url('/api/logout') );

        $user->createToken("testToken")->accessToken;


        $loginForm = [
            "email" => "zobirofkir19@gmail.com",
            "password" => "password"
        ];

        $response = $this->post("/api/login", $loginForm);
        $response->assertStatus(200);

    }
}
