<?php
date_default_timezone_set('America/Santiago');
include '../controlador/sesion.php';
include '../archivo/conexion.php';
require_once '../Classes/PHPExcel.php';
$db=new conexion();

$objPHPExcel = new PHPExcel();

$time = time();
$dateActual = date("Y-m-d H:i:s", $time);
$fecha = $db->cleanString($_POST['fecha']);
$dateMes= $db->fecha($fecha);
$dateReg = $db->fechaReg($fecha);
$retorno="";
$temporal= "#TempFacturas";
$numFact="a.Numefac--";


// CONEXIÓN A BASE DE DATOS CONTABILIDAD
// $nombreServer = "EQUIPO\SQLEXPRESS"; //serverName\instanceName
// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
// $connection = array( "Database"=>"Contabilidad_Training","CharacterSet"=>'UTF-8');
// $connect = sqlsrv_connect($nombreServer, $connection);

$serverName = "EQUIPO\SQLEXPRESS"; //serverName\instanceName
// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
// ini_set('mssql.charset', 'UTF-8');
$connectionInfo = array( "Database"=>"hotelfpsla","CharacterSet"=>'UTF-8');
$conn = sqlsrv_connect($serverName, $connectionInfo);

if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

if (empty($fecha)) {
	$retorno .= "Ingrese una fecha";
	header('Location: mes-contable.php');
}

if ($retorno == "") {
  		$objPHPExcel->
  				getProperties()
  					->setCreator("Hotel Four Points by Sheraton Los Ángeles")
  					->setLastModifiedBy("Hotel FPSLA")
  					->setTitle("Mes Contable")
  					->setSubject("Mes Contable")
  					->setDescription("Mes Contable")
  					->setKeywords("Hotel - Contabilidad")
  					->setCategory("reportes");

      $sqli = "SELECT a.idfuente, a.numdoctra, a.codicta, a.Fechatra, a.TipoFac, a.Cliprv, a.Nittra, a.Numefac, Sum(a.Valortra) as Valor,
ValorImp1 = Case When (Select sum(Valortra) from Transac Where codicta = '1210152' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) is NULL Then 0
else (Select sum(Valortra) from Transac Where codicta = '1210152' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) end,
BaseImp1 = Case When (Select sum(Baseretetra) from Transac Where codicta = '1210152' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) is NULL Then 0
else (Select sum(Baseretetra) from Transac Where codicta = '1210152' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) end,
ValorImp2 = Case When (Select sum(Valortra) from Transac Where codicta = '1210151' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) IS NULL then 0
else (Select sum(Valortra) from Transac Where codicta = '1210151' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra ) end,
BaseImp2 = Case When (Select sum(Baseretetra) from Transac Where codicta = '1210151' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) is NULL Then 0
else (Select sum(Baseretetra) from Transac Where codicta = '1210151' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) end,
ValorImp3 = Case When (Select sum(Valortra) from Transac Where codicta = '1210101' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) is NULL Then 0
else (Select sum(Valortra) from Transac Where codicta = '1210101' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) end,
BaseImp3 = Case When (Select sum(Baseretetra) from Transac Where codicta = '1210101' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra) is NULL Then 0
else (Select sum(Baseretetra) from Transac Where codicta = '1210101' and Statustra = 'AC' and idfuente+numdoctra = a.idfuente+a.numdoctra)  end
into $temporal
from Transac as a
where a.codicta = '2150101'
and a.idfuente in ('12','13','20')
and a.statustra = 'ac' and anotra = $dateMes
group by a.idfuente, a.codicta, a.TipoFac, a.Cliprv, a.Nittra, a.Numefac, a.numdoctra, a.fechatra
Order by a.TipoFac, a.fechatra, a.Numefac";
    	$stmtc = sqlsrv_query($connect,$sqli);

      $sqli = "SELECT Max(a.Fechatra) as Fecha_de_Factura, a.TipoFac as Tipo_Documento, b.Razoncial as Proveedor, a.Nittra as R_U_T,  a.Numefac as N_Documento,Sum(baseimp1) + SUm(baseimp2) + Sum(baseimp3) as Neto_Afecto,Neto_Exento = case Sum(baseimp1) + Sum(baseimp2) + Sum(baseimp3) When 0 Then Sum(Valor) * -1 Else (Sum(Valor) * -1) - (Sum(baseimp1) + Sum(baseimp2) + Sum(baseimp3) + Sum(valorimp1) + Sum(valorimp2) + Sum(valorimp3)) End, Sum(valorimp1) as Recarga_5_Carnes, Sum(valorimp2) as Recarga_12_Harinas, Sum(valorimp3) as Iva, Sum(Valor)*-1 as Total FROM $temporal as a inner join Proveedores as b on a.Cliprv = b.Idprove group by a.idfuente, a.codicta, a.TipoFac, a.Cliprv, a.Nittra, b.Razoncial, $numFact, a.numdoctra, a.fechatra Order by Tipo_Documento, Fecha_de_Factura, N_Documento";
      $stmtc = sqlsrv_query($connect,$sqli);
      $i=1;
  		while($row = sqlsrv_fetch_array($stmtc,SQLSRV_FETCH_NUMERIC)) {

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

            $sqli = "Drop table $temporal";
            $stmt = sqlsrv_query($connect,$sqli);

	          if($stmt===false) {
    	         die(print_r( sqlsrv_errors(),true));
             }
             else{
               $sql = "INSERT INTO registro (f_mes_contable,fecha_consulta,fk_us_id) VALUES (?,?,?)";
               $params = array($dateReg,$dateActual,$id);
               $stmt = sqlsrv_query($conn, $sql, $params);
             }
}
else{
  echo "Error al ingresar la fecha";
}
