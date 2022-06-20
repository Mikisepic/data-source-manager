<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToLabelAssign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('label_assign', function (Blueprint $table) {
            $table->bigInteger('label_id')->unsigned()->nullable();
            $table->foreign('label_id')->references('id')->on('labels');

            $table->bigInteger('reference_id')->unsigned()->nullable();
            $table->foreign('reference_id')->references('id')->on('references');

            $table->bigInteger('collection_id')->unsigned()->nullable();
            $table->foreign('collection_id')->references('id')->on('collections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('label_assign', function (Blueprint $table) {
            //
        });
    }
}
