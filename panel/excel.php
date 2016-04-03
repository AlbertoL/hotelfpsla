<?php
include '../archivo/conexion.php';
require_once '../Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

$db=new conexion();
$fecha= $db->fecha($_POST['fecha']);
// $fecha = $db->cleanString($_POST['fecha']);
$retorno="";
$temporal= "#TempFacturas";
$numFact="a.Numefac--";

// $serverName = "EQUIPO\SQLEXPRESS"; //serverName\instanceName
// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
// ini_set('mssql.charset', 'UTF-8');
// $connectionInfo = array( "Database"=>"Contabilidad_Training","CharacterSet"=>'UTF-8');
// $conn = sqlsrv_connect($serverName, $connectionInfo);

$serverName = "EQUIPO\SQLEXPRESS"; //serverName\instanceName
// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
ini_set('mssql.charset', 'UTF-8');
$connectionInfo = array( "Database"=>"hotelfpsla","CharacterSet"=>'UTF-8');
$conn = sqlsrv_connect($serverName, $connectionInfo);

if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}


// echo $fecha;

if (empty($fecha)) {
	$retorno .= "Ingrese una fecha";
	header('Location: mes-contable.php');
}


if ($retorno == "") {

	$sql = "INSERT INTO registro (f_mes_contable,fecha_contable,fk_us_id) VALUES (?,?,?)";
	$stmt = sqlsrv_query($conn,$sql);
	if($stmt===false) {
    	die(print_r( sqlsrv_errors(),true));	
    }
	else{
			$objPHPExcel->
					getProperties()
						->setCreator("Hotel Four Points by Sheraton Los Ángeles")
						->setLastModifiedBy("Hotel FPSLA")
						->setTitle("Mes Contable")
						->setSubject("Mes Contable")
						->setDescription("Mes Contable")
						->setKeywords("Hotel - Contabilidad")
						->setCategory("reportes");
			$i=1;
			while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_NUMERIC)) {

				$objPHPExcel->setActiveSheetIndex(0)
						            ->setCellValue('A'.$i, $row[0])
						            ->setCellValue('B'.$i, $row[1])
						            ->setCellValue('C'.$i, $row[2])
						            ->setCellValue('D'.$i, $row[3])
						            ->setCellValue('E'.$i, $row[4])
						            ->setCellValue('F'.$i, $row[5])
						            ->setCellValue('G'.$i, $row[6])
						            ->setCellValue('H'.$i, $row[7])
						            ->setCellValue('I'.$i, $row[8])
						            ->setCellValue('J'.$i, $row[9])
						            ->setCellValue('K'.$i, $row[10]);
				$i++;
			}
				

						$objPHPExcel->getActiveSheet()->setTitle('Mes Contable');
						$objPHPExcel->setActiveSheetIndex(0);


						header('Content-Type: application/vnd.ms-excel');
						header('Content-Disposition: attachment;filename="Mes Contable.xls"');
						header('Cache-Control: max-age=0');

						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
						$objWriter->save('php://output');
						exit;
			
	}
}
else{
	
}