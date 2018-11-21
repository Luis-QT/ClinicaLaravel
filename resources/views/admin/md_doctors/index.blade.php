@extends('layouts.main') 
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Médicos <small> -- </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Médicos</li>
    </ol>
</section>

<section class="content">
    <input type="hidden" id="token" value="{{csrf_token()}}">
    <div class="row">

        <div class="col-md-12">{!! $show !!}</div>

    </div>
</section>

@endsection
