<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
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
    $faker = FakerFactory::create();
    $userIDs = DB::table('users')->pluck('id');

    return [
      'id' => $faker->uuid(),
      'user_id' => $faker->randomElement($userIDs),
      'title' => $faker->text(50),
      'description' => $faker->text(200),
    ];
  }
}
