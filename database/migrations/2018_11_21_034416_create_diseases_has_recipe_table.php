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
            $table->integer('disease_id')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->integer('meeting_id')->unsigned();
            $table->primary(['disease_id', 'recipe_id','meeting_id']);
            $table->foreign('disease_id')->references('id')->on('disease');
            $table->foreign('recipe_id')->references('id')->on('recipe');
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
