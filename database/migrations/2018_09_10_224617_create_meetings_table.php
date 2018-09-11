<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('hour');
            $table->string('observation');
            $table->integer('state');
            $table->integer('patient_id');
            $table->integer('doctor_id');
            $table->integer('office_id');
            $table->foreign('patient_id')->references('patients')->on('id');
            $table->foreign('doctor_id')->references('doctors')->on('id');
            $table->foreign('office_id')->references('offices')->on('id');
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
        Schema::dropIfExists('meetings');
    }
}
