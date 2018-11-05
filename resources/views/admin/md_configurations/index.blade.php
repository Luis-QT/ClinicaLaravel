@extends('layouts.main') 
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Configuraciones <small> -- </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Configuraciones</li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-4">{!! $logo !!}</div>
        <div class="col-md-8">{!! $show !!}</div>
    </div>
</section>

@endsection
