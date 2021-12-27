<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class UserTest extends TestCase
{
  use RefreshDatabase;
  
  public function setUp(): void
  {
    parent::setUp();
    $this->artisan('db:seed --class=RoleSeeder');
  }

  public function test_user_can_access_home_page()
  {
    $this->withoutExceptionHandling();

    $userRole = Role::where('name','user')->first();
    $this->assertTrue($userRole->id == 1);

    $user = User::factory()->create();
    $user->roles()->attach($userRole->id);

    $response = $this->actingAs($user)->get('/');
    $response->assertStatus(200);
  }
  
  // TODO: Add a private page access granted test for users

  public function test_user_can_not_access_dashboard()
  {  
    $userRole = Role::where('name','user')->first();
    $this->assertTrue($userRole->id == 1);
    
    $user = User::factory()->create();
    $user->roles()->attach($userRole->id);

    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertStatus(403);
  }
}
