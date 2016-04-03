<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="#" id="frmRegistro" method="POST">
	<input type="text" name="pass" />
	<input type="submit" value="Registrar"/>
</form>
<a href="#" id="load" class="load"></a>
<div id="rsp"></div>

<div id="TA_excellent21" class="TA_excellent">
<ul id="bslOaah" class="TA_links xtK9AV">
<li id="IaePBmz" class="yquoHwxWh3">
<a target="_blank" href="https://www.tripadvisor.cl/"><img src="https://static.tacdn.com/img2/widget/tripadvisor_logo_115x18.gif" alt="TripAdvisor" class="widEXCIMG" id="CDSWIDEXCLOGO"/></a>
</li>
</ul>
</div>
<script src="https://www.jscache.com/wejs?wtype=excellent&amp;uniq=21&amp;locationId=1493907&amp;lang=es_CL&amp;display_version=2"></script>


	<?php
// $serverName = "EQUIPO\SQLEXPRESS"; //serverName\instanceName

// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
// $connectionInfo = array( "Database"=>"hotelfpsla");
// $conn = sqlsrv_connect($serverName, $connectionInfo);

// if( $conn ) {
//      echo "Conexión establecida.<br />";
// }else{
//      echo "Conexión no se pudo establecer.<br />";
//      die( print_r( sqlsrv_errors(), true));
// }


// if( $conn === false ) {
//      die( print_r( sqlsrv_errors(), true));
// }

// $sql = "INSERT INTO tb_tipo (tp_nombre) VALUES (?)";
// $params = array("inactivo");

// $stmt = sqlsrv_query( $conn, $sql, $params);
// if( $stmt === false ) {
//      die( print_r( sqlsrv_errors(), true));
// }
// else{
// 	echo "Se realizó la inserción correctamente";
// }


?>
<script src="../js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#frmRegistro').submit(function() {
    				$.ajax({
    				data:$(this).serialize(),
    				url:"../controlador/registro.php",
    				type:"POST",
    				beforeSend:function(){
					$('#load').html('<img src="./load.gif"/ width=115>');
					},
					success:function(respuesta){
						console.log(respuesta);
						$('#rsp').html(respuesta);
						$('#load').html('');
						}	
    					});
    				return false;
    			});
	});
	</script>
</body>
</html>


