<?php
	$INCLUDE_MAP_PROPERTIES = 1;
	include("./include/haut.php"); 
	//error_reporting(E_ALL);
	/* Obtain current user latitude/longitude */
	if($_POST['choice'] == 'adress') {
		$name = $_POST['adressValue'];
		$osm_array_json = file_get_contents("http://nominatim.openstreetmap.org/search?q=" . urlencode($name) . "&format=json");
		$osm_array = json_decode($osm_array_json, true);
		if ($osm_array == null) { header( 'Location: index.php?message=failure' ) ; }
		$user_latitude = $osm_array[0]["lat"];
		$user_longitude = $osm_array[0]["lon"];
	}
	if($_POST['choice'] == 'around') {
		$user_latitude= $_POST['latitude'];
		$user_longitude= $_POST['longitude'];
	}
	
	$range = $_POST['range'];
	$maxPOI = $_POST['maxPOI'];
	
	/* yolo la police */

	/* P31 */
	/* Returns a $poi_id_array_clean array with a list of wikidata pages ID within a $range km range from user location */
	
	$poi_id_array_json = file_get_contents("http://wdq.wmflabs.org/api?q=around[625,$user_latitude,$user_longitude,$range]");
	$poi_id_array = json_decode($poi_id_array_json, true);
	$poi_id_array_clean = $poi_id_array["items"];
	$nb_poi = count($poi_id_array_clean);
	
	$poi_array["nb_poi"] = $nb_poi;
	/* stocks latitude, longitude, name and description of every POI located by ↑ in $poi_array */
	for($i = 0; $i < min($nb_poi, $maxPOI); $i++) {
		$temp_geoloc_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q" . $poi_id_array_clean["$i"] . "&property=P625");
		$temp_geoloc_array = json_decode($temp_geoloc_array_json, true);
		$temp_poi_type_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q" . $poi_id_array_clean["$i"] . "&property=P31");
		$temp_poi_type_array = json_decode($temp_poi_type_array_json, true);
		$temp_poi_type_id = $temp_poi_type_array["claims"]["P31"][0]["mainsnak"]["datavalue"]["value"]["numeric-id"];
		$temp_description_type_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q" . $temp_poi_type_id . "&props=labels&languages=$language");
		$temp_description_type_array = json_decode($temp_description_type_array_json, true);
		$type_name = $temp_description_type_array["entities"]["Q" . $temp_poi_type_id]["labels"]["$language"]["value"];
		$temp_latitude = $temp_geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["latitude"];
		$temp_longitude = $temp_geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["longitude"];
		$temp_description_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q" . $poi_id_array_clean["$i"] . "&props=labels&languages=$language");
		$temp_description_array = json_decode($temp_description_array_json, true);
		$name = $temp_description_array["entities"]["Q" . $poi_id_array_clean["$i"]]["labels"]["$language"]["value"];
		$temp_sitelink_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetentities&ids=Q" . $poi_id_array_clean["$i"] . "&sitefilter=$language&props=sitelinks/urls&format=json");
		$temp_sitelink_array = json_decode($temp_sitelink_array_json, true);
		$temp_sitelink = $temp_sitelink_array["entities"]["Q" . $poi_id_array_clean["$i"]]["sitelinks"][$language . "wiki"]["url"];
	
		$poi_array[$i]["latitude"] = 		$temp_latitude;
		$poi_array[$i]["longitude"] = 		$temp_longitude;
		$poi_array[$i]["name"] = 			$name;
		$poi_array[$i]["sitelink"] = 		$temp_sitelink;
		$poi_array[$i]["type_name"] = 		$type_name;
		$poi_array[$i]["type_id"] = 		$temp_poi_type_id;
		$poi_array[$i]["id"] = 				$poi_id_array_clean[$i];
	}
	$poi_array_json_encoded = json_encode((array)$poi_array);
?>

<p>Carte :</p>
</div>

