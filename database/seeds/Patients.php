<?php

use Illuminate\Database\Seeder;
use App\Patient;

class Patients extends Seeder
{
        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
           'name'     => 'Mr Ferdinand',
           'lastName' =>'Braum',
           'birthdate'=>'1980/10/10',
           'phone'    =>'973577990',
           'address'  =>'Akihabara 666',
           'email'    =>'mrbraum@mrbraum.com', 
           'password' =>bcrypt('steinsgate'),
           'gender'   =>0
        ]);


        Patient::create([
           'name'     => 'Juana',
           'lastName' => 'Matos',
           'birthdate'=> '1995/11/10',
           'phone'    => '972537490',
           'address'  => 'Av. las camelias 666',
           'email'    => 'juanita@juanita.com', 
           'password' => bcrypt('juanita'),
           'gender'   => 1
        ]);

        Patient::create([
           'name'     => 'Julio',
           'lastName' => 'Cesar',
           'birthdate'=> '1965/01/12',
           'phone'    => '991533450',
           'address'  => 'Calle. Roma 123',
           'email'    => 'julio@julio.com', 
           'password' => bcrypt('julio'),
           'gender'   => 0
        ]);        

        Patient::create([
           'name'     => 'Slender',
           'lastName' => 'Man',
           'birthdate'=> '1900/01/01',
           'phone'    => '666666666',
           'address'  => 'Av. El bosque 123',
           'email'    => 'slendy@slendy.com', 
           'password' => bcrypt('slender'),
           'gender'   => 0
        ]);


        Patient::create([
           'name'     => 'Altair',
           'lastName' => 'Ibn-La Ahad',
           'birthdate'=> '1165/01/11',
           'phone'    => '123123123',
           'address'  => 'Av. Masyaf 123',
           'email'    => 'altairy@altair.com', 
           'password' => bcrypt('assassin'),
           'gender'   => 1
        ]);


        Patient::create([
           'name'     => 'Ester',
           'lastName' => 'Mendoza',
           'birthdate'=> '1965/01/11',
           'phone'    => '121232123',
           'address'  => 'Av. Venezuela 123',
           'email'    => 'ester@ester.com', 
           'password' => bcrypt('ester'),
           'gender'   => 0
        ]);
    }

}
