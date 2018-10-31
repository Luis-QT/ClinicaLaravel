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
           'keyword_state' => 1,
        ]);

        Specialty::create([
           'name' => 'Oftalmologo',
           'keyword_state' => 1,
        ]);
		Specialty::create([
           'name' => 'Cardiologo',
           'keyword_state' => 1,
        ]);
    }
}
