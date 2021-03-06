<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\TimeEntry;

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
      \DB::table('time_entries')->truncate();

      \App\Models\Client::factory(10)->has(
        Project::factory()->has(
          TimeEntry::factory()->count(3)
          )->count(3))->create();
    }
}
