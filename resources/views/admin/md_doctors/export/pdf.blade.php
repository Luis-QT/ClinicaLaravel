<!DOCTYPE html>
<html>
<head>
  <title>Lista de Médicos</title>
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
  <center><h3><strong>LISTA DE MÉDICOS</strong></h3></center>
  <hr>
  <table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Especialidad</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($doctors as $i => $doctor)
            <tr>
              <td class="text-center">{{$i+1}}</td>
              <td class="text-center">{{$doctor->name}}</td>
              <td class="text-center">{{$doctor->lastName}}</td>
              <td class="text-center">{{$doctor->phone}}</td>
              <td class="text-center">{{$doctor->address}}</td>
              <td class="text-center">{{$doctor->specialty->name}}</td>
              <td class="text-center">{{$doctor->email}}</td>
            </tr>  
        @endforeach
    </tbody>
  </table>
</body>
</html>

