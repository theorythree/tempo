<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;
use App\Models\User;
use App\Models\Role;

class ClientTest extends TestCase
{
  use RefreshDatabase;
  
  public function setUp(): void
  {
    parent::setUp();
    $this->artisan('db:seed --class=RoleSeeder');
    $this->user = User::factory()->create();
    $this->user->roles()->attach(Role::IS_USER);
  }

  public function test_user_can_not_create_a_client_from_dashboard()
  {
    $response = $this->actingAs($this->user)->post('/dashboard/clients', ['name' => 'ABC Company', 'code' => 'ABCCO']);
    $response->assertStatus(403);
    $this->assertTrue(Client::all()->count() == 0);
  }

  public function test_user_can_not_view_a_client_from_dashboard()
  { 
    $response = Client::factory()->create();
    $clients = Client::all();
    
    $this->assertTrue($clients->count() == 1);
    
    $client = $clients->first();  
    $response = $this->actingAs($this->user)->get('/dashboard/clients/'.$client->id);
    $response->assertStatus(403);
  }

  public function test_user_can_not_view_client_index_page_from_dashboard()
  {
    $clients = Client::factory(3)->create();
    $clients = Client::all();
    
    $this->assertTrue($clients->count() == 3);
    
    $response = $this->actingAs($this->user)->get('/dashboard/clients');
    $response->assertStatus(403);
  }

  public function test_user_can_not_update_a_client_from_dashboard()
  {
    $response = Client::factory()->create();
    $clients = Client::all();
    
    $this->assertTrue($clients->count() == 1);
    
    $client = $clients->first();
    $this->assertTrue($client->name == $clients->first()->name);

    $response = $this->actingAs($this->user)->put('/dashboard/clients/'.$client->id, ['name' => 'ABC Company Updated']);
    $response->assertStatus(403);

    $clients = Client::all();
    $this->assertTrue($clients->first()->name != 'ABC Company Updated');

  }

  public function test_user_can_not_delete_a_client_from_dashboard()
  {
    $response = Client::factory()->create();
    $clients = Client::all();
    
    $this->assertTrue($clients->count() == 1);

    $client = $clients->first();

    $response = $this->delete('/dashboard/clients/'.$client->id);
    $response->assertStatus(403);

    $clients = Client::all();
    $this->assertTrue($clients->count() == 1);    
  }
}
