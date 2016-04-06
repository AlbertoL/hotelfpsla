<?php
require_once('../archivo/bd.php');
require_once ('../controlador/sesion.php');
include '../archivo/conexion.php';
if (!$tipo==1 and !$estado==1) {
	include '../controlador/destruir.php';
}
$db=new conexion();
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
						<td>NOMBRE</td>
						<td>MES CONTABLE</td>
						<td>FECHA SOLICITUD</td>
					</tr>
					<?php
						$sql = "SELECT u.us_nombre+' '+u.us_apellido AS 'NOMBRE', r.f_mes_contable AS 'MES CONTABLE', r.fecha_consulta AS 'DIA SOLICITUD' FROM tb_usuario u INNER JOIN registro r ON r.fk_us_id = u.us_id";
						$stmt = sqlsrv_query($conn,$sql);
						while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_NUMERIC)){
							$dateF=date_create($row[2]);
							$format= date_format($dateF, 'd-m-Y H:i:s');
							echo "<tr>";
							echo "<td>".$row[0]."</td>";
							echo "<td>".$db->dateMes($row[1])."</td>";
							echo "<td>".$format."</td>";
							echo "</tr>";
						}
					 ?>

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
