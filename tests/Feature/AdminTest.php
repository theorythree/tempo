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
    $response = $this->actingAs($this->admin)->get('/');
    $response->assertStatus(200);
  }

  public function test_admin_can_access_dashboard()
  {
    $response = $this->actingAs($this->admin)->get('/dashboard');
    $response->assertStatus(200);
  }
}