<div id="map_cart_container">
	<div id="POI_CART"></div>
	<div id="map" class="map"></div>
	<div id="button-wrapper">
		<input type="button" value="Centrer" onclick="center()">
	</div>

	<script>
		var poi_array = new Array();
		var cartList = new Array();
		
		function addToCart(i) {
		//Add a marker to the cart. 
			var j = 0;
			var flag;
			
			flag = 0;
			
			for(j = 0; j < cartList.length; j++)
			{
				if( poi_array[i].id == cartList[j].id )//We test if this POI is already in the list
					flag = 1;
			}
			
			if(flag == 0)
				cartList[cartList.length] = poi_array[i];
			
			reloadCart(cartList);
			var routing_poi_list = new Array();
			routing_poi_list[0] = L.latLng(user_latitude, user_longitude);
			for(j = 0; j < cartList.length; ++j)
				routing_poi_list[j+1] = L.latLng(cartList[j].latitude, cartList[j].longitude);
			var routing = L.Routing.control({
  				waypoints: routing_poi_list 
			}).addTo(map);
		
			routing.hide();
		}
		
		function center(){
			map.setView([user_latitude, user_longitude], 15);
		}

		function deletePOI(i) {
				cartList.splice(i,1);
				reloadCart();
		}
		
		function invertPOI( i, dir) {
			//Cases where we can't do anything
			var temp;
			
			if( ! ( (i == 0 && dir == 'down') || (i == cartList.length - 1 && dir == 'up') ) ) //Already at the bottom or at the top
			{
				if(dir == 'up')//Permutation
				{
					temp = cartList[i + 1];
					cartList[i + 1] = cartList[i];
					cartList[i] = temp;
				}
				else if(dir == 'down')//Permutation
				{
					temp = cartList[i - 1];
					cartList[i - 1] = cartList[i];
					cartList[i] = temp;
				}
			reloadCart();
			}
		}
	
		function reloadCart() {
		
			var i = 0;
			document.getElementById("POI_CART").innerHTML = ''; //Reset
			
			for(i = 0; i <= cartList.length - 1; i++)//Display
			{
				document.getElementById("POI_CART").innerHTML = 
				"<div class=\"eltCart\">" + cartList[i].name + "<br/><i>" + cartList[i].type_name + "</i><br/><a href="+cartList[i].sitelink + 
				">" + <?php echo _MAP_POI_LINK; ?> + "</a><br/>" +
				"<span><a class=\"icon-up-dir\" onclick=\" invertPOI("+ i +",'up'); \"></a>   <a class=\"icon-down-dir\" onclick=\" invertPOI("+ i +",'down'); \"></a>  <a class=\"icon-trash-empty\" onclick=\" deletePOI( " + i + "); \"></a></span></div>" 
				
				+ document.getElementById("POI_CART").innerHTML;
			}
		}
		
		function distance(i){
			Math.radians = function(degrees) {
			  return degrees * Math.PI / 180;
			};

			var userlat = Math.radians(user_latitude);
			var userlong = Math.radians(user_longitude);
			var poilat = Math.radians(poi_array[i].latitude);
			var poilong = Math.radians(poi_array[i].longitude);
			var r = 6633 ; //rayon de la Terre
			//calcul de la distance précise
			var dp = 2*Math.asin(Math.sqrt(Math.pow(Math.sin((userlat-poilat)/2),2)+Math.cos(userlat)*Math.cos(poilat)*Math.pow(Math.sin((userlong-poilong)/2),2)));
			//en km :
			var d = dp*r ;
			//affiche ou pas ? TODO : le rendre plus précis...
			return (d < 0.07) ;
		}

		poi_array = <?php echo($poi_array_json_encoded); ?>;
		user_latitude = <?php echo($user_latitude); ?>;
		user_longitude = <?php echo($user_longitude); ?>;

		/* Correspondances icônes/ID/label */
		var pagicon = [["16970", 'place-of-worship', <?php echo _MAP_POI_TYPE_CATHO ?>], ["2095", 'restaurant', <?php echo _MAP_POI_TYPE_FOOD ?>], ["12518", 'monument', <?php echo _MAP_POI_TYPE_MONUM ?>], ["34627", 'religious-jewish', <?php echo _MAP_POI_TYPE_JEWISH ?>], ["10387575 916475", 'town-hall', <?php echo _MAP_POI_TYPE_MUSEUM ?>], ["207694", 'art-gallery', <?php echo _MAP_POI_TYPE_ART ?>], ["3914 3918 9826 847027", 'college', <?php echo _MAP_POI_TYPE_SCHOOL ?>], ["5503 928830", "rail-metro", <?php echo _MAP_POI_TYPE_SUBWAY ?>, ]];
		var j;
		var ismerged = false;

		L.mapbox.accessToken = 'pk.eyJ1IjoicG9sb2Nob24tc3RyZWV0IiwiYSI6Ikh5LVJqS0UifQ.J0NayavxaAYK1SxMnVcxKg';

		/* Overlay (icons) management */
		var overlayMaps = new Array();
		/* Array of the form "poi type": { poi1, poi2 } */
		var map = L.mapbox.map('map', 'polochon-street.kpogic18');

		for(j = 0; j < pagicon.length; ++j) {
			overlayMaps[pagicon[j][2]] = L.layerGroup([]);
		}

		L.control.layers(null, overlayMaps).addTo(map);

	//Complete list of symbols https://www.mapbox.com/maki/
		
		//marker.bindPopup("Vous êtes ici !").openPopup();

		/* place wiki POI */
		for(i = 0; i < Math.min(poi_array.nb_poi, <?php echo $maxPOI ?>); ++i) {
			var popup_content = new Array();
			var j=0;
			for(j = 0; ((j < pagicon.length) && ((pagicon[j][0]).search(String(poi_array[i].type_id)))); j++)
				;

			if (distance(i) && !ismerged){
				/* merge pop-ups if they are too close */
				popup_content = "Vous êtes ici ! <br>" ;
			    ismerged = true ;
			   	poi_array[i]['marker'] = L.marker([user_latitude, user_longitude], {    icon: L.mapbox.marker.icon({
					'marker-size': 'large',
					'marker-symbol': 'pitch',
					'marker-color': '#fa0'
				})}).addTo(map);
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
			
			popup_content += poi_array[i].name + "<br /> <p><a target=\"_blank\" href=\"http:" + poi_array[i].sitelink + "\">" + <?php echo _MAP_POI_LINK; ?> + "</a> <br /> <a href=\"#\" onclick=\"addToCart(" + i + ",'" + cartList +"'); return false;\">[+]</a></p>";
			poi_array[i]['marker'].bindPopup(popup_content).openPopup();
		}

		if(!ismerged){
			var marker = L.marker([user_latitude, user_longitude], {    icon: L.mapbox.marker.icon({
				'marker-size': 'large',
				'marker-symbol': 'pitch', 
				'marker-color': '#fa0'
			})}).addTo(map);
			marker.bindPopup("Vous êtes ici!").openPopup();
		}

		for(j = 0; j < pagicon.length; ++j) 
			map.addLayer(overlayMaps[pagicon[j][2]]);

		map.setView([user_latitude, user_longitude], 15);
		</script>

	</div>
<div>
<?php
	include("./include/bas.php");
?>
