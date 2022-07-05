<?php 
include_once "settings.php";
include_once "funcionesEspeciales.php";
$diferenciaSegundosRestantesReal=(settings::tiempoConsultaficheroRealtime-antiguedadArchivo(settings::ficheroCacheRealTime));
$diferenciaHistorico=(settings::tiempoConsultaficheroHistorico-antiguedadArchivo(settings::ficheroCacheHistorico));


if($diferenciaSegundosRestantesReal<=0){
    
    echo "REFRESCANDO ARCHIVO ".settings::ficheroCacheRealTime;
    recargarFicheroRealTimeAsync();
    echo "<script>window.location.reload();</script>";
    }else{
        echo settings::ficheroCacheRealTime.':'.     
        (settings::tiempoConsultaficheroRealtime-antiguedadArchivo(settings::ficheroCacheRealTime)).' SEG ' ;


       
    }
if($diferenciaHistorico<=0){

    echo "REFRESCANDO ARCHIVO ".settings::ficheroCacheHistorico;
    recargarFicheroHistoricoAsync();
    echo "<script>window.location.reload();</script>";
}else{
     echo settings::ficheroCacheHistorico.':'.     
        (settings::tiempoConsultaficheroHistorico-antiguedadArchivo(settings::ficheroCacheHistorico)).' SEG' ;
}

 ?>
