<!DOCTYPE html>
<html>
<head>
	<title>Paine Usuáro - SEEDUC</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-  ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<title>
	</title>
	<style>
	.center1 {
		text-align: center;
		margin: auto;
		width: 70%;
		background: ##fff;
		padding: 30px;
		box-shadow: 1px -1px 69px 0px rgba(27, 126, 27, 0.51);
		margin-top: 50px;
	</style>
	<script>
		function displayView(){
			var display1 = document.getElementById("EventViewTable");
			var display2 = document.getElementById("EventSelectionTable");
			display1.style.display = "block";
			display2.style.display = "none";
		}
		function displaySelection(){
			var display1 = document.getElementById("EventViewTable");
			var display2 = document.getElementById("EventSelectionTable");
			display1.style.display = "none";
			display2.style.display = "block";
		}    
	</script>
</head>
<body>
	<nav class="navbar  navbar-dark bg-dark">
		<a class="navbar-brand" href="#">
			<img src="https://cdn.iconscout.com/public/images/icon/premium/png-512/registration-online-computer-internet-login-subscription-form-ecommerce-3acc50941018c860-512x512.png" width="30" height="30" class="d-inline-block align-top" width="30" height="30" class="d-inline-block align-top" alt="">
			SEEDUC - Sistema de Eventos da Educação
			de Santos
		</a>
		<a class="navbar-brand" href="#">
			<img src="https://openclipart.org/download/247319/abstract-user-flat-3.svg" width="30" height="30" class="d-inline-block align-top-left" alt="" style="position: absolute; left: 800px;">
			<font style="position: static; left: 830px;">{{$name}}</font>
		</a>
		<form action="log_out" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button type="submit" class="btn btn-outline-light">Sair</button>
		</form>
	</nav>
	@yield('content')
</body>
</html>