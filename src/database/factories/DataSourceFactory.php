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
    $randomUserID = $faker->randomElement(DB::table('users')->pluck('id'));

    $randomDay = $faker->numberBetween(2, 10);

    return [
      'id' => $faker->uuid(),
      'user_id' => $randomUserID,
      'title' => $faker->text(50),
      'author' => $faker->name(),
      'source' => $faker->url(),
      'category' => $faker->randomElement(['link', 'article', 'book', 'video']),
      'expires_in' => $randomDay,
      'expires_at' => $faker->date(now()->addDays($randomDay))
    ];
  }
}
