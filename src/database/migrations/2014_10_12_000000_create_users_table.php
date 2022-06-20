<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('username')->unique()->nullable();
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->integer('total_groups')->default(0);
      $table->integer('total_collections')->default(0);
      $table->integer('total_references')->default(0);
      $table->string('location')->nullable();
      $table->string('occupation')->nullable();
      $table->string('education')->nullable();
      $table->string('about_me')->nullable();
      $table->datetime('last_seen')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
