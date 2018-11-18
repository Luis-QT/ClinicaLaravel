@extends('layouts.main')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        INICIO
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      </ol>
    </section>

    <!-- <MAIN></MAIN>in content -->
    <section class="content container-fluid">
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Reporte de citas del <strong>{{date("Y")}}</strong></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                <i class="fa fa-minus"></i></button>
              
              </div>
            </div>
            <div class="box-body">
              <div id="perf_div" class="col-md-8"></div> 
              @columnchart('Finances', 'perf_div')
              <div class="col-md-4">
                <div class="info-box bg-purple">
                  <div class="info-box-icon">
                    <i class="fa fa-medkit"></i>
                  </div>
                  <div class="info-box-content">
                    <span class="info-box-text">Citas totales</span>
                    <span class="info-box-number">{{$allMeetingsCount}}</span>
                    <div class="progress"></div>
                    <span class="progress-desciption">Citas del mes: <strong>{{$meetingsThisMonthCount}}</strong></span>
                  </div>
                </div>
                <div class="info-box bg-green">
                  <div class="info-box-icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <div class="info-box-content">
                    <span class="info-box-text">Pacientes</span>
                    <div class="progress"></div>
                    <span class="info-box-number">{{$allPatientsCount}}</span>
                  </div>
                </div>
                <div class="info-box bg-aqua">
                  <div class="info-box-icon">
                    <i class="fa fa-user-md"></i>
                  </div>
                  <div class="info-box-content">
                    <span class="info-box-text">Medicos</span>
                    <div class="progress"></div>
                    <span class="info-box-number">{{$allDoctorsCount}}</span>
                  </div>
                </div>
                <div class="info-box bg-yellow">
                  <div class="info-box-icon">
                    <i class="fa fa-hospital-o"></i>
                  </div>
                  <div class="info-box-content">
                    <span class="info-box-text">Consultorios</span>
                    <div class="progress"></div>
                    <span class="info-box-number">{{$allOfficesCount}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3>Últimas citas registradas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <tr>
                    <th>#</th>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                  </tr>
                  @foreach($lastMeetings as $i => $meeting)
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $meeting->patient->name.' '.$meeting->patient->lastName }}</td>
                    <td>{{ $meeting->date }}</td>
                    <td>{{ $meeting->hour }}</td>
                  </tr>
                  @endforeach  
                </table>  
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3>Últimos pacientes registrados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <tr>
                    <th>#</th>
                    <th>Paciente</th>
                    <th>Telefono</th>
                  </tr>
                  @foreach($lastPatients as $i => $patient)
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $patient->name.' '.$patient->lastName }}</td>
                    <td>{{ $patient->phone }}</td>
                  </tr>
                  @endforeach  
                </table>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

@endsection