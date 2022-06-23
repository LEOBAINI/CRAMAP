<?php

class settings{

//*****************************************Settings*****************************************
const  tiempoRefreshMapa='30000';//(Milisegundos)
const  latLongitudInicial='40.401194, -3.671306';// buscar un punto del pais desde google maps
const  autoClose='true';
const  serverIP='xxxx';
const  portdb='xxxccccccc';
const  userdb='xxx';
const  passdb='xxxxxx';
const  database='xxxx';
const  ficheroRealtime='xxxx';
const  ficheroHistorico='xxxx';

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