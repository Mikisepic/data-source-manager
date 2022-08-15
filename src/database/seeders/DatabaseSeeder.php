<?php

namespace Database\Seeders;

use Database\Seeders\API\CollectionSeeder;
use Database\Seeders\API\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      UserSeeder::class,
      CollectionSeeder::class,
    ]);
  }
}
