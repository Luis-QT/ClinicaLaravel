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
            'state'=>1,
            'profile_id'=>1,
         ]);
    }
}
