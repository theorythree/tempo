<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('tasks')->truncate();

      Task::create(['id' => 1, 'name' => 'Back-End Development', 'rate' => 125.00]);
      Task::create(['id' => 2, 'name' => 'Front-End Development', 'rate' => 125.00]);
      Task::create(['id' => 3, 'name' => 'Software Development', 'rate' => 125.00]);
      Task::create(['id' => 4, 'name' => 'Meeting', 'rate' => 125.00]);
      Task::create(['id' => 5, 'name' => 'Research', 'rate' => 125.00]);
      Task::create(['id' => 6, 'name' => 'Prototyping', 'rate' => 125.00]);
      Task::create(['id' => 7, 'name' => 'Art Direction', 'rate' => 125.00]);
      Task::create(['id' => 8, 'name' => 'Testing', 'rate' => 125.00]);
      Task::create(['id' => 9, 'name' => 'Rush', 'rate' => 125.00]);
      Task::create(['id' => 10, 'name' => 'Travel', 'rate' => 125.00]);
      Task::create(['id' => 11, 'name' => 'Admin', 'rate' => 0.00]);
      Task::create(['id' => 12, 'name' => 'Code Review', 'rate' => 125.00]);

    }
}
