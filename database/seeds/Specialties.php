<?php

use Illuminate\Database\Seeder;
use App\Specialty;
class Specialties extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialty::create([
           'name' => 'Medico General',
           'state' => 1,
        ]);

        Specialty::create([
           'name' => 'Oftalmologo',
           'state' => 1,
        ]);
		Specialty::create([
           'name' => 'Cardiologo',
           'state' => 1,
        ]);
    }
}
