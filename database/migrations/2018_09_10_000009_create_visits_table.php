<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('servicio')->nullable();
            $table->string('fecha')->nullable();
            //anamnecis
            $table->string('motivo')->nullable(); // motivo
            $table->string('curso')->nullable(); //curso o progreso
            $table->string('enfermedadActual')->nullable(); //enfermedad actual
            //examen fisico
            $table->string('cabezaObs')->nullable(); //cabeza observacion
            $table->string('cabezaAus')->nullable(); //cabeza auscultacion
            $table->string('cabezaPer')->nullable(); //cabeza percusion
            $table->string('torsoObs')->nullable(); //torso observacion
            $table->string('torsoAus')->nullable(); //torso auscultacion
            $table->string('torsoPer')->nullable(); //torso percusion
            $table->string('abdomenObs')->nullable(); //abdomen observacion
            $table->string('abdomenAus')->nullable(); //abdomen auscultacion
            $table->string('abdomenPer')->nullable(); //abdomen percusion
            $table->string('espaldaObs')->nullable(); //espalda observacion
            $table->string('espaldaAus')->nullable(); //espalda auscultacion
            $table->string('espaldaPer')->nullable(); //espalda percusion
            $table->string('extremidadesObs')->nullable(); //extremidades observacion
            $table->string('extremidadesAus')->nullable(); //extremidades auscultacion
            $table->string('extremidadesPer')->nullable(); //extremidades percusion
            //diagnostico
            $table->string('diagnosticoPre')->nullable(); //diagnostico presuntivo
            $table->string('diagnosticoDef')->nullable(); //diagnostico definitivo
            $table->integer('pronostico')->nullable(); //Pronostico : 1. favorable 0. reservado
            $table->integer('examenComplementario')->nullable(); //Examenes complementarios : 1. Si , 0 : No

            $table->string('medicinas')->nullable(); //Medicinas
            $table->string('recomendaciones')->nullable(); //Recomendaciones

            $table->integer('meeting_id')->unsigned()->nullable();//historial clinico
            $table->foreign('meeting_id')->references('id')->on('meetings');
            $table->integer('history_id')->unsigned()->nullable();//historial clinico
            $table->foreign('history_id')->references('id')->on('histories');
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
