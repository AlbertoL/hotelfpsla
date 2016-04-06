<?php
require_once ('../controlador/sesion.php');
if (!$tipo=='1' and !$estado=='1') {
	include '../controlador/destruir.php';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Panel de Control</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
	<link rel="stylesheet" href="../css/normalize.css"/>
	<link rel="stylesheet" href="../css/estilos-panel.css"/>
</head>
<body>
	<div class="contenedor">
		<div class="content_panel">
		<!-- HEADER -->
			<?php
				include './header.php';
			?>
		<!-- FIN HEADER -->
			<div class="cuerpo">
				<div class="content_cuerpo">
					<div class="content_form">
						<h2>Modificar <span>Usuario</span></h2>
						<form id="frmBuscar" action="#" method="POST">
							<input type="text" id="rutusuario" name="rut2" class="buscar" placeholder="Ingrese Rut"/>
							<input type="submit" id="button" class="button" value="Buscar"/>
							<div id="msgUsuario"></div>
						</form>
						<a href="#" id="load1" class="load"></a>
						<div id="rsp1"></div>
						<form id="frmRegistro" action="#" method="POST">
						</form>
						<a href="#" id="load" class="load"></a>
						<div id="rsp"></div>
					</div>
				</div>
				<!-- FOOTER -->
					<?php
						include './footer.php';
					?>
				<!-- FIN FOOTER -->
			</div>
		</div>
	</div>

	<script src="../js/jquery.js"></script>
	<script src="../js/modernizr.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
	<script src="../js/jquery.Rut.min.js"></script>
	<script src="../js/validar.js"></script>
	<script src="../js/modificar.js"></script>
</body>
</html>
