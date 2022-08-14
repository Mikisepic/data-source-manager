<?php

namespace Database\Seeders\API;

use App\Models\DataSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSourceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DataSource::factory(50)->create();
  }
}
