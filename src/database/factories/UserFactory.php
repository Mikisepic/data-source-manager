<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $faker = FakerFactory::create();

    return [
      'id' => $faker->uuid(),
      'username' => $faker->userName(),
      'email' => $faker->safeEmail(),
      'email_verified_at' => now(),
      'first_name' => $faker->firstName(),
      'last_name' => $faker->lastName(),
      'password' => Hash::make('password'),
      'location' => $faker->address(),
      'occupation' => $faker->jobTitle(),
      'academic_status' => $faker->randomElement(['researcher', 'student', 'bachelor', 'master', 'doctoral', 'phd', 'postgraduate']),
      'description' => $faker->text(),
      'remember_token' => Str::random(10),
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   *
   * @return static
   */
  public function unverified()
  {
    return $this->state(function (array $attributes) {
      return [
        'email_verified_at' => null,
      ];
    });
  }
}
