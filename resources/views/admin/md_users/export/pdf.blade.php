<!DOCTYPE html>
<html>
<head>
  <title>Lista de Usuarios</title>
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
  <center><h3><strong>LISTA DE USUARIOS</strong></h3></center>
  <hr>
  <table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Perfil</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $i => $user)
            <tr>
              <td class="text-center">{{$i+1}}</td>
              <td class="text-center">{{$user->name}}</td>
              <td class="text-center">{{$user->lastName}}</td>
              <td class="text-center">{{$user->email}}</td>
              <td class="text-center">{{$user->profile->name}}</td>
              <td class="text-center">{{$user->state->name}}</td>
            </tr>  
        @endforeach
    </tbody>
  </table>
</body>
</html>
