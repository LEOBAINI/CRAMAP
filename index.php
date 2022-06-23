
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

<div id="map" style="width: 100%; height: 99%;"></div>


<script>

	var map = L.map('map').setView([
		<?php
		 echo settings::getLatLongitudInicial(); //-34.567200,-58.562193
		 ?>
		], 30);
	//map.invalidateSize(true);

	var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 20,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
	let lat_lng;
	var marker;
	bounds = L.latLngBounds();
	var customIcon = new L.Icon({
  	iconUrl: 'police-siren-siren.gif',
  	iconSize: [10, 10],
  	iconAnchor: [10, 10]
});
	<?php
	
	$instanciaSql=new miconexion();
	
	$row=$instanciaSql->obtenerDatos(settings::getFicheroRealTime());
	//conectardb();

	
	foreach($row as $fila) {
		
		echo 'lat_lng = ['.$fila["longitude"].','.$fila["latitude"].'];';
		echo "\n";
		echo 'L.marker(lat_lng,{icon: customIcon}).addTo(map).bindPopup("'

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
	?>
	
	
	map.fitBounds(bounds)
	

	 	function actualizar(){location.reload(true);}

		setInterval("actualizar()",
		<?php echo settings::getTiempoRefreshMapa();
		?>);



</script>
<div id="info">
<?php
echo "ALARMAS EN CURSO : ".count($row);
?>
<img src = 'prosegur.png' width="35" height="35" id="logo" />
</div>

</body>
</html>