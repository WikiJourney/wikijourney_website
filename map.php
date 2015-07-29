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
		$osm_array_json = file_get_contents("http://nominatim.openstreetmap.org/search?format=json&q=\"" . urlencode($name)."\"");
		$osm_array = json_decode($osm_array_json, true);
		
		if (!isset($osm_array[0]["lat"]))
			die('
			<script type="text/javascript">
				document.location.href = "index.php?message=adress";
			</script>
			'); 

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
	
	if(is_numeric($_POST['range']))
		$range = $_POST['range'];
	else
		$range = 1;

	$maxPOI = intval($_POST['maxPOI']);
	
	/* yolo la police */

	
	//Make the url
	$api_url = "http://wikijourneydev.alwaysdata.net/api/api.php?displayImg=1&wikivoyage=1&long=".$user_longitude."&lat=".$user_latitude."&lg=".$language."&maxPOI=".$maxPOI."&range=".$range;

	echo "<!-- ".$api_url."-->"; //Test only ? Maybe.

	
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

	if($api_answer_array['err_check']['value'] == "true") //Error check
		die("Error found when contacting the API : ".$api_answer_array['err_check']['err_msg']);

	//If no error, we put the POI array in a json to use it with JavaScript
	$poi_array_json_encoded = json_encode($api_answer_array['poi']);
	

?>

<!-- Loading the scripts for the cart management and stuff -->
<input type="hidden" id="mapPoiLink" value="<?php echo _MAP_POI_LINK; ?>" /><!-- As we can't put php in the js file, we got to put "defines" for translation somewhere.. -->
<script type="text/javascript" src="./scripts/map-scripts.js"></script>
		
<p><?php echo _LOOKING_FOR; ?><i style="float:right;">Lat : <?php echo round($user_latitude,3); ?>° Long : <?php echo round($user_longitude,3); ?>° </i></p>

<?php 
if($api_answer_array['guides']['nb_guides'] != 0) //If we got guides from WikiVoyage, display it
{
	$guides_array = $api_answer_array['guides']['guides_info'];
?>
	<div id="WikiVoyageBox">
		<p>
			<span id="WikiVoyageTitle"><?php echo _SEE_WIKIVOYAGE_GUIDES; ?></span>
			<div id="WikiVoyageThumbnailContainer">
				<div id="WikiVoyageThumbnailContainerScroll">
				<?php 
					for($i = 0; $i < $api_answer_array['guides']['nb_guides']; $i++)
					{
						echo '<span class="WikiVoyageElement">';
						echo '<a target="_blank" href="'. $guides_array[$i]['sitelink'] .'">';
						echo $guides_array[$i]['title'];
						if(isset($guides_array[$i]['thumbnail']))
							echo '<br/><img class="WikiVoyageImg" src="'.$guides_array[$i]['thumbnail'].'" />';
						echo '</a></span>';
					}
				
				?>
				</div>
			</div>
		</p>
	</div>
<?php
}//End displaying guides from Wikivoyage
?>

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
		var pagicon = <?php
			$tabletype = fopen(_MAP_POI_TYPE_FILE, "r") or die("Unable to open file!");
			echo fread($tabletype,filesize(_MAP_POI_TYPE_FILE));
			fclose($tabletype);
			?>;	
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
			
			//Putting name in the box
			popup_content += poi_array[i].name + "<br /> <p>"; 
			//Link to Wikipedia if available
			if(poi_array[i].sitelink != null)
			{
				popup_content += "<a target=\"_blank\" href=\"" + poi_array[i].sitelink + "\">" + '<?php echo _MAP_POI_LINK; ?>' + "</a> <br />";
			}
			//And [+] to put it in the cart
			popup_content += "<a href=\"#\" onclick=\"addToCart(" + i + ",'" + cartList +"'); return false;\">[+]</a></p>";
			
			
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
