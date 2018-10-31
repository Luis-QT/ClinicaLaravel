<?php

use Illuminate\Database\Seeder;
use App\Keyword;

class Keywords extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Keyword::create([
           'id' => 1,
           'name' => 'Habilitado',
        ]);
        Keyword::create([
           'id' => 2,
           'name' => 'Deshabilitado',
        ]);
    }
}
