<?php

use Illuminate\Database\Seeder;
use App\History;

class Histories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        History::create([
           'enfermedadesTratadas' => '',
           'hospitalizaciones'=> '',
           'inmunisaciones'=> '',
           'tipoSangre'=> '', 
           'alergias'=> '',
           'estadoPadre'=> 0,
           'enfermedadesPadre'=> '',
           'hospitalizacionPadre'=> '',
           'estadoMadre'=> 0,
           'enfermedadesMadre'=> '',
           'hospitalizacionMadre'=> '',
           'patient_id' => 1
        ]);

        History::create([
           'enfermedadesTratadas' => '',
           'hospitalizaciones'=> '',
           'inmunisaciones'=> '',
           'tipoSangre'=> '', 
           'alergias'=> '',
           'estadoPadre'=> 0,
           'enfermedadesPadre'=> '',
           'hospitalizacionPadre'=> '',
           'estadoMadre'=> 0,
           'enfermedadesMadre'=> '',
           'hospitalizacionMadre'=> '',
           'patient_id' => 2
        ]);

        History::create([
           'enfermedadesTratadas' => '',
           'hospitalizaciones'=> '',
           'inmunisaciones'=> '',
           'tipoSangre'=> '', 
           'alergias'=> '',
           'estadoPadre'=> 0,
           'enfermedadesPadre'=> '',
           'hospitalizacionPadre'=> '',
           'estadoMadre'=> 0,
           'enfermedadesMadre'=> '',
           'hospitalizacionMadre'=> '',
           'patient_id' => 3
        ]);

        History::create([
           'enfermedadesTratadas' => '',
           'hospitalizaciones'=> '',
           'inmunisaciones'=> '',
           'tipoSangre'=> '', 
           'alergias'=> '',
           'estadoPadre'=> 0,
           'enfermedadesPadre'=> '',
           'hospitalizacionPadre'=> '',
           'estadoMadre'=> 0,
           'enfermedadesMadre'=> '',
           'hospitalizacionMadre'=> '',
           'patient_id' => 4
        ]);

        History::create([
           'enfermedadesTratadas' => '',
           'hospitalizaciones'=> '',
           'inmunisaciones'=> '',
           'tipoSangre'=> '', 
           'alergias'=> '',
           'estadoPadre'=> 0,
           'enfermedadesPadre'=> '',
           'hospitalizacionPadre'=> '',
           'estadoMadre'=> 0,
           'enfermedadesMadre'=> '',
           'hospitalizacionMadre'=> '',
           'patient_id' => 5
        ]);

        History::create([
           'enfermedadesTratadas' => '',
           'hospitalizaciones'=> '',
           'inmunisaciones'=> '',
           'tipoSangre'=> '', 
           'alergias'=> '',
           'estadoPadre'=> 0,
           'enfermedadesPadre'=> '',
           'hospitalizacionPadre'=> '',
           'estadoMadre'=> 0,
           'enfermedadesMadre'=> '',
           'hospitalizacionMadre'=> '',
           'patient_id' => 6
        ]);


    }
}
        

