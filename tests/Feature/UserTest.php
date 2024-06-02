<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
   use RefreshDatabase;
     /**
      * test get the users from db
      *
      * @return void
      */

     public function testMakeUser() : void
     {
      $user = User::factory()->make();
      $this->assertInstanceOf(User::class, $user);
     }
     
     /**
      * test create a user from db 
      *
      *  @return void
      */

     public function testCreateUser() : void
     {
        $user = User::factory()->create();
        $this->assertDatabaseHas('users', $user->toArray());
     }

     /**
      * test update a user from db 

      * @return void
      */ 

     public function testUpdateUser() : void
     {
      $user = User::factory()->create();

      $user->update([
         "email" => "zobirofkir19@gmail.com"
      ]);
      $this->assertDatabaseHas("users", $user->toArray());
     }


     /**
      * test delete a user from db
      *
      * @return void
      */
     public function testDeleteUser() : void
     {
      $user = User::factory()->create();

      $userId = $user->id;
      $user->delete();
      $this->assertDatabaseMissing('users', ['id' => $userId]); 
   }
}
