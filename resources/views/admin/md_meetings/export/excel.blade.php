<!DOCTYPE html>
<html>
<head>
  <title>Historial de Citas</title>
</head>
<body>
  <center><h3><strong>HISTORIAL DE CITAS</strong></h3></center>
  <table>
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



