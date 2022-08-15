<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('username')->unique();
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('password');
      $table->string('location')->nullable();
      $table->string('occupation')->nullable();
      $table->enum('academic_status', ['researcher', 'student', 'bachelor', 'master', 'doctoral', 'phd', 'postgraduate']);
      $table->string('description')->nullable();
      $table->rememberToken();
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
};
