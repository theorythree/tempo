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
    $this->admin = User::factory()->create();
    $this->admin->roles()->attach(Role::IS_ADMIN);
  }

  public function test_admin_can_access_home_page()
  {
    $this->withoutExceptionHandling();

    $response = $this->actingAs($this->admin)->get('/');
    $response->assertStatus(200);
  }

  // TODO: Add a private page access granted test for admins
  // TODO: Add a admin-specific page access granted test for admins

  public function test_admin_can_access_dashboard()
  {
    $this->withoutExceptionHandling();

    $response = $this->actingAs($this->admin)->get('/dashboard');
    $response->assertStatus(200);
  }
}
