<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('enfermedadesTratadas')->nullable();
            $table->string('hospitalizaciones')->nullable();
            $table->string('inmunisaciones')->nullable();
            $table->string('tipoSangre')->nullable();
            $table->string('alergias')->nullable();

            $table->integer('estadoPadre')->nullable();
            $table->string('enfermedadesPadre')->nullable();
            $table->string('hospitalizacionPadre')->nullable();
            $table->integer('estadoMadre')->nullable();
            $table->string('enfermedadesMadre')->nullable();
            $table->string('hospitalizacionMadre')->nullable();

            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');
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
        Schema::dropIfExists('histories');
    }
}
