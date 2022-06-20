<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToLibraries extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::table('libraries', function (Blueprint $table) {
      $table->bigInteger('reference_id')->unsigned()->nullable();
      $table->foreign('reference_id')->references('id')->on('references');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('libraries', function (Blueprint $table) {
      //
    });
  }
}
