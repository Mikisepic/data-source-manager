<?php

namespace Database\Seeders\API;

use App\Models\Collection;
use App\Models\DataSource;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Collection::factory(3)->create()->each(function ($collection) {
      $collection->dataSources()->createMany(DataSource::factory(50)->make()->toArray());
    });
  }
}
