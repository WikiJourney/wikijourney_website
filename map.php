<?php
	$INCLUDE_MAP_PROPERTIES = 1;
	include("./include/haut.php"); 

	//error_reporting(E_ALL);
	/* Obtain current user latitude/longitude */
	if(isset($_POST['name'])) {
		$name = $_POST['name'];
		$osm_array_json = file_get_contents("http://nominatim.openstreetmap.org/search?q=" . urlencode($name) . "&format=json");
		$osm_array = json_decode($osm_array_json, true);
		$user_latitude = $osm_array[0]["lat"];
		$user_longitude = $osm_array[0]["lon"];
	}
	else {
		$user_latitude= $_POST[0];
		$user_longitude= $_POST[1];
	}
	
	/* P31 */
	/* Returns a $poi_id_array_clean array with a list of wikidata pages ID within a $range km range from user location */
	$range = 1;
	$poi_id_array_json = file_get_contents("http://wdq.wmflabs.org/api?q=around[625,$user_latitude,$user_longitude,$range]");
	$poi_id_array = json_decode($poi_id_array_json, true);
	$poi_id_array_clean = $poi_id_array["items"];
	$nb_poi = count($poi_id_array_clean);
	
	$poi_array["nb_poi"] = $nb_poi;
	/* stocks latitude, longitude, name and description of every POI located by ↑ in $poi_array */
	for($i = 0; $i < min($nb_poi, 5); $i++) {
		echo($poi_id_array_clean["$i"]);
		echo("\n");
		$temp_geoloc_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q" . $poi_id_array_clean["$i"] . "&property=P625");
		$temp_geoloc_array = json_decode($temp_geoloc_array_json, true);

		$temp_latitude = $temp_geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["latitude"];
		$temp_longitude = $temp_geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["longitude"];

		$temp_description_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q" . $poi_id_array_clean["$i"] . "&props=labels&languages=fr");
		$temp_description_array = json_decode($temp_description_array_json, true);
		$name = $temp_description_array["entities"]["Q" . $poi_id_array_clean["$i"]]["labels"]["fr"]["value"];

		$temp_sitelink_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetentities&ids=Q" . $poi_id_array_clean["$i"] . "&sitefilter=frwiki&props=sitelinks/urls&format=json");
		$temp_sitelink_array = json_decode($temp_sitelink_array_json, true);
		$temp_sitelink = $temp_sitelink_array["entities"]["Q" . $poi_id_array_clean["$i"]]["sitelinks"]["frwiki"]["url"];
	
		$poi_array[$i]["latitude"] = $temp_latitude;
		$poi_array[$i]["longitude"] = $temp_longitude;
		$poi_array[$i]["name"] = $name;
		$poi_array[$i]["sitelink"] = $temp_sitelink;
	}
	$poi_array_json_encoded = json_encode((array)$poi_array);
?>

<p>Carte :</p>
</div>

<div id="map_cart_container">
	<div id="POI_CART"></div>
	<div id="map" class="map"></div>

	<script>
		var poi_array = new Array();
		var cartList = new Array();
		
		function addToCart(i) {
		//Add a marker to the cart. 
			cartList[cartList.length] = poi_array[i];
			
			reloadCart(cartList);
		}
		
		function reloadCart() {
		
			var i = 0;
			document.getElementById("POI_CART").innerHTML = ''; //Reset
			
			for(i = 0; i <= cartList.length - 1; i++)//Display
			{
				document.getElementById("POI_CART").innerHTML = "<a href="+cartList[i].sitelink+">" + cartList[i].name + "</a><br />" + document.getElementById("POI_CART").innerHTML;
			}
		}
		
		poi_array = <?php echo($poi_array_json_encoded); ?>;
		user_latitude = <?php echo($user_latitude); ?>;
		user_longitude = <?php echo($user_longitude); ?>;

		L.mapbox.accessToken = 'pk.eyJ1IjoicG9sb2Nob24tc3RyZWV0IiwiYSI6Ikh5LVJqS0UifQ.J0NayavxaAYK1SxMnVcxKg';
		var map = L.mapbox.map('map', 'polochon-street.kpogic18')
		
		/* place the first marker with 50% opacity to distinguish it */	
		//var marker = L.marker([user_latitude, user_longitude], {opacity:0.5, color: '#fa0'}).addTo(map);
		var marker = L.marker([user_latitude, user_longitude], {    icon: L.mapbox.marker.icon({
			'marker-size': 'large',
			'marker-symbol': 'pitch',
			'marker-color': '#fa0'
		})}).addTo(map);
		//Cf liste complète des symboles : https://www.mapbox.com/maki/
		
		marker.bindPopup("Vous êtes ici !").openPopup();

		/* place wiki POI */
		for(i = 0; i < Math.min(poi_array.nb_poi, 5); ++i) {
			var popup_content = new Array();
			if(poi_array[i].sitelink != null)
				popup_content = poi_array[i].name + "<br /> <p><a target=\"_blank\" href=\"http:" + poi_array[i].sitelink + "\">Lien wikipédia</a> <br /> <a href=\"#\" onclick=\"addToCart(" + i + ",'" + cartList +"'); return false;\">[+]</a></p>";
			else
				popup_content = poi_array[i].name + "<br /> <a href=\"http://perdu.com\">[+]</a></p>";
			var marker = L.marker([poi_array[i].latitude, poi_array[i].longitude]).addTo(map); 
			marker.bindPopup(popup_content).openPopup();
		}
		
		map.setView([user_latitude, user_longitude], 15);

		
			
	</script>

	</div>
<div>
<?php
	include("./include/bas.php");
?>
