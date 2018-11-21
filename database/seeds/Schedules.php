<?php

use Illuminate\Database\Seeder;
use App\Schedule;

class Schedules extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'doctor_id'     => 1,
            'office_id'     => 1,
            'day_of_week'   => 1,
            'arrival_time'  => '08:00',
            'quitting_time' => '13:00'
        ]);
        Schedule::create([
            'doctor_id'     => 1,
            'office_id'     => 1,
            'day_of_week'   => 1,
            'arrival_time'  => '14:00',
            'quitting_time' => '17:00'
        ]);
        Schedule::create([
            'doctor_id'     => 2,
            'office_id'     => 1,
            'day_of_week'   => 1,
            'arrival_time'  => '08:00',
            'quitting_time' => '12:00'
        ]);

        Schedule::create([
            'doctor_id'     => 2,
            'office_id'     => 1,
            'day_of_week'   => 2,
            'arrival_time'  => '08:00',
            'quitting_time' => '13:00'
        ]);

        Schedule::create([
            'doctor_id'     => 3,
            'office_id'     => 1,
            'day_of_week'   => 5,
            'arrival_time'  => '08:00',
            'quitting_time' => '13:00'
        ]);

        Schedule::create([
            'doctor_id'     => 3,
            'office_id'     => 1,
            'day_of_week'   => 4,
            'arrival_time'  => '08:00',
            'quitting_time' => '10:00'
        ]);

        Schedule::create([
            'doctor_id'     => 3,
            'office_id'     => 1,
            'day_of_week'   => 6,
            'arrival_time'  => '14:00',
            'quitting_time' => '17:00'
        ]);
    }
}
