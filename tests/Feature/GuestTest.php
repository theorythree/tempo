<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class GuestTest extends TestCase
{
  use RefreshDatabase;

  public function test_guest_can_access_home_page()
  {
      $response = $this->get('/');
      $response->assertStatus(200);
  }
  
  // TODO: Add a private page access denied test for guests

  public function test_guest_can_not_access_dashboard()
  {
    $response = $this->get('/dashboard');
    $response->assertStatus(403);
  }
}
