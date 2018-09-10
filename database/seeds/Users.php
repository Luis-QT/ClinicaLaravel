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
         	'email' => 'admin@admin.com',
         	'password' => bcrypt('admin')
         ]);
    }
}
