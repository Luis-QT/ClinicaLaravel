<?php

use Illuminate\Database\Seeder;
use App\Doctor;

class Doctors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::create([
           'name' => 'Luigui',
           'lastName'=>'Ferdinant Romero',
           'email'=>'luigui@luigui.com', 
           'phone'=>'978547988',
           'address'=>'Los Olivos , Av Canadá',
           'specialty_id' => 2,
           'photo' => 'https://www.tenvinilo.com/img/sticker/large/4723.jpg',
        ]);

        Doctor::create([
           'name' => 'Juan Antony',
           'lastName'=>'Juarez Lozano',
           'email'=>'juan@lozano.com', 
           'phone'=>'977455454',
           'address'=>'Comas , Av. Coyote  Calle 45',
           'specialty_id' => 1,
           'photo' => 'https://www.tenvinilo.com/img/sticker/large/4723.jpg',
        ]);

        Doctor::create([
           'name' => 'Carlos Augusto',
           'lastName'=>'Taquire Castillo',
           'email'=>'carlos@taquire.com', 
           'phone'=>'977457555',
           'address'=>'San Martin de Porres , Urb. Naranjal',
           'specialty_id' => 3,
           'photo' => 'https://www.tenvinilo.com/img/sticker/large/4723.jpg',
        ]);

        Doctor::create([
           'name' => 'Shirley Valeria',
           'lastName'=>'Castillo Cabeza',
           'email'=>'shirley@castillo.com', 
           'phone'=>'999888444',
           'address'=>'San Martin de Porres , Urb. Los Huertos',
           'specialty_id' => 1,
           'photo' => 'https://www.tenvinilo.com/img/sticker/large/4723.jpg',
        ]);
    }
}
        