<!DOCTYPE html>
<html>
<head>
  <title>Historial de Citas</title>
  <link href="{{ asset('css/bootstrapMod.css') }}" rel="stylesheet">
</head>
<body>
  <style type="text/css">
      html {
      margin: 0;
      }
      body {
      font-family: "Times New Roman", serif;
      margin: 2mm 8mm 2mm 8mm;
      }
      table thead th{
          background:#E7FAE2;
      }
      table>tbody>tr>td, table>tbody>tr>th, table>tfoot>tr>td, table>tfoot>tr>th, table>thead>tr>td, table>thead>tr>th{
          vertical-align: middle;
      }

      table>tbody>tr>td, table>tbody>tr>th, table>tfoot>tr>td, table>tfoot>tr>th, table>thead>tr>td, table>thead>tr>th{
          text-align: center;
      }
  </style>
  <center><h3><strong>HISTORIAL DE CITAS</strong></h3></center>
  <hr>
  <table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Paciente</th>
            <th>Médico</th>
            <th>Consultorio</th>
            <th>Estado</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($meetings as $i => $meeting)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $meeting->date }}</td>
              <td>{{ $meeting->hour }}</td>
              <td>{{ $meeting->patient->name.' '.$meeting->patient->lastName }}</td>
              <td>{{ $meeting->doctor->name.' '.$meeting->doctor->lastName }}</td>
              <td>{{ $meeting->office->name}}</td>
              <td>{{ $meeting->state->name}}</td>
            </tr>  
        @endforeach
    </tbody>
  </table>
</body>
</html>

