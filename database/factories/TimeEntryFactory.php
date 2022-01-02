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
        return [
          "project_id" => 1,
          "user_id" => 1,
          "duration" => '1:30',
        ];
    }
}
