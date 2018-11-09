<?php

use Illuminate\Database\Seeder;
use App\Configuration;

class Configurations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
           'name'=>'San Paulo',
	   	   'registryNumber'=>'1100002737',
	   	   'email'=>'clinicaSanPaulo@gmail.com', 
	   	   'phone'=>'7188811',
	   	   'logo'=>null,
	   	   'address'=>'Independencia. Urb.Corneta Mz123. Lt.11',
        ]);
    }
}
