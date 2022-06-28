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
 ?>