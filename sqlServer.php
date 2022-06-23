<?php 

class miconexion {
	
/**
* Gestiona la conexión con la base de datos
*/
public function obtenerDatos($ficheroQuery){
	//include 'settings.php';	
	include "lectorFichero.php";
	
	$instanciaFichero=new lectorFichero();
	$contenidoFichero=$instanciaFichero->leerFichero($ficheroQuery);
	$serverName = settings::getServerIp().','. settings::getPortDb(); //serverName\instanceName, portNumber (por defecto es 1433)
	$connectionInfo = array( "Database"=>settings::getDataBase(), "UID"=>settings::getUserDb(), "PWD"=>settings::getPassDb());
	try{
$conn = sqlsrv_connect( $serverName, $connectionInfo);
}catch(Exception $e){
	echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	
 echo "<script>console.log('Console: " . $e->getMessage() . "' );</script>";
}


if( $conn === false ) {
     header('Location: '.'error.php');//'No es posible conectar cn la base de datos';
     die( print_r( sqlsrv_errors(), true));
} else {
  //  print "Good DB Connection: $conn<br>";
}


$sql = $contenidoFichero;//"SELECT top 10 site_no,system_no from system";
$resultados = array();
$result = sqlsrv_query($conn, $sql);
if($result === false) {
    die(print_r(sqlsrv_errors(), true));
}else{
#Fetching Data by array
     $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
     //echo $row;
     //die();
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
   $resultados[]=$row;
}
sqlsrv_free_stmt($result);  
sqlsrv_close($conn);
}
return $resultados;
}

/*

public function conectardb(){

include "lectorFichero.php";
$instanciaFichero=new lectorFichero();
$contenidoFichero=$instanciaFichero->leerFichero('C:\xampp\queries\ALarmasBufer.sql');
$serverName = "10.250.253.51, 1433"; //serverName\instanceName, portNumber (por defecto es 1433)
$connectionInfo = array( "Database"=>"monitordb", "UID"=>"sa", "PWD"=>"mastermind");
try{
$conn = sqlsrv_connect( $serverName, $connectionInfo);
}catch(Exception $e){
	echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	
 echo "<script>console.log('Console: " . $e->getMessage() . "' );</script>";
}


if( $conn === false ) {
     header('Location: '.'error.php');//'No es posible conectar cn la base de datos';
     die( print_r( sqlsrv_errors(), true));
} else {
  //  print "Good DB Connection: $conn<br>";
}


$sql = $contenidoFichero;//"SELECT top 10 site_no,system_no from system";
$resultados = array();
$result = sqlsrv_query($conn, $sql);
if($result === false) {
    die(print_r(sqlsrv_errors(), true));
}else{
#Fetching Data by array
     $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
     //echo $row;
     //die();
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
   $resultados[]=$row;
}
sqlsrv_free_stmt($result);  
sqlsrv_close($conn);
}
return $resultados;

}
*/
}
?>