<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\DataSource;
use \App\Models\User;
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
    User::factory(2)->create();
    DataSource::factory(100)->create();
    Collection::factory(100)->create();
  }
}
