<?php
include '../controlador/sesion.php';
if (!$tipo==1 and !$estado==1) {
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
			<!-- header -->
			<?php
				if ($tipo==1) {
					include './header.php';
				}
				else{
					if ($tipo==2) {
						include '../controlador/destruir.php';
					}
					else{
						include '../controlador/destruir.php';
					}
				}
			?>
			<div class="cuerpo_panel">
			<h2>Reportes</h2>
				<table>
					<tr class="title">
						<td>Fecha</td>
						<td>Nombre</td>
						<td>Apellido</td>
						<td>Título</td>
						<td>Acción</td>
					</tr>
					<tr>
						<td>11-01-2016</td>
						<td>Juan</td>
						<td>Arriagada</td>
						<td>Informe Mensual</td>
						<td><input type="button" value="Ver" class="boton" /></td>
					</tr>
					<tr>
						<td>12-01-2016</td>
						<td>Juan</td>
						<td>Arriagada</td>
						<td>Informe Mensual</td>
						<td><input type="button" value="Ver" class="boton" /></td>
					</tr>
					<tr>
						<td>13-01-2016</td>
						<td>Juan</td>
						<td>Arriagada</td>
						<td>Informe Mensual</td>
						<td><input type="button" value="Ver" class="boton" /></td>
					</tr>
					<tr>
						<td>14-01-2016</td>
						<td>Juan</td>
						<td>Arriagada</td>
						<td>Informe Mensual</td>
						<td><input type="button" value="Ver" class="boton" /></td>
					</tr>
				</table>
			</div>
			<!-- FOOTER -->
			<?php
				include './footer.php';
			?>
			<!-- FIN FOOTER -->
		</div>
	</div>

	<script src="../js/jquery.js"></script>
	<script src="../js/modernizr.js"></script>
</body>
</html>