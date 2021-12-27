<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class OwnerTest extends TestCase
{
  use RefreshDatabase;
  
  public function setUp(): void
  {
    parent::setUp();
    $this->artisan('db:seed --class=RoleSeeder');
  }

  public function test_owner_can_access_home_page()
  {
    $this->withoutExceptionHandling();

    $ownerRole = Role::where('name','owner')->first();
    $this->assertTrue($ownerRole->id == Role::IS_OWNER);

    $user = User::factory()->create();
    $user->roles()->attach($ownerRole->id);
    
    $response = $this->actingAs($user)->get('/');
    $response->assertStatus(200);
  }

  // TODO: Add a private page access granted test for owners
  // TODO: Add a owner-specific page access granted test for owners

  public function test_owner_can_not_access_dashboard()
  {
    $ownerRole = Role::where('name','owner')->first();
    $this->assertTrue($ownerRole->id == Role::IS_OWNER);
    
    $user = User::factory()->create();
    $user->roles()->attach($ownerRole->id);

    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertStatus(403);
  }
}
