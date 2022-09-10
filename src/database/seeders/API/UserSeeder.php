<?php

namespace Database\Seeders\API;

use App\Models\Collection;
use App\Models\DataSource;
use App\Models\Group;
use App\Models\Notification;
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
    User::factory(10)->create()->each(function ($user) {
      $collections = Collection::factory(50)->create();
      $user->collections()->saveMany($collections);

      $groups = Group::factory(30)->create()->each(function ($group) use ($user) {
        $group->members()->attach(
          $user->pluck('id')->toArray()
        );
      });
      $user->groups()->saveMany($groups);

      $dataSources = DataSource::factory(70)->create();
      $user->dataSources()->saveMany($dataSources);

      Notification::factory(20)->create();
    });
  }
}
