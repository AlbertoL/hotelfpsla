<?php
sleep(2);
require_once ('./sesion.php');
require_once('../archivo/bd.php');
include '../archivo/conexion.php';
$db=new conexion();

$retorno="";


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
