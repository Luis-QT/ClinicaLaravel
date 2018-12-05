<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {	
        $this->call(Keywords::class);
        $this->call(Profiles::class);
        $this->call(Users::class);
        $this->call(Specialties::class);
        $this->call(Offices::class);
        $this->call(Doctors::class);
        $this->call(Patients::class);
        $this->call(Meetings::class);
        $this->call(Configurations::class);
        $this->call(Schedules::class);
        $this->call(Histories::class);
    }
}
