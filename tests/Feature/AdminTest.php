<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class AdminTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();
    $this->artisan('db:seed --class=RoleSeeder');
  }

  public function test_admin_can_access_home_page()
  {
    $this->withoutExceptionHandling();

    $adminRole = Role::where('name','admin')->first();
    $this->assertTrue($adminRole->id == 3);

    $user = User::factory()->create();
    $user->roles()->attach($adminRole->id);

    $response = $this->actingAs($user)->get('/');
    $response->assertStatus(200);
  }

  // TODO: Add a private page access granted test for admins
  // TODO: Add a admin-specific page access granted test for admins

  public function test_admin_can_access_dashboard()
  {
    $this->withoutExceptionHandling();

    $adminRole = Role::where('name','admin')->first();
    $this->assertTrue($adminRole->id == 3);

    $user = User::factory()->create();
    $user->roles()->attach($adminRole->id);

    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertStatus(200);
  }
}
