@extends('layouts.main') 
@section('content')

<div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">Reporte de citas por Calendario</h2>
            <div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
	              <i class="fa fa-minus"></i></button>
	            
          </div>
        </div>
        <div class="box-body" >
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
</div>


<link rel="stylesheet" type="text/css" href="{{asset('plugins/fullcalendar/fullcalendar.css')}}">
<script src="{{asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>

@endsection
