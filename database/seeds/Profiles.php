<?php

use Illuminate\Database\Seeder;
use App\Profile as Profile;

class Profiles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
           'name' => 'Admin',
           'permissions' => 'Perfiles,1,1,1,1;Usuarios,1,1,1,1;Especialidades,1,1,1,1;Consultorios,1,1,1,1;Pacientes,1,1,1,1',
        ]);
    }
}
