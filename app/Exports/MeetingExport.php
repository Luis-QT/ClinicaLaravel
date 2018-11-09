<?php

namespace App\Exports;

use App\Meeting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MeetingExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.md_meetings.export.excel',[
          'meetings' => Meeting::all(),
        ]);
    }
}