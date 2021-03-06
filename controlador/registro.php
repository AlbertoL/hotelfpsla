<?php
sleep(2);
require_once ('./sesion.php');
require_once('../archivo/bd.php');
include '../archivo/conexion.php';
$db=new conexion();

$rut=$db->cleanString($_POST['rut']);
$nombre=$db->cleanString($_POST['nombre']);
$apellido=$db->cleanString($_POST['apellido']);
$pass=$db->cleanString($_POST['pass']);
$tipo=$db->cleanString($_POST['tipo']);
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

if (isset($nombre)) {
	if (!is_numeric($nombre)) {
		if(strlen($nombre) < 2 or strlen($nombre) > 30){
		$retorno .='De 2 a 30 caracteres permitidos<br/>';
		}
		elseif(preg_match("/[^a-záéíóúàèìòùäëïöüñ\s]/i", $nombre)){
			$retorno .= "* Sin caracteres especiales <br/> ";
		}
	}
	else{
		$retorno .="Solo letras";
	}
}
else{
	$retorno .="Ingrese un nombre";
}

if (isset($apellido)) {
	if (!is_numeric($apellido)) {
		if(strlen($apellido) < 2 or strlen($apellido) > 30){
		$retorno .='De 2 a 30 caracteres permitidos<br/>';
		}
		elseif(preg_match("/[^a-záéíóúàèìòùäëïöüñ\s]/i", $apellido)){
			$retorno .= "* Sin caracteres especiales <br/> ";
		}
	}
	else{
		$retorno .="Solo letras";
	}
}
else{
	$retorno .="Ingrese un apellido";
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
if (isset($tipo)) {
	if (!is_numeric($tipo)) {
		$retorno .= "Error al ingresar tipo usuario";
	}
	else{
		if(!$tipo > 0 and $tipo < 3){
			$retorno .= "Tipo Invalido";
		}
	}
}

if ($retorno == "") {

	$sql = "SELECT us_rut FROM tb_usuario WHERE us_rut='$rut'";
	$stmt = sqlsrv_query($conn,$sql);

	if($stmt===false) {
    	die(print_r( sqlsrv_errors(),true));
    }
	else{

		if (sqlsrv_fetch_array($stmt) == false) {
			$password = base64_encode($pass);
			$sql = "INSERT INTO tb_usuario (us_rut,us_nombre,us_apellido,us_password,us_tipo,us_estado) VALUES (?,?,?,?,?,?)";
			$params = array($rut,$nombre,$apellido,$password,$tipo,'1');
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
