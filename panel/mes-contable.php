<?php
include '../controlador/sesion.php';
if (!$estado == 1) {
	include '../controlador/destruir.php';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta c<harset="UTF-8">
	<title>Panel de Control</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
	<link rel="stylesheet" href="../css/normalize.css"/>
	<link rel="stylesheet" href="../css/estilos-panel.css"/>
	<link rel="stylesheet" href="../css/jquery-ui.min.css"/>
</head>
<body>
	<div class="contenedor">
		<div class="content_panel">
		<!-- HEADER -->
			<?php
			if ($tipo == 1) {
				include './header.php';
			}
			else{
				include './headbasico.php';
			}
			?>
		<!-- FIN HEADER -->
			<div class="cuerpo">
				<div class="content_cuerpo">
					<div class="content_form">
						<h2>Mes <span>Contable</span></h2>
						<form action="excel.php" method="POST">
							<input type="text" id="fecha" name="fecha" class="buscar" placeholder="mm-aaaa"/>
							<input type="submit" id="button" class="button" value="Generar"/>
						</form>
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
	<script src="../js/jquery-ui.min.js"></script>
	<script src="../js/fecha.js"></script>
</body>
</html>