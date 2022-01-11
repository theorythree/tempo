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
    $this->owner = User::factory()->create();
    $this->owner->roles()->attach(Role::IS_OWNER);
  }

  public function test_owner_can_create_a_client()
  {
    $this->withoutExceptionHandling();
    $response = $this->actingAs($this->owner)->post('/clients', ['name' => 'ABC Company', 'code' => 'ABCCO']);
    $this->assertTrue(Client::all()->count() == 1);
  }

  public function test_user_can_not_create_a_client()
  {
    $response = $this->actingAs($this->user)->post('/clients', ['name' => 'ABC Company', 'code' => 'ABCCO']);
    $this->assertTrue(Client::all()->count() == 0);
  }

  public function test_owner_can_update_a_client()
  {
    $client = Client::factory()->create(['name' => 'ABC Company', 'code' => 'ABCCO']);
    $this->assertTrue(Client::all()->count() == 1);
    $this->assertDatabaseHas('clients', ['name' => $client->name]);

    $response = $this->actingAs($this->owner)->put('/clients/'.$client->id, ['name' => 'ABC Company Updated', 'code' => 'ABCCO']);
    $this->assertDatabaseHas('clients', ['name' => 'ABC Company Updated']);
  }

  public function test_user_can_not_update_a_client()
  {
    $client = Client::factory()->create(['name' => 'ABC Company', 'code' => 'ABCCO']);
    $this->assertTrue(Client::all()->count() == 1);
    $this->assertDatabaseHas('clients', ['name' => $client->name]);

    $response = $this->actingAs($this->user)->put('/clients/'.$client->id, ['name' => 'ABC Company Updated', 'code' => 'ABCCO']);
    $this->assertDatabaseHas('clients', ['name' => $client->name]);
  }

  public function test_owner_can_delete_a_client()
  {
    $client = Client::factory()->create();
    $this->assertTrue(Client::all()->count() == 1);
    
    $response = $this->actingAs($this->owner)->delete('/clients/'.$client->id);
    $this->assertTrue(Client::all()->count() == 0);
  }

  public function test_user_can_not_delete_a_client()
  {
    $client = Client::factory()->create();
    $this->assertTrue(Client::all()->count() == 1);
    
    $response = $this->actingAs($this->user)->delete('/clients/'.$client->id);
    $this->assertTrue(Client::all()->count() == 1);
  }

}
