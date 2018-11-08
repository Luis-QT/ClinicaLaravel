@extends('layouts.main') 
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="report-title">
        Reporte de Citas por Paciente<small> -- </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reportes</li>
    </ol>
</section>

<section class="content-header">
    <div class="row">
        <div class="col-xs-3">
            <input type="text" name="date_filter" class="form-control" placeholder="Seleccione rango de fechas">
        </div>
        <div class="col-xs-3">
            <select class="form-control select2 select-state" style="width: 100%;" name="state_filter" >
                      <option value = "">Seleccione estado</option> 
                      @foreach($keywords as $keyword)
                          <option value = "{{$keyword->id}}"> 
                          @if($keyword->id == 1)
                            Asignado
                          @elseif($keyword->id ==2)
                            Atendido
                          @else
                            {{$keyword->name}}
                          @endif
                          </option>
                      @endforeach
            </select>
        </div>
        <div class="col-xs-3">
            <select type="text" class="form-control select2 select-patient" style="width: 100%;" placeholder="Escriba el nombre">
              <option value="">Seleccione paciente</option>
              @foreach($patients as $patient)
                <option value="{{$patient->id}}">{{$patient->name.' '.$patient->lastName}}</option>
              @endforeach
            </select>
        </div>
        <div class="col-xs-1 cont-anim-searching">
            
        </div>
        <div class="col-xs-3">
            <div class="clearfix div-top-table">
                <div class="pull-right">
                    <button class="btn btn-defalt"><i class="fa fa-print"></i> Imprimir</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title table-title">Lista de citas por Paciente</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive table-meetings">
                        {!! $table !!}
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    $('input[name="date_filter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel : 'Cancelar',
      },
    });

    $('input[name="date_filter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });
    
    function filter(){
      $dates = $('input[name="date_filter"]').val().split(' - ');
      $params = {
            'from_date'     : $dates[0],
            'to_date'       : $dates[1],
            'keyword_state' : $('.select-state').val(),
            'patient_id'    : $('.select-patient').val()
      }

      $.ajax({
        url         : '{{ url("/admin/reportsbyPatient") }}',
        type        : 'POST',
        data        : $params,
        beforeSend  : function(){
            //alert($params['keyword_state']+" - "+$params['patient_id']);
        },
        success     : function(data) {
            $('.table-meetings').html(data);
        },
        error       : function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  console.error(err.Message);
        }

      });

    }

    $('input[name="date_filter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
      filter();
    });
    $('.select-state').change(filter);
    $('.select-patient').change(filter);
</script>

@endsection
