<?php
	$INCLUDE_MAP_PROPERTIES = 1;
	include("./include/haut.php"); 
	//error_reporting(E_ALL);
	/* Obtain current user latitude/longitude */
	
	if(!isset($_POST['choice']))//In case the user arrived directly on the page, he's redirected to the index
		die('
		<script type="text/javascript">
			document.location.href = "index.php";
		</script>
		'); 
		

	
	if($_POST['choice'] == 'adress') { //If the user typed an adress, we get location
		$name = $_POST['adressValue'];
		$osm_array_json = file_get_contents("http://nominatim.openstreetmap.org/search?q=" . $name . "&format=json");
		$osm_array = json_decode($osm_array_json, true);
		if ($osm_array == null) { header( 'Location: index.php?message=adress' ) ; }
		$user_latitude = $osm_array[0]["lat"];
		$user_longitude = $osm_array[0]["lon"];
	}
	if($_POST['choice'] == 'around') { //Else, we look for POI around him
		if(isset($_POST['latitude']) && $_POST['latitude'] == 0 && $_POST['longitude'] == 0) //In case geolocation has crashed (it can't be 0,0 exactly)
			die('
			<script type="text/javascript">
				document.location.href = "index.php?message=geoloc";
			</script>
			'); 
		$user_latitude= $_POST['latitude'];
		$user_longitude= $_POST['longitude'];
	}
	
	$range = intval($_POST['range']);
	$maxPOI = intval($_POST['maxPOI']);
	
	/* yolo la police */
/*	
	TEST ONLY !!
	
	//Make the url
	$api_url = "http://wikijourneydev.alwaysdata.net/api/api.php?long=".$user_longitude."&lat=".$user_latitude."&lg=".$language."&maxPOI=".$maxPOI."&range=".$range;
	
	//NOTE !
	//It looks like we're experiencing trouble with this. Actually, it's hard to loopback on our own server with filegetcontents, curl or whatever.
	//Like this, it works. Please don't touch.
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $api_url);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	$api_answer_json = curl_exec($ch);
	curl_close($ch);
	
	$api_answer_array = json_decode($api_answer_json,true); //Decoding the json into an array
*/

//The following line is for test only
	$api_answer_array = json_decode('{"infos":{"source":"WikiJourney API","link":"http:\/\/wikijourney.eu\/","api_version":"alpha 0.0.2"},"user_location":{"latitude":"50.632042299999995","longitude":"3.095606"},"poi":{"nb_poi":5,"poi_info":[{"latitude":50.63306,"longitude":3.09,"name":"Fives, Nord","sitelink":"https:\/\/en.wikipedia.org\/wiki\/Fives,_Nord","type_name":"human settlement","type_id":486972,"id":663930},{"latitude":50.633,"longitude":3.09055,"name":"Fives (m\u00e9tro de Lille M\u00e9tropole)","sitelink":null,"type_name":"metro station","type_id":928830,"id":1936001},{"latitude":50.6366,"longitude":3.08729,"name":"Caulier (m\u00e9tro de Lille M\u00e9tropole)","sitelink":null,"type_name":"metro station","type_id":928830,"id":2274687},{"latitude":50.6301,"longitude":3.09796,"name":"Marbrerie (m\u00e9tro de Lille M\u00e9tropole)","sitelink":null,"type_name":"metro station","type_id":928830,"id":2383251},{"latitude":50.6319,"longitude":3.08516,"name":null,"sitelink":null,"type_name":null,"type_id":null,"id":3279788},{"latitude":50.6468319,"longitude":3.048658516,"name":"Dogeville","sitelink":null,"type_name":null,"type_id":null,"id":3279788}]},"err_check":{"value":false}}',true);
	
	if($api_answer_array['err_check']['value'] == "true") //Error check
		die("Error found when contacting the API : ".$api_answer_array['err_check']['err_msg']);

	//If no error, we put the POI array in a json to use it with JavaScript
	$poi_array_json_encoded = json_encode($api_answer_array['poi']);

?>

<!-- Loading the scripts for the cart management and stuff -->
<input type="hidden" id="mapPoiLink" value="<?php echo _MAP_POI_LINK; ?>" /><!-- As we can't put php in the js file, we got to put "defines" for translation somewhere.. -->
<script type="text/javascript" src="./scripts/map-scripts.js"></script>



<p><?php echo _LOOKING_FOR; ?><i style="float:right;">Lat : <?php echo round($user_latitude,3); ?>° Long : <?php echo round($user_longitude,3); ?>° </i></p>

</div> <!-- Closing the div opened in haut.php -->

<div id="map_cart_container">

	<div id="POI_CART_BLOCK" style="display: none;"><!-- Contains the cart, the cart title... Initially hidden, will open with JS -->
	
		<div id="POI_CART_TITLE"><?php echo _YOUR_PATH; ?></div>
		
		<div id="POI_CART"><!-- THIS IS GOING TO BE FILLED BY CART ELEMENTS IN JAVASCRIPT --></div>
		
		<div id="POI_CART_FOOTER">
			<input type="submit" id="razCart" value="<?php echo _CLEAR_CART; ?>" onclick="razCart();" />
			<input type="submit" title="This function is unavailable for the moment. Stay tuned for the next version ! ;)" id="exportCart" value="<?php echo _SAVE_CART; ?>" onclick="submitCart();" disabled />
			
			<!-- Let's put the hidden form here.. Random. -->
			<form action="map_export.php" method="post" id="hiddenForm">
				<input type="hidden" id="cartJsonExport" name="cartJsonExport" value="" />
			</form>
			
		</div>
		
	</div>
	
	<div id="map" class="map" style="width: 100%;"><!-- THIS IS GOING TO BE FILLED BY THE MAP THANKS TO MAPBOX --></div>
	
	<div id="button-wrapper">
		<input type="button" value="<?php echo _CENTER_BUTTON; ?>" onclick="center()">
	</div>
	<div id="button-routing-wrapper">
		<img src="./images/design/routing_icon.png" title="Hide/Show routing" alt="Hide/Show routing" onclick="hideRoutingContainer();" style="width: 28px;">
	</div>

	<script>
		var poi_array = new Array();
		var cartList = new Array();
		
		poi_array_decode = <?php echo($poi_array_json_encoded); ?>;
		poi_array = poi_array_decode['poi_info'];

		user_latitude = <?php echo($user_latitude); ?>;
		user_longitude = <?php echo($user_longitude); ?>;
		
		



		/* This is for the icon/ID/label association, to be completed */
		var pagicon = [["16970", 'place-of-worship', <?php echo _MAP_POI_TYPE_CATHO ?>], ["2095", 'restaurant', <?php echo _MAP_POI_TYPE_FOOD ?>], ["12518", 'monument', <?php echo _MAP_POI_TYPE_MONUM ?>], ["34627", 'religious-jewish', <?php echo _MAP_POI_TYPE_JEWISH ?>], ["10387575 916475", 'town-hall', <?php echo _MAP_POI_TYPE_MUSEUM ?>], ["207694", 'art-gallery', <?php echo _MAP_POI_TYPE_ART ?>], ["3914 3918 9826 847027", 'college', <?php echo _MAP_POI_TYPE_SCHOOL ?>], ["5503 928830", "rail-metro", <?php echo _MAP_POI_TYPE_SUBWAY ?>, ]];
		var j;
		var ismerged = false;

		L.mapbox.accessToken = 'pk.eyJ1IjoicG9sb2Nob24tc3RyZWV0IiwiYSI6Ikh5LVJqS0UifQ.J0NayavxaAYK1SxMnVcxKg';

		/* Overlay (icons) management */
		var overlayMaps = new Array();
		var map = L.mapbox.map('map', 'polochon-street.kpogic18');
		var routing_poi_list = new Array();
		
		var routing = L.Routing.control({
  				waypoints: routing_poi_list
			}).addTo(map);
			

		for(j = 0; j < pagicon.length; ++j) {
			overlayMaps[pagicon[j][2]] = L.layerGroup([]);
		}

		L.control.layers(null, overlayMaps).addTo(map);


		/* place wiki POI */
		for(i = 0; i < Math.min(poi_array_decode.nb_poi, <?php echo $maxPOI ?>); ++i) {
			var popup_content = new Array();
			var j=0;
			for(j = 0; ((j < pagicon.length) && ((pagicon[j][0]).search(String(poi_array[i].type_id)))); j++)
				;

			if (distance(i) < 0.07 && !ismerged){
				/* merge pop-ups if they are too close */
				popup_content = "<?php echo _YOU_ARE_HERE; ?><br>" ;
			    ismerged = true ;
			   	poi_array[i]['marker'] = L.marker([user_latitude, user_longitude], {    icon: L.mapbox.marker.icon({
					'marker-size': 'large',
					'marker-symbol': 'pitch',
					'marker-color': '#fa0'
				})}).addTo(map); 		//Complete list of symbols https://www.mapbox.com/maki/
			}
			else if(j < pagicon.length){
				/* if we have an icon for the type of POI, display it */
				poi_array[i]["marker"] = L.marker([poi_array[i].latitude, poi_array[i].longitude], {    icon: L.mapbox.marker.icon({
					'marker-size': 'large',
					'marker-symbol': pagicon[j][1],
				})}).addTo(map);
				
				overlayMaps[pagicon[j][2]].addLayer(poi_array[i]['marker']);
			}
			else{
				poi_array[i]["marker"] = L.marker([poi_array[i].latitude, poi_array[i].longitude]).addTo(map); 
			}
			
			popup_content += poi_array[i].name + "<br /> <p><a target=\"_blank\" href=\"" + poi_array[i].sitelink + "\">" + '<?php echo _MAP_POI_LINK; ?>' + "</a> <br /> <a href=\"#\" onclick=\"addToCart(" + i + ",'" + cartList +"'); return false;\">[+]</a></p>";
			poi_array[i]['marker'].bindPopup(popup_content).openPopup();
		}

		if(!ismerged){
			var marker = L.marker([user_latitude, user_longitude], {    icon: L.mapbox.marker.icon({
				'marker-size': 'large',
				'marker-symbol': 'pitch', 
				'marker-color': '#fa0'
			})}).addTo(map);
			marker.bindPopup("<?php echo _YOU_ARE_HERE; ?>").openPopup();
		}

		for(j = 0; j < pagicon.length; ++j) 
			map.addLayer(overlayMaps[pagicon[j][2]]);
		

		//Draw a circle on the map around user's position, the range is $range.
		var circle_options = {
			  color: ' rgb(248,99,99)',      // Stroke color
			  opacity: 0.8,         // Stroke opacity
			  weight: 3,         // Stroke weight
			  fillColor: 'rgb(248,99,99)',  // Fill color
			  fillOpacity: 0.05,    // Fill opacity
			  dashArray: "5,10"
		 };

		var circle_range = L.circle([<?php echo $user_latitude; ?>, <?php echo $user_longitude; ?>], <?php echo $range*1000; ?>, circle_options).addTo(map);	
		
		//And setting the view.
		map.setView([user_latitude, user_longitude], 15);
		
		</script>

	</div>
<div>
<?php
	include("./include/bas.php");
?>
