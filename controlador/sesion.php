<?php 
session_start();
if(isset($_SESSION['admin'])){
	// include '../controlador/destruir.php';
	$tipo=base64_decode($_SESSION['admin']);
	$estado=base64_decode($_SESSION['estado']);
}else{
	if (isset($_SESSION['basico'])) {
		$tipo=base64_decode($_SESSION['basico']);
		$estado=base64_decode($_SESSION['estado']);
	}
	else{
		include '../controlador/destruir.php';
	}
}
 ?>