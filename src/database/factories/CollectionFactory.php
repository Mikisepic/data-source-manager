<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $userIDs = DB::table('users')->pluck('id');

    return [
      'id' => fake()->uuid(),
      'user_id' => fake()->randomElement($userIDs),
      'title' => fake()->text(50),
      'description' => fake()->text(200),
    ];
  }
}
