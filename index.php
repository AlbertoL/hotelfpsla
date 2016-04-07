<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>GHL HOTELES</title>
	<link rel="stylesheet" href="css/normalize.css"/>
	<link rel="stylesheet" href="css/estilos.css"/>
</head>
<body>
	<div class="contenedor">
		<div class="content_form">
			<div class="form">
				<div class="logo">
					<img src="img/logo-fpla.jpg" alt="logo-four-points" class="fpla" />
					<img src="img/ghl.jpg" alt="logo-ghl" class="ghl" />
				</div>
				<div class="login">
				<form id="frmUsuario" name="frmUsuario" action="#" method="POST">

					<input type="text" placeholder="Rut" id="rut" name="rut" autocomplete="off"/>
					<div id="msgUsuario" class="mensaje"></div><div id="datos" name="datos"></div>
					<input type="password" id="pass" placeholder="Contraseña" name="pass" autocomplete="off"/>

					<div class="cont_submit">
					<input id="boton" type="submit" class="btn_enviar" value="Entrar"/>
					</div>
				</form>
					<div id="rsp"></div>
					<a href="#" id="load" class="load"></a>
				</div>
				<div class="olvido_pass">
					<a href="#">¿Olvidó su contraseña?</a>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/modernizr.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/jquery.Rut.min.js"></script>
	<script src="js/pass.js"></script>
	<script src="js/login.js"></script>
</body>
</html>
