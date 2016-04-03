<?php 
sleep(2);
include '../archivo/conexion.php';
$db=new conexion();


$serverName = "EQUIPO\SQLEXPRESS"; //serverName\instanceName
// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
// ini_set('mssql.charset', 'UTF-8');
$connectionInfo = array( "Database"=>"hotelfpsla","CharacterSet"=>'UTF-8');
$conn = sqlsrv_connect($serverName, $connectionInfo);
if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$retorno="";

if ($retorno == "") {
	$sql = "SELECT * FROM tb_tipo";
	$stmt = sqlsrv_query($conn,$sql);
	if($stmt===false) {
    	die(print_r( sqlsrv_errors(),true));	
    }
	else{

			if (sqlsrv_fetch_array($stmt) == false) {
				echo "El Usuario no existe";
			}
			else{
				$sql = "SELECT * FROM tb_tipo";
				$stmt = sqlsrv_query($conn,$sql);
				$retorno .='<label for="tipo">Tipo</label>';
				$retorno .='<select name="tipo" id="tipo" class="tipo">';
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