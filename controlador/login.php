<?php
sleep(3);
include '../archivo/conexion.php';
$db=new conexion();
// $db->conectar();
session_start();
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
$pass=base64_encode($db->cleanString($_POST['pass']));

if (isset($_POST['rut'])){
  	$error = $db->verifica_RUT($_POST['rut']);
  	switch($error) {
	    case 0 : $rut = $_POST['rut']; break;
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

	$sql = "SELECT us_rut,us_password FROM tb_usuario WHERE us_rut='$rut' and us_password='$pass'";
	$stmt = sqlsrv_query($conn,$sql);
	if($stmt===false) {
    	die(print_r( sqlsrv_errors(),true));
    }
	else{

			if (sqlsrv_fetch_array($stmt) == false) {
				echo "Rut o contraseña inválidos";
			}
			else{
				$sql = "SELECT us_tipo, us_estado, us_id FROM tb_usuario WHERE us_rut='$rut' AND us_estado='1'";
				$stmt = sqlsrv_query($conn,$sql);
				while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_NUMERIC)) {
					switch ($row[0]) {
                		case '1':
                			if ($row[1]==1) {
                				$_SESSION['admin']=base64_encode($row[0]);
		                    $_SESSION['estado']=base64_encode($row[1]);
                        $_SESSION['id']=base64_encode($row[2]);
		                    $retorno=1;
                			}
                			else{
                				$retorno=3;
                			}

                    	break;
                		case '2':
                			if ($row[1]==1) {
                				$_SESSION['basico']=base64_encode($row[0]);
                				$_SESSION['estado']=base64_encode($row[1]);
                        $_SESSION['id']=base64_encode($row[2]);
                    		$retorno=2;
                			}
                			else{
                				$retorno = 3;
                			}
                    	break;
                		default:
                    		$retorno=9;
                    	break;
            		}
				}
		}
	}
}
else{
	echo $retorno;
}
echo $retorno;

?>
