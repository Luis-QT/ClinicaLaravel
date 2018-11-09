<!DOCTYPE html>
<html>
<head>
  <title>Lista de Usuarios</title>
</head>
<body>
  <center><h3><strong>LISTA DE USUARIOS</strong></h3></center>
  <table>
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
              <td>{{$i+1}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->lastName}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->profile->name}}</td>
              <td>{{$user->state->name}}</td>
            </tr>  
        @endforeach
    </tbody>
  </table>
</body>
</html>



