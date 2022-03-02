<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('clients')->truncate();
      \DB::table('projects')->truncate();
      \App\Models\Client::factory(10)->has(Project::factory()->count(3))->create();
    }
}
