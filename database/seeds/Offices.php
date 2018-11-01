<?php

use Illuminate\Database\Seeder;
use App\Office;

class Offices extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Office::create([
           'name' => 'Consultorio A-1',
           'keyword_state' => 1,
        ]);

        Office::create([
           'name' => 'Consultorio A-2',
           'keyword_state' => 1,
        ]);
        Office::create([
           'name' => 'Laboratorio',
           'keyword_state' => 1,
        ]);
    }
}
