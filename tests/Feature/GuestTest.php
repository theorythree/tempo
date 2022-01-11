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

  public function test_guest_can_not_access_dashboard()
  {
    $response = $this->get('/dashboard');
    $response->assertStatus(302);
  }

  public function test_guest_can_not_access_clients_page()
  {
    $response = $this->get('/clients');
    $response->assertStatus(302);
  }
}
