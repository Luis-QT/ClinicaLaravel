@extends('layouts.main') 
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Especialidades <small> -- </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Especialidades</li>
    </ol>
</section>

<section class="content">

    <div class="row">

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    {!! $new !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! $edit !!}
                </div>
            </div>
        </div>

        <div class="col-md-8">{!! $show !!}</div>

    </div>
</section>
@endsection
