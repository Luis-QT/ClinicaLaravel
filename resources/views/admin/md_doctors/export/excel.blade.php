<!DOCTYPE html>
<html>
<head>
  <title>Lista de Médicos</title>
</head>
<body>
  <center><h3><strong>LISTA DE MÉDICOS</strong></h3></center>
  <table>
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
              <td>{{$i+1}}</td>
              <td>{{$doctor->name}}</td>
              <td>{{$doctor->lastName}}</td>
              <td>{{$doctor->phone}}</td>
              <td>{{$doctor->address}}</td>
              <td>{{$doctor->specialty->name}}</td>
              <td>{{$doctor->email}}</td>
            </tr>  
        @endforeach
    </tbody>
  </table>
</body>
</html>



