@extends('layouts.main') 
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pacientes <small> -- </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Pacientes</li>
    </ol>
</section>

@include('admin.md_patients.modalAdd')
@include('admin.md_patients.modalDelete')

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Pacientes</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="clearfix div-top-table">
                        <div class="pull-left">
                          <a type="button" target="_blank" href="{{ url('/admin/doctors/viewPDF') }}" class="btn btn-default"><i class="fa fa-eye"></i> Vista PDF</a>
                          <a type="button" href="{{ url('/admin/doctors/exportPDF') }}" class="btn btn-default"><i class="fa fa-file-pdf"></i> PDF</a>
                          <a type="button" href="{{ url('/admin/doctors/exportExcel') }}" class="btn btn-default"><i class="fas fa-file-excel"></i> EXCEL</a>
                        </div>
                      <div class="pull-right">
                          <button data-toggle="modal" data-target="#modalAdd" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button>
                        </div>
                    </div>
                    <div class="table-responsive" id="container-table-patients">
                        {!! $table !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $('.datepicker').datetimepicker({
        format: "YYYY/MM/DD"
    });
</script>

@endsection
