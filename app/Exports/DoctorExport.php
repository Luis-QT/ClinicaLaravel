<?php

namespace App\Exports;

use App\Doctor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DoctorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.md_doctors.export.excel',[
          'doctors' => Doctor::all(),
        ]);
    }
}