<?php

class settings{

//*****************************************Settings*****************************************
const  tiempoRefreshMapa='120000';//(Milisegundos)
const  latLongitudInicial='-34.596352, -58.484019';// buscar un punto del pais desde google maps
const  autoClose='false';
const  serverIP='xxxx';
const  portdb='xxx';
const  userdb='xx';
const  passdb='xxx';
const  database='xx';
const  ficheroRealtime='C:\xampp\Queries\ALarmasBufer.sql';
const  ficheroHistorico='C:\xampp\Queries\incidentes2.sql';
const  tiempoConsultaficheroRealtime=60; // segundos que se refrescará el json que lee el mapa
const  tiempoConsultaficheroHistorico=1800; // segundos que se refrescará el json histórico que lee el mapa

//*****************************************Settings*****************************************


public static function getTiempoRefreshMapa(){
	return self::tiempoRefreshMapa;
}
public static function getLatLongitudInicial(){
	return self::latLongitudInicial;
}
public static function getAutoClose(){
	return self::autoClose;
}
public static function getServerIp(){
	return self::serverIP;
}
public static function getPortDb(){
	return self::portdb;
}
public static function getUserDb(){
	return self::userdb;
}
public static function getPassDb(){
	return self::passdb;
}
public static function getDataBase(){
	return self::database;
}
public static function getFicheroRealTime(){
	return self::ficheroRealtime;
}
public static function getFicheroHistorico(){
	return self::ficheroHistorico;
}



}
?>