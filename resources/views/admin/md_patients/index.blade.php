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

<section class="content-header">
    <div class="row">
        <div class="col-xs-3">
            <input type="text" id="input-search-name" class="form-control" placeholder="Buscar por nombre">
        </div>
        <div class="col-xs-3">
            <div class="input-group">
                    <input type="text" id="input-search-lastname" class="form-control" placeholder="Buscar por apellido">
                    <span class="input-group-btn">
                        <button id="search-btn" class="btn btn-defalt">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
            </div>
        </div>
        <div class="col-xs-1 cont-anim-searching">
            
        </div>
        <div class="col-xs-5">
            <div class="clearfix div-top-table">
                <div class="pull-right">
                    <button data-toggle="modal" data-target="#modalAdd" class="btn btn-defalt"><i class="fa fa-plus"></i> Agregar</button>
                </div>
            </div>
        </div>
    </div>
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
        
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    function searchPatient(){
        var params = {
            'name'      : $("#input-search-name").val(),
            'lastname'  : $("#input-search-lastname").val() 
        }
        $.ajax({
            data        :  params,
            url         : '{{ route("searchPatient") }}',
            type        : 'post',
            beforeSend  : function(){
            
            },
            success     : function(data){
                //Inserto a la tabla principal el contenido
                $("#container-table-patients").html(data);
                //alert('exito');
            },
            error       : function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  console.error(err.Message);
            }
        });
    }

  $(document).ready(function() {   
    $("#input-search-name").keyup(searchPatient);
    $("#input-search-lastname").keyup(searchPatient);
    $("#search-btn").click(searchPatient);
  });
</script>

@endsection
