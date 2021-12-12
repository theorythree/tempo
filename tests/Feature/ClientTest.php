<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;

class ClientTest extends TestCase
{
  use RefreshDatabase;
  
  public function test_user_can_create_a_client()
  {
    $response = $this->post('/clients', ['name' => 'ABC Company', 'code' => 'ABCCO']);
    $this->assertTrue(Client::all()->count() == 1);
  }
}
