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
    Schema::create('data_sources', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
      $table->foreignUuid('collection_id')->constrained('collections')->onUpdate('cascade')->onDelete('cascade');
      $table->foreignUuid('group_id')->constrained('groups')->onUpdate('cascade')->onDelete('cascade');
      $table->string('title');
      $table->string('source')->nullable()->default('');
      $table->enum('category', ['link', 'article', 'book']);
      $table->timestamp('expires_at');
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
    Schema::dropIfExists('data_sources');
  }
};
