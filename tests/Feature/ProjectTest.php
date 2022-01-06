<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use App\Models\Role;

class ProjectTest extends TestCase
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

  public function test_owner_can_create_a_project()
  {
    $response = $this->actingAs($this->owner)->post('/projects', ['client_id' => 1,'name' => 'My Project']);
    $this->assertTrue(Project::all()->count() == 1);
  }

  public function test_user_can_not_create_a_project()
  {
    $response = $this->actingAs($this->user)->post('/projects', ['client_id' => 1,'name' => 'My Project']);
    $this->assertTrue(Project::all()->count() == 0);
  }

  public function test_owner_can_update_a_project()
  {
    $project = Project::factory()->create(['name' => 'Original Project Name']);
    $this->assertTrue(Project::all()->count() == 1);
    $this->assertDatabaseHas('projects', ['name' => $project->name]);

    $response = $this->actingAs($this->owner)->put('/projects/'.$project->id, ['client_id' => 1,'name' => 'My Updated Project Name']);
    $this->assertDatabaseHas('projects', ['name' => 'My Updated Project Name']);
  }

  public function test_user_can_not_update_a_project()
  {
    $project = Project::factory()->create(['name' => 'Original Project Name']);
    $this->assertTrue(Project::all()->count() == 1);
    $this->assertDatabaseHas('projects', ['name' => $project->name]);

    $response = $this->actingAs($this->user)->put('/projects/'.$project->id, ['client_id' => 1,'name' => 'My Updated Project Name']);
    $this->assertDatabaseHas('projects', ['name' => $project->name]);
  }

  public function test_owner_can_delete_a_project()
  {
    $project = Project::factory()->create();
    $this->assertTrue(Project::all()->count() == 1);

    $response = $this->actingAs($this->owner)->delete('/projects/'.$project->id);
    $this->assertTrue(Project::all()->count() == 0);    
  }

  public function test_user_can_not_delete_a_project()
  {
    $project = Project::factory()->create();
    $this->assertTrue(Project::all()->count() == 1);

    $response = $this->actingAs($this->user)->delete('/projects/'.$project->id);
    $this->assertTrue(Project::all()->count() == 1);    
  }

}
