<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lava;
use App\Meeting;

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
        $anio   = date("Y"); //Obtengo el año actual
        $meetings = Meeting::where('date','like',$anio.'%')
                ->get(); //Citas del presente año

        $values = Lava::DataTable();
        $values ->addDateColumn('Meses')
                ->addNumberColumn('Asignadas')
                ->addNumberColumn('Atendidas');
/*
        if($meetings){
            foreach ($meetings as $meeting) {
                $values = $values->addRow([,])
            }
        }
                ->addRow(['2004-01', 1000, 400])
                ->addRow(['2005-01', 1170, 460])
                ->addRow(['2006-01', 660, 1120])
                ->addRow(['2007-01', 1030, 54]);
*/
        Lava::ColumnChart('Finances', $values, [
            'title' => 'Citas del '.$anio,
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ]]);
            
        return view('home');
    }
}

/*
SELECT COUNT(*),(
    SELECT CASE WHEN m.date LIKE '2018/01*'THEN '2018-01' WHEN m.date LIKE '2018/02*'THEN '2018-02' WHEN m.date LIKE '2018/03*'THEN '2018-03' WHEN m.date LIKE '2018/04*'THEN '2018-04' WHEN m.date LIKE '2018/05*'THEN '2018-05' WHEN m.date LIKE '2018/06*'THEN '2018-06' WHEN m.date LIKE '2018/07*'THEN '2018-07' WHEN m.date LIKE '2018/08*'THEN '2018-08' WHEN m.date LIKE '2018/09*'THEN '2018-09' WHEN m.date LIKE '2018/10*'THEN '2018-10' WHEN m.date LIKE '2018/11*'THEN '2018-11' WHEN m.date LIKE '2018/12*'THEN '2018-12' ELSE 'nada' END
)AS month FROM meetings m WHERE date LIKE '2018%'

*/