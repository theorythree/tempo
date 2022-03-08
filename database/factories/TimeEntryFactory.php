<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimeEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $randHour = rand(0,5);
      $randMin = rand(0,59);
      $taskId = rand(1,12);
        return [
          "project_id" => 1,
          "user_id" => 1,
          "task_id" => $taskId,
          "date" => date('Y-m-d', strtotime( '+'.mt_rand(-30,0).' days')),
          "duration" => $randHour.':'.$randMin,
        ];
    }
}
