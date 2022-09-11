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
    User::factory(3)->create()->each(function ($user) {
      $dataSources = DataSource::factory(70)->create();

      $collections = Collection::factory(50)->create();

      $groups = Group::factory(30)->create()->each(function ($group) use ($user) {
        $group->members()->attach(
          $user->pluck('id')->toArray()
        );
      });


      $user->dataSources()->saveMany($dataSources);
      $user->collections()->saveMany($collections);
      $user->groups()->saveMany($groups);
    });
  }
}
