
<?php
	include 'settings.php';	
	include "sqlServer.php";
	include 'funcionesEspeciales.php';
	include 'extractor.php';
?>	
<!DOCTYPE html>
<html lang="es">
<head>


	
     <meta name="viewport" content="width=device-width, initial-scale=1.0">   
	 <link rel="stylesheet"  type = "text/css" href="css/bootstrap.min.css">
	 <link rel="stylesheet"  type = "text/css" href="js/leaflet.css">
	 <link rel="stylesheet"  type = "text/css" href="css/estilos.css">
	 <script src="js/leaflet.js"></script>	
	 <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	 <link rel="icon" href="prosegur.png">  
	 <title>GEOALARMAS 2.0</title>

	
</head>
<body>

<div id="map" ></div>


<script>

	var map = L.map('map').setView([
		<?php
		 echo settings::getLatLongitudInicial(); //-34.567200,-58.562193
		 ?>
		], 30);
	
	var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
	
	let lat_lng;
	var circle;
	var marker;
	var marker2;
	bounds = L.latLngBounds();
	var iconoAlarmaTiempoReal = new L.Icon({
  	iconUrl: 'police-siren-siren.gif',//police-siren-siren.gif',
  	iconSize: [11, 11],
  	iconAnchor: [10, 10]
}); 

	var iconoDeMoto = new L.Icon({
  	iconUrl: 'moto.jpg',
  	iconSize: [50, 50],
  	iconAnchor: [30, 30]
});
	<?php

	recargarHistorico();

	
	$instanciaSql=new miconexion();
	
	
	$arrayAsociativoAlarmasTiempoReal=$instanciaSql->obtenerDatos(settings::getFicheroRealTime());	
	
	$motos=dibujarPuntos($arrayAsociativoAlarmasTiempoReal);

	$arrayAsociativoAlarmasHistorico=leerArchivoJson('eventohis.json','INFO');//$instanciaSql->obtenerDatos(settings::getFicheroHistorico());

	

	dibujarCirculos(
		$arrayAsociativoAlarmasHistorico,
		settings::colorCirculoHistorico1,
		settings::tamanioCirculoHistorico1
	);
	?>
	
	
	map.fitBounds(bounds)// hace que el mapa se acomode para que se visualicen todos los marcadores
	

	 	function actualizar(){location.reload(true);}

		setInterval("actualizar()",
		<?php echo settings::getTiempoRefreshMapa();?>);



</script>
<div id="info">
<?php
mostrarEtiquetaInformativa($arrayAsociativoAlarmasTiempoReal,$motos,$arrayAsociativoAlarmasHistorico);
echo "<br>";
//echo antiguedadArchivo('eventohis.json');
?>
<img id="logo" src = 'prosegur.png' />
</div>
<script>

</script>
</body>
</html>