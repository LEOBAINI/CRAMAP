<?php

/*
Devuelve la antiguedad en segundos de un archivo determinado.
Lo hace restando el timestamp de creación, vs la hora actual.
*/
 function antiguedadArchivo($archivo){
 	$archivoFecha=date (filemtime($archivo));
	$ahoraFecha=date(time());
    
	return $ahoraFecha-$archivoFecha;

 }
/*
Recibe un array asociativo que debe contener las palabras latitude y longitude para poder dibujar.
El color y ancho, se manejan desde el archivo settings.php
*/
 function dibujarCirculos($row,$color,$radius){
    if(!empty($row)){
    foreach($row as $fila) {
     echo   'circle=L.circle(['.$fila["latitude"].','.$fila["longitude"].'], {';
     echo   'color: "'.$color.'",';
     echo   'fillColor: "'.$color.'",';
     echo   'fillOpacity: 0.2,';
     echo   'radius: '.$radius;
     echo   '}).addTo(map);';
     
     echo "\n";
    }
}
}
function dibujarMarcadores($row){//L.marker([51.5, -0.09]).addTo(map)
foreach($row as $fila) {
     echo   'marker2=L.marker(['.$fila["latitude"].','.$fila["longitude"].'], {';
     echo   'color: "orange",';
    // echo 'fillColor: "#f03",';
     echo   'fillOpacity: 0.01,';
     echo   'radius: 60';
     echo   '}).addTo(map);';
     echo "\n";
    }
}
/*
Es la etiqueta que aparece en la barra inferior
*/
function mostrarEtiquetaInformativa($cantidadAlarmasRealTime,$cantidadJobsAbiertos,$cantidadHistoricos){
    if(empty($cantidadHistoricos)){
        $cantidadHistoricos[]='';
    }

    echo settings::etiquetaAlarmasRealTime." : "
    .count($cantidadAlarmasRealTime)." || "
    .settings::etiquetaJobsAbiertos." : ".
    $cantidadJobsAbiertos." || "
    .settings::etiquetaHistoricos." : ".count($cantidadHistoricos);
    }
    
/*
Dibuja las alarmas en tiempo real, en caso de job abierto, se dibuja una moto.
Devuelve la cantidad de jobs abiertos para luego poder ser usado por el contados de jobs abiertos que se muestra
en la etiqueta
*/
function dibujarPuntos($row){
    $motos=0;
    
    foreach($row as $fila) {
        
        echo 'lat_lng = ['.$fila["latitude"].','.$fila["longitude"].'];';
        echo "\n";
        echo 'L.marker(lat_lng,{icon:'; 
        if($fila["job_no"]==''){
            echo    'iconoAlarmaTiempoReal';
        }else{
            echo    'iconoDeMoto';
            $motos=$motos+1;
        }
        
        echo '}).addTo(map).bindPopup("'

        .'descr:'.$fila["descr"].'<br>'
        .'contrato:'.$fila["contrato"].'<br>'
        .'job_no:'.$fila["job_no"].'<br>'
        .'geo_code:'.$fila["geo_code"].'<br>'
        .'tipo_eventos:'.$fila["geo_code"].'<br>'
        .'alarm_date:'.$fila["alarm_date"].


        '",{autoClose:';

        echo settings::getAutoClose();// si se cierra auto los pop ups o no

        echo '});';
        echo "\n";
        
        echo 'bounds.extend(lat_lng)';
        echo "\n";
    }
    return $motos;
}
/*
Devuelve el array asociativo correspondiente a los objetos formados en el json
Lo hace posible el parámetro true de json_decode($eventos_json, true); 
*/
function leerArchivoJson($rutaAlArchivo,$NombreIndex){

    $eventos_json = file_get_contents($rutaAlArchivo); 
    $decoded_json = json_decode($eventos_json, true); 
    $eventos = $decoded_json[$NombreIndex];
    return $eventos;
}
function recargarHistorico(){
        if (file_exists('eventohis.json')) {

            if(antiguedadArchivo('eventohis.json')>60*30){// cada 30 minutos
              recargarJson('eventohis.json');
             }
        }else{// si no existe, crear

             recargarJson('eventohis.json');
        }
}
function recargarJson($archivo){
    $instanciaSqlServer=new  miconexion();
    $instanciaSqlServer->obtenerDatosAJson(settings::getFicheroHistorico(),$archivo);
}

 ?>
