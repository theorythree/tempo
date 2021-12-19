<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Client;

class ProjectTest extends TestCase
{
  use RefreshDatabase;
  
  public function test_user_can_create_a_project()
  {
    $response = $this->post('/projects', ['client_id' => 1,'name' => 'My Project']);
    $this->assertTrue(Project::all()->count() == 1);
  }

  public function test_user_can_view_a_project()
  { 
    $this->withoutExceptionHandling();

    $client = Client::factory()->create();

    $response = Project::factory()->create(['client_id' => $client]);
    $projects = Project::all();
    
    $this->assertTrue($projects->count() == 1);
    
    $project = $projects->first();  
    $response = $this->get('/projects/'.$project->id);
    $response->assertStatus(200);
    $response->assertSee($project->name);
  }

  public function test_user_can_view_project_index_page() 
  {
    $this->withoutExceptionHandling();
    
    $client = Client::factory()->create();
    $projects = Project::factory(3)->create(['client_id' => $client]);
    
    $this->assertTrue($projects->count() == 3);
    
    $response = $this->get('/projects');
    $response->assertStatus(200);

    $firstProject = $projects->first();
    $lastProject = $projects->last();

    $response->assertSee($firstProject->name);
    $response->assertSee($lastProject->name);
  }

  public function test_user_can_update_a_project()
  {
    $response = $this->post('/projects', ['client_id' => 1,'name' => 'My Project']);
    $projects = Project::all();
    
    $this->assertTrue($projects->count() == 1);

    $project = $projects->first();
    $this->assertTrue($project->name == $projects->first()->name);

    $response = $this->put('/projects/'.$project->id, ['client_id' => 1,'name' => 'My Updated Project']);
    $response->assertStatus(200);

    $projects = Project::all();
    $this->assertTrue($projects->first()->name == 'My Updated Project');
  }

  public function test_user_can_delete_a_project()
  {
    $response = Project::factory()->create();
    $projects = Project::all();
    
    $this->assertTrue($projects->count() == 1);

    $project = $projects->first();
    $this->assertTrue($project->name == $projects->first()->name);

    $response = $this->delete('/projects/'.$project->id);
    $response->assertStatus(200);

    $projects = Project::all();
    $this->assertTrue($projects->count() == 0);    
  }
}
