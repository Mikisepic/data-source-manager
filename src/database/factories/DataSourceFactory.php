<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataSource>
 */
class DataSourceFactory extends Factory
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
      'source' => fake()->url(),
      'category' => fake()->randomElement(['link', 'article', 'book']),
      'expires_at' => fake()->date(now()->addDays(random_int(2, 10)))
    ];
  }
}
