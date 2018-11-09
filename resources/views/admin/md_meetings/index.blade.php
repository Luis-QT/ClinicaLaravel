@extends('layouts.main') 
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Citas <small> -- </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Citas</li>
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

    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de citas</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="clearfix div-top-table">
                        <div class="pull-left">
                          <a type="button" target="_blank" href="{{ url('/admin/meetings/viewPDF') }}" class="btn btn-default"><i class="fa fa-eye"></i> Vista PDF</a>
                          <a type="button" href="{{ url('/admin/meetings/exportPDF') }}" class="btn btn-default"><i class="fa fa-file-pdf"></i> PDF</a>
                          <a type="button" href="{{ url('/admin/meetings/exportExcel') }}" class="btn btn-default"><i class="fas fa-file-excel"></i> EXCEL</a>
                        </div>
                        <div class="pull-right">
                          <button data-toggle="modal" data-target=".modalAgregar" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button>
                        </div>
                    </div>
                    <div class="table-responsive table-meetings">
                        {!! $table !!}
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@include('admin.md_meetings.modalAdd')
@include('admin.md_meetings.modalDelete')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    $('input[name="date_filter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
    });

    $('input[name="date_filter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
      
      $dates = $(this).val().split(' - ');
      var params = {
            'from_date'   : $dates[0],
            'to_date'     : $dates[1]
      }

      $.ajax({
        url: '{{ url("/admin/meetings/searchBetweenDates") }}',
        type: 'POST',
        data: params,
        success: function(data) {
            $('.table-meetings').html(data);
        },
        error       : function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  console.error(err.Message);
        }

      });
    });

    $('input[name="date_filter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

    $('.select-state').change(function(){
        if($(this).val()=="") return;

        var params = {
            'keyword_state'   : $(this).val()
        }

        $.ajax({
        url: '{{ url("/admin/meetings/searchByState") }}',
        type: 'POST',
        data: params,
        success: function(data) {
            $('.table-meetings').html(data);
        },
        error       : function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  console.error(err.Message);
        }
      });
    });


</script>

@endsection
