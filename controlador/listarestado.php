<?php 
sleep(2);
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

// $rut=$db->cleanString($_POST['rut2']);

$retorno="";

// if (isset($_POST['rut2'])){
//   	$error = $db->verifica_RUT($_POST['rut2']);
//   	switch($error) {
// 	    case 0 : $rut = $_POST['rut2']; break;
// 	    case 1 : $retorno .='* Rut viene vacío <br/>'; break;
// 	    case 2 : $retorno .='* El rut no tiene el mínimo de caracteres necesarios<br/>'; break;
// 	    case 3 : $retorno .='* El rut no viene en un formato numérico <br/>'; break;
// 	    case 4 : $retorno .='* El rut o el dígito viene vacío. <br/>'; break;
// 	    case 5 : $retorno .='* El rut y el dígito verificador no coinciden <br/>'; break;
// 	    default: $retorno .='* Error de la décimanovena dimensión!!! Corran en círculos!!! <br/>'; break;
//   	}
// }
// else{
// 	$retorno.="Ingrese un rut <br/>";
// }

if ($retorno == "") {

	$sql = "SELECT * FROM tb_estado";
	$stmt = sqlsrv_query($conn,$sql);
	if($stmt===false) {
    	die(print_r( sqlsrv_errors(),true));	
    }
	else{

			if (sqlsrv_fetch_array($stmt) == false) {
				echo "El Usuario no existe";
			}
			else{
				$sql = "SELECT * FROM tb_estado";
				$stmt = sqlsrv_query($conn,$sql);
				$retorno .='<label for="estado">Estado</label>';
				$retorno .='<select name="estado" id="estado" class="estado">';
				while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_NUMERIC)) {
					$retorno .= '<option value='.$row[0].'>'.$row[1].'</option>';
				}
				$retorno .= '</select>';
		}
	}
}
else{
	echo $retorno;
}
echo $retorno;

?>