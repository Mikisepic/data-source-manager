<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
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
    $faker = FakerFactory::create();
    $userIDs = DB::table('users')->pluck('id');
    $collectionIDs = DB::table('collections')->pluck('id');
    $groupIDs = DB::table('groups')->pluck('id');

    $randomDay = $faker->numberBetween(2, 10);

    return [
      'id' => $faker->uuid(),
      'user_id' => $faker->randomElement($userIDs),
      'collection_id' => $faker->randomElement($collectionIDs),
      'group_id' => $faker->randomElement($groupIDs),
      'title' => $faker->text(50),
      'author' => $faker->name(),
      'source' => $faker->url(),
      'category' => $faker->randomElement(['link', 'article', 'book']),
      'expires_in' => $randomDay,
      'expires_at' => $faker->date(now()->addDays($randomDay))
    ];
  }
}
