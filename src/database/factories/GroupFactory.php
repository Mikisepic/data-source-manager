<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $ownerIDs = DB::table('users')->pluck('id');

    return [
      'id' => fake()->uuid(),
      'user_id' => fake()->randomElement($ownerIDs),
      'title' => fake()->text(50),
      'description' => fake()->text(50)
    ];
  }
}
