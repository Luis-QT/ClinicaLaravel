<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasesHasRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases_has_recipe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('disease_id')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->integer('meeting_id')->unsigned();
            $table->foreign('disease_id')->references('id')->on('diseases');
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('meeting_id')->references('id')->on('meetings');
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
        Schema::dropIfExists('diseases_has_recipe');
    }
}
