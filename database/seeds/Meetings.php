<?php

use Illuminate\Database\Seeder;
use App\Meeting;

class Meetings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meeting::create([
        	'date'			=>	'2018/12/11',
        	'hour'			=>	'19:20',
        	'observation'	=>	'Fuerte dolor en el pecho',
        	'keyword_state'	=>	3,
        	'patient_id'	=>	2,
        	'doctor_id'		=>	4,
        	'office_id'		=>	1
        ]);


        Meeting::create([
        	'date'			=>	'2018/09/11',
        	'hour'			=>	'12:20',
        	'observation'	=>	'Dolor de cabeza',
        	'keyword_state'	=>	3,
        	'patient_id'	=>	3,
        	'doctor_id'		=>	4,
        	'office_id'		=>	2
        ]);

        Meeting::create([
            'date'          =>  '2018/11/11',
            'hour'          =>  '13:20',
            'observation'   =>  'Dolor en articulaciones',
            'keyword_state' =>  4,
            'patient_id'    =>  1,
            'doctor_id'     =>  2,
            'office_id'     =>  1
        ]);


        Meeting::create([
            'date'          =>  '2018/12/11',
            'hour'          =>  '16:20',
            'observation'   =>  'Examen de sangre',
            'keyword_state' =>  4,
            'patient_id'    =>  3,
            'doctor_id'     =>  2,
            'office_id'     =>  3
        ]);

        Meeting::create([
            'date'          =>  '2018/12/21',
            'hour'          =>  '10:20',
            'observation'   =>  'Examen de orina',
            'keyword_state' =>  5,
            'patient_id'    =>  2,
            'doctor_id'     =>  2,
            'office_id'     =>  3
        ]);

        Meeting::create([
            'date'          =>  '2018/12/24',
            'hour'          =>  '10:20',
            'observation'   =>  'Mareos',
            'keyword_state' =>  5,
            'patient_id'    =>  1,
            'doctor_id'     =>  1,
            'office_id'     =>  1
        ]);
    }
}
