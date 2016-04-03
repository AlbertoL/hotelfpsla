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

$rut=$db->cleanString($_POST['rut2']);

$retorno="";

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


if (isset($pass)) {
	if (!preg_match("/[^0-9a-záéíóúàèìòùäëïöüñ@_\s]/i", $pass)) {
		if(strlen($pass) < 8 or strlen($pass) > 12){
			$retorno .='De 8 a 30 caracteres permitidos<br/>';
		}
	}
	else{
		$retorno .="Puede ingrese números, letras y @ _ ";
	}
}
else{
	$retorno .="Ingrese una contraseña";
}


// $password = crypt_blowfish_bydinvaders($pass);

// function crypt_blowfish_bydinvaders($password, $digito = 7) {
// 	$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
// 	$salt = sprintf('$2a$%02d$', $digito);
// 	for($i = 0; $i < 22; $i++)
// 	{
// 		$salt .= $set_salt[mt_rand(0, 22)];
// 	}
// 	return crypt($password, $salt);
// }
	
	// Comprobación de contraseña BD y contraseña formulario
	// if( crypt($nombre, $pass2) == $pass2) {
	// 	$retorno = 'Es igual';
	// }
	// else{
	// 	$retorno = 'No es igual';
	// }

if ($retorno == "") {

	$sql = "SELECT us_rut FROM tb_usuario WHERE us_rut='$rut'";
	$stmt = sqlsrv_query($conn,$sql);

	if($stmt===false) {
    	die(print_r( sqlsrv_errors(),true));	
    }
	else{

		if (sqlsrv_fetch_array($stmt) == false) {

			$sql = "INSERT INTO tb_usuario (us_rut,us_nombre,us_apellido,us_password,us_tipo) VALUES (?,?,?,?,?)";
			$params = array($rut,$nombre,$apellido,$password,1);
			$stmt = sqlsrv_query($conn, $sql, $params);
			if($stmt === false) {
     			die( print_r( sqlsrv_errors(), true));
			}
			else{
				echo "Usuario ingresado correctamente";
			}
		}
		else{
			echo "El Rut $rut ya se encuentra registrado";
		}
	}
}
else{
	echo $retorno;
}


?>