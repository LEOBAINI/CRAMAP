
<!DOCTYPE html>
<html lang="es">
<head>
<?php
	include 'settings.php';	
	include "sqlServer.php";
?>	

	
<meta name="viewport" content="width=device-width, initial-scale=1.0">   
	 <link rel="stylesheet"  type = "text/css" href="css/bootstrap.min.css">
	 <link rel="stylesheet"  type = "text/css" href="js/leaflet.css">
	 <link rel="stylesheet"  type = "text/css" href="css/estilos.css">
	 <script src="js/leaflet.js"></script>	
	 <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  
	<title>GEOALARMAS 1.0</title>

	
</head>
<body>

<div id="map" ></div>


<script>

	var map = L.map('map').setView([
		<?php
		 echo settings::getLatLongitudInicial(); //-34.567200,-58.562193
		 ?>
		], 30);
	//map.invalidateSize(true);
	var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
	
	let lat_lng;
	var circle;
	var marker;
	bounds = L.latLngBounds();
	var customIcon = new L.Icon({
  	iconUrl: 'police-siren-siren.gif',
  	iconSize: [10, 10],
  	iconAnchor: [10, 10]
}); 

	var moto = new L.Icon({
  	iconUrl: 'moto.jpg',
  	iconSize: [30, 30],
  	iconAnchor: [30, 30]
});
	<?php
	
	$instanciaSql=new miconexion();
	
	
	$row=$instanciaSql->obtenerDatos(settings::getFicheroRealTime());	
	$motos=dibujarPuntos($row);

	$row2=$instanciaSql->obtenerDatos(settings::getFicheroHistorico());
	dibujarCirculos($row2);

	?>
	
	
	map.fitBounds(bounds)
	

	 	function actualizar(){location.reload(true);}

		setInterval("actualizar()",
		<?php echo settings::getTiempoRefreshMapa();?>);



</script>
<div id="info">
<?php
echo "ALARMAS EN CURSO : ".count($row)." || JOBS ABIERTOS : ".$motos." || HISTÓRICO : ".count($row2);

function dibujarPuntos($row){
	$motos=0;
	
	foreach($row as $fila) {
		
		echo 'lat_lng = ['.$fila["latitude"].','.$fila["longitude"].'];';
		echo "\n";
		echo 'L.marker(lat_lng,{icon:'; 
		if($fila["job_no"]==''){
			echo	'customIcon';
		}else{
			echo	'moto';
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

function dibujarCirculos($row){
	foreach($row as $fila) {
	 echo   'circle=L.circle(['.$fila["latitude"].','.$fila["longitude"].'], {';
	 echo	'color: "blue",';
	// echo	'fillColor: "#f03",';
	 echo	'fillOpacity: 0.01,';
	 echo 	'radius: 10';
	 echo	'}).addTo(map);';
	 echo "\n";
	}
}
?>
<img id="logo" src = 'prosegur.png' />
</div>

</body>
</html>