<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $project_names = ['Website Redesign', 'Shopify Website', 'Website Design', 'Mobile App', 'iOS App', 'Android App', 'Writing Project', 'Consulting', 'Research Dev','Corporate Website'];
      $rand_key = array_rand($project_names,1);

      return [
        "client_id" => 1,
        "name" => $project_names[$rand_key],
        "description" => $this->faker->text(200),
        "budget" => $this->faker->randomFloat(2,100,10000),
      ];
    }
}
