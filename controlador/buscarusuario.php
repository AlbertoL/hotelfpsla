<?php 
sleep(3);
include '../archivo/conexion.php';
$db=new conexion();
// $db->conectar();

$serverName = "EQUIPO\SQLEXPRESS"; //serverName\instanceName
// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
// ini_set('mssql.charset', 'UTF-8');
$connectionInfo = array( "Database"=>"hotelfpsla","CharacterSet"=>'UTF-8');
$conn = sqlsrv_connect($serverName, $connectionInfo);
if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$rut=$db->cleanString($_POST['rut2']);
$retorno="";

if (isset($_POST['rut2'])){
  	$error = $db->verifica_RUT($_POST['rut2']);
  	switch($error) {
	    case 0 : $rut = $_POST['rut2']; break;
	    case 1 : $retorno .='* Rut viene vacío <br/>'; break;
	    case 2 : $retorno .='* El rut no tiene el mínimo de caracteres necesarios<br/>'; break;
	    case 3 : $retorno .='* El rut no viene en un formato numérico <br/>'; break;
	    case 4 : $retorno .='* El rut o el dígito viene vacío. <br/>'; break;
	    case 5 : $retorno .='* El rut y el dígito verificador no coinciden <br/>'; break;
	    default: $retorno .='* Error de la décimanovena dimensión!!! Corran en círculos!!! <br/>'; break;
  	}
}
else{
	$retorno.="Ingrese un rut <br/>";
}

if ($retorno == "") {

	$sql = "SELECT us_rut FROM tb_usuario WHERE us_rut='$rut'";
	$stmt = sqlsrv_query($conn,$sql);
	if($stmt===false) {
    	die(print_r( sqlsrv_errors(),true));	
    }
	else{

			if (sqlsrv_fetch_array($stmt) == false) {
				echo "0";
			}
			else{
				$sql = "SELECT * FROM tb_usuario";
				$stmt = sqlsrv_query($conn,$sql);
				while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_NUMERIC)) {
					$retorno = "<input type=\"hidden\" value='".$row[0]."' id=\"idusu\" class=\"idusu\" name=\"idusu\" />
						<label for='rut'>Rut</label>
						<input type=\"text\" value='".$row[1]."' id=\"rut\" class=\"rut\" name=\"rut\"/>
						<label for=\"nombre\">Nombre</label>
						<input type=\"text\" value='".$row[2]."' id=\"nombre\" class=\"nombre\" name=\"nombre\" />
						<label for=\"apellido\">Apellido</label>
						<input type=\"text\" value='".$row[3]."' id=\"apellido\" class=\"apellido\" name=\"apellido\" />
						<label for=\"pass\">Contraseña</label>
						<input type=\"password\" value='".base64_decode($row[4])."' id=\"pass\" class=\"pass\" name=\"pass\"/>
						<div id=\"listestado\"></div>
						<div id=\"listipo\"></div>
						<div class=\"content_boton\">
							<input type=\"submit\" id=\"update\" class=\"submit\" value=\"Registrar\" />
						</div>
						";
				}
		}
	}
}
else{
	echo $retorno;
}
echo $retorno;

?>