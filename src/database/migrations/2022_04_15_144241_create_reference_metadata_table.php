<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceMetadataTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('reference_metadata', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->text('description')->nullable();
      $table->decimal('price', 5, 2)->nullable();
      $table->string('image')->nullable();
      $table->string('author')->nullable();
      $table->timestamp('year_published')->nullable();
      $table->string('source')->nullable();
      $table->softDeletes();
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
    Schema::dropIfExists('reference_metadata');
  }
}
