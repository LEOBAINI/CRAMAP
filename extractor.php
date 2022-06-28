<?php
include "sqlServer.php";
include "settings.php";
include "funcionesEspeciales.php";
if(antiguedadArchivo('eventos.json')>10){
$instanciaSqlServer=new  miconexion();
$instanciaSqlServer->obtenerDatosAJson(settings::getFicheroRealTime(),'eventos.json');
}

$eventos_json = file_get_contents('eventos.json');
 
$decoded_json = json_decode($eventos_json, true);
 
$eventos = $decoded_json['INFO'];
 
foreach($eventos as $evento) {
    $tipo_eventos = $evento['descr'];
    $alarm_date = $evento['alarm_date'];
 
   echo $tipo_eventos.'|'.$alarm_date;
   echo "<br>";
}
echo "La antiguedad del archivo en segundos es ".antiguedadArchivo('eventos.json');





 ?>