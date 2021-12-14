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

  public function test_user_can_view_a_client()
  {
  }

  public function test_user_can_update_a_client()
  {
    $response = $this->post('/clients', ['name' => 'ABC Company', 'code' => 'ABCCO']);
    $clients = Client::all();
    
    $this->assertTrue($clients->count() == 1);

    $client = $clients->first();
    $this->assertTrue($client->name == $clients->first()->name);

    $response = $this->put('/clients/'.$client->id, ['name' => 'ABC Company Updated', 'code' => 'ABCCO']);
    $response->assertStatus(200);

    $clients = Client::all();
    $this->assertTrue($clients->first()->name == 'ABC Company Updated');

  }

  public function test_user_can_delete_a_client()
  {
    $response = $this->post('/clients', ['name' => 'ABC Company', 'code' => 'ABCCO']);
    $clients = Client::all();
    
    $this->assertTrue($clients->count() == 1);

    $client = $clients->first();
    $this->assertTrue($client->name == $clients->first()->name);

    $response = $this->delete('/clients/'.$client->id);
    $response->assertStatus(200);

    $clients = Client::all();
    $this->assertTrue($clients->count() == 0);    
  }
}
