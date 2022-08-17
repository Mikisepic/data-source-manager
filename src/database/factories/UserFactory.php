<?php

namespace Database\Factories;

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
    return [
      'id' => fake()->uuid(),
      'name' => fake()->userName(),
      'email' => fake()->safeEmail(),
      'email_verified_at' => now(),
      'first_name' => fake()->firstName(),
      'last_name' => fake()->lastName(),
      'password' => Hash::make('password'),
      'location' => fake()->address(),
      'occupation' => fake()->jobTitle(),
      'academic_status' => fake()->randomElement(['researcher', 'student', 'bachelor', 'master', 'doctoral', 'phd', 'postgraduate']),
      'description' => fake()->text(),
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
