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
      $table->foreignUuid('collection_id')->nullable()->constrained('collections')->onUpdate('cascade')->onDelete('cascade');
      $table->foreignUuid('group_id')->nullable()->constrained('groups')->onUpdate('cascade')->onDelete('cascade');
      $table->string('title');
      $table->string('author');
      $table->string('source')->default('');
      $table->enum('category', ['link', 'article', 'book', 'video']);
      $table->integer('expires_in');
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
