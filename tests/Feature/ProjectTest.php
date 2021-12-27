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
  }

  public function test_user_can_not_create_a_project_from_dashboard()
  {
    $response = $this->actingAs($this->user)->post('/dashboard/projects', ['client_id' => 1,'name' => 'My Project']);
    $response->assertStatus(403);
    $this->assertTrue(Project::all()->count() == 0);
  }

  public function test_user_can_not_view_a_project_from_dashboard()
  { 
    $client = Client::factory()->create();

    $response = Project::factory()->create(['client_id' => $client]);
    $projects = Project::all();
    
    $this->assertTrue($projects->count() == 1);
    
    $project = $projects->first();  
    $response = $this->actingAs($this->user)->get('/dashboard/projects/'.$project->id);
    $response->assertStatus(403);
  }

  public function test_user_can_not_view_project_index_page_from_dashboard() 
  {
    $client = Client::factory()->create();
    $projects = Project::factory(3)->create(['client_id' => $client]);
    
    $this->assertTrue($projects->count() == 3);
    
    $response = $this->actingAs($this->user)->get('/dashboard/projects');
    $response->assertStatus(403);
  }

  public function test_user_can_not_update_a_project_from_dashboard()
  {
    $response = Project::factory()->create();
    $projects = Project::all();
    
    $this->assertTrue($projects->count() == 1);

    $project = $projects->first();
    $this->assertTrue($project->name == $projects->first()->name);

    $response = $this->actingAs($this->user)->put('/dashboard/projects/'.$project->id, ['name' => 'My Updated Project']);
    $response->assertStatus(403);

    $projects = Project::all();
    $this->assertTrue($projects->first()->name != 'My Updated Project');
  }

  public function test_user_can_not_delete_a_project_from_dashboard()
  {
    $response = Project::factory()->create();
    $projects = Project::all();
    
    $this->assertTrue($projects->count() == 1);

    $project = $projects->first();

    $response = $this->delete('/dashboard/projects/'.$project->id);
    $response->assertStatus(403);

    $projects = Project::all();
    $this->assertTrue($projects->count() == 1);    
  }
}
