<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Login</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="{{ asset('login/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('login/css/material-kit.css') }}" rel="stylesheet"/>

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="{{ asset('login/css/demo.css') }}" rel="stylesheet" />

</head>

<body class="index-page">
<div class="wrapper">

		<div class="section section-full-screen section-signup" style="background-image: url('{{ asset('login/img/clinica2.jpg') }}'); background-size: cover; background-position: top center; min-height: 700px;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="card card-signup">
							<form method="POST" action="{{ url('/loginKit') }}" class="form">
                @csrf
								<h3 class="text-divider title">INICIAR SESIÓN</h3>
                <div class="content">
                    <div class="form-group has-info">
                      <div class="input-group ">
                        <span class="input-group-addon" style="padding: 6px 12px;">
                          <i class="material-icons">email</i>
                        </span>
                        <input type="text" class="form-control" name="email" placeholder="Email...">
                      </div>         
                    </div>
                    <div class="form-group has-info">
    									<div class="input-group">
    										<span class="input-group-addon" style="padding: 6px 12px;">
    											<i class="material-icons">lock_outline</i>
    										</span>
    										<input type="password" name="password" placeholder="Constraseña..." class="form-control" />
    									</div>
                    </div>
								</div>
								<div class="footer text-center" style="margin-bottom: 25px; margin-top: 15px;">
                  <button type="submit" class="btn btn-info btn-round">Ingresar<div class="ripple-container"></div></button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>

</div>


</body>
	<!--   Core JS Files   -->
  <script src="{{ ('login/js/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ ('login/js/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ ('login/js/material.min.js') }}"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ ('login/js/nouislider.min.js') }}" type="text/javascript"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
  <script src="{{ ('login/js/material-kit.js') }}" type="text/javascript"></script>


</html>
