<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lava;
use App\Meeting;
use App\Doctor;
use App\Patient;
use App\Office;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentYear   = date("Y"); //Obtengo el año actual
        $currentMonth  = date("m");
        $meetings = Meeting::where('date','like',$currentYear.'%')
                ->get(); //Citas del presente año


        $values = Lava::DataTable();
        $values ->addDateColumn('Meses')
                ->addNumberColumn('Asignadas')
                ->addNumberColumn('Atendidas');

        if($meetings){
            for ($i=1; $i <= 12; $i++) {
                $month = $i < 10 ? '0'.$i : $i; //Para que el mes tenga dos cifras 
                $yearMonth = $currentYear.'/'.$month;

                $meetingsOfCurrentMonth = $meetings->filter(function($val) use ($yearMonth){
                    return preg_match('@'.$yearMonth.'@', $val->date);
                });
                $meetingsAssigned = $meetingsOfCurrentMonth->filter(function($val){
                    return $val->keyword_state == 1;
                });
                $meetingsAttended = $meetingsOfCurrentMonth->filter(function($val){
                    return $val->keyword_state == 2;
                });

                $values->addRow([$currentYear.'-'.$month,$meetingsAssigned->count(),$meetingsAttended->count()]);
            }
        }
                
        Lava::ColumnChart('Finances', $values, [
            'title' => 'Citas del '.$currentYear,
            'titleTextStyle' => [
                'color'    => 'black',
                'fontSize' => 14
            ],
            'height' => 350,
            'isStacked' => false
        ]);
            
        return view('home',[
            'allMeetingsCount'       => Meeting::All()->count(),
            'meetingsThisMonthCount' => Meeting::where('date','like',$currentYear.'/'.$currentMonth.'%')->count(),
            'allDoctorsCount'        => Doctor::All()->count(),
            'allPatientsCount'       => Patient::All()->count(),
            'allOfficesCount'        => Office::All()->count(),
            'lastMeetings'           => Meeting::where('id','>=','0')->orderBY('created_at')->take(10)->get(),
            'lastPatients'           => Patient::where('id','>=','0')->orderBY('created_at')->take(10)->get()
        ]);
    }
}


/*
SELECT COUNT(*),( 
    SELECT CASE WHEN m.date LIKE '2018/01%'THEN '2018-01' WHEN m.date LIKE '2018/02%'THEN '2018-02%' WHEN m.date LIKE '2018/03%'THEN '2018-03' WHEN m.date LIKE '2018/04%'THEN '2018-04' WHEN m.date LIKE '2018/05%'THEN '2018-05' WHEN m.date LIKE '2018/06%'THEN '2018-06' WHEN m.date LIKE '2018/07%'THEN '2018-07' WHEN m.date LIKE '2018/08%'THEN '2018-08' WHEN m.date LIKE '2018/09%'THEN '2018-09' WHEN m.date LIKE '2018/10%'THEN '2018-10' WHEN m.date LIKE '2018/11%'THEN '2018-11' WHEN m.date LIKE '2018/12%'THEN '2018-12' ELSE 'nada' END )AS month FROM meetings m WHERE date LIKE '2018%' GROUP BY month
*/