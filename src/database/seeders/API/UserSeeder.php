<?php

namespace Database\Seeders\API;

use App\Models\Collection;
use App\Models\DataSource;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::factory(5)->create()->each(function ($user) {
      $collections = Collection::factory(5)->create();
      $user->collections()->saveMany($collections);

      $groups = Group::factory(5)->create();
      $user->groups()->saveMany($groups);

      $dataSources = DataSource::factory(5)->create();
      $user->dataSources()->saveMany($dataSources);
    });
  }
}
