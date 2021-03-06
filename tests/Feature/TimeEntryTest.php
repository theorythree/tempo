<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;
use App\Models\Project;
use App\Models\Role;
use App\Models\TimeEntry;
use App\Models\User;

class TimeEntryTest extends TestCase
{
  use RefreshDatabase;
  
  public function setUp(): void
  {
    parent::setUp();
    $this->artisan('db:seed --class=RoleSeeder');
    $this->user = User::factory()->create();
    $this->user->roles()->attach(Role::IS_USER);
    $this->client = Client::factory()->create();
    $this->project = Project::factory()->create(['client_id' => $this->client->id]);
  }

  public function test_user_cannot_add_string_value_for_duration_value()
  {
    $response = $this->actingAs($this->user)->post('/time', [
      'project_id' => $this->project->id,
      'date' => Date("Y-m-d"),      
      'duration' => 'abc'
    ]);
    
    $this->assertTrue(TimeEntry::all()->count() == 0);
    $response->assertStatus(302);
    $response->assertSessionHasErrors();
  }

  public function test_user_can_add_duration_with_colon_format()
  {
    $response = $this->actingAs($this->user)->post('/time', [
      'project_id' => $this->project->id,
      'date' => Date("Y-m-d"),
      'duration' => '1:30'
    ]);
    
    $this->assertTrue(TimeEntry::all()->count() == 1);
    $this->assertDatabaseHas('time_entries', ['duration' => 90]);
  }

  public function test_user_can_add_duration_with_decimal_format()
  {
    $response = $this->actingAs($this->user)->post('/time', [
      'project_id' => $this->project->id,
      'date' => Date("Y-m-d"),
      'duration' => '1.5'
    ]);
    
    $this->assertTrue(TimeEntry::all()->count() == 1);
    $this->assertDatabaseHas('time_entries', ['duration' => 90]);
  }

  public function test_user_can_update_time_entry()
  {
    $timeEntry = TimeEntry::factory()->create([
      'project_id' => $this->project->id,
      'date' => Date("Y-m-d"),
      'duration' => '1:30'
    ]);

    $this->assertDatabaseHas('time_entries', ['duration' => 90]);

    $response = $this->actingAs($this->user)->put('/time/'.$timeEntry->id, [
      'project_id' => $this->project->id,
      'date' => Date("Y-m-d"),
      'duration' => '1:15'
    ]);

    $this->assertDatabaseHas('time_entries', ['duration' => 75]);
  }

  public function test_user_can_delete_a_time_entry()
  {
    $timeEntry = TimeEntry::factory()->create([
      'project_id' => $this->project->id,
      'date' => Date("Y-m-d"),
      'duration' => '2:30'
    ]);

    $this->assertDatabaseHas('time_entries', ['duration' => 150]);

    $response = $this->actingAs($this->user)->delete('/time/'.$timeEntry->id);

    $this->assertTrue(TimeEntry::all()->count() == 0);
  }
}
