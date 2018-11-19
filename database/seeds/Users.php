<?php

use Illuminate\Database\Seeder;
use App\User as User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create([
         	'name' => 'Luis Antonio',
            'lastName'=>'Quispe Taquire',
         	'email' => 'admin@admin.com',
         	'password' => bcrypt('admin'),
            'keyword_state'=>1,
            'profile_id'=>1,
            'photo' => 'images/users/default.jpg',
         ]);

         User::create([
            'name' => 'Jose Carlos',
            'lastName'=>'Pecho Barreto',
            'email' => 'admin2@admin.com',
            'password' => bcrypt('admin'),
            'keyword_state'=>1,
            'profile_id'=>1,
            'photo' => 'images/users/default.jpg',
         ]);
    }
}
