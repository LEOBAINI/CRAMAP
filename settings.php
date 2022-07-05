
<?php

class settings{

//*****************************************Settings*****************************************
//const  tiempoRefreshMapa=60*5;//(Segundos)
const  latLongitudInicial='-34.596352, -58.484019';// buscar un punto del pais desde google maps
const  autoClose='false';
const  serverIP='10.54.118.60';
const  portdb='1433';
const  userdb='sa';
const  passdb='anaconda1';
const  database='monitordb';
const  ficheroRealtime='C:\xampp\Queries\ALarmasBufer.sql';
const  ficheroHistorico='C:\xampp\Queries\utimas2hs.sql';//incidentesDia.sql';
const  tiempoConsultaficheroRealtime=60*5; // segundos que se refrescará el json que lee el mapa
const  tiempoConsultaficheroHistorico=60*60*12; // segundos que se refrescará el json histórico que lee el mapa
const  tamanioCirculoHistorico1=10; // es el radio del circulo
const  etiquetaJobsAbiertos='ACUDAS EN MOVIMIENTO';
const  etiquetaHistoricos='HISTÓRICO ULTIMAS 24 HORAS';
const  etiquetaAlarmasRealTime='ALARMAS EN TIEMPO REAL';
const  ficheroCacheHistorico='eventohistorico.json';
const  ficheroCacheRealTime='eventosRealTime.json';
const  username='alarmas';// para el login inicial
const  password='dtialarmas'; //para el login inicial

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