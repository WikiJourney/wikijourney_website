<?php
	$INCLUDE_MAP_PROPERTIES = 1;
	include("./include/haut.php"); 
	//error_reporting(E_ALL);
	/* Obtain current user latitude/longitude */
	if($_POST['choice'] == 'adress') {
		$name = $_POST['adressValue'];
		$osm_array_json = file_get_contents("http://nominatim.openstreetmap.org/search?q=" . $name . "&format=json");
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
	
	if($api_answer_array['err_check']['value'] == "true")
		die("Error found when contacting the API : ".$api_answer_array['err_check']['err_msg']);

	//If no error, we put the POI array in a json to use it with JavaScript
	$poi_array_json_encoded = json_encode($api_answer_array['poi']);

?>

<p>Looking for POI around :<i style="float:right;">Lat : <?php echo round($user_latitude,3); ?>° Long : <?php echo round($user_longitude,3); ?>° </i></p>
</div>

<div id="map_cart_container">
	<div id="POI_CART_BLOCK">
		<div id="POI_CART_TITLE">Votre Parcours</div>
		<div id="POI_CART"></div>
	</div>
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
			routing.setWaypoints(routing_poi_list);
		
			routing.hide();
		}
		
		function center(){
			map.setView([user_latitude, user_longitude], 15);
		}

		function deletePOI(i) {
				cartList.splice(i,1);
				reloadCart();
				routing_poi_list = [] ;
				routing_poi_list[0] = L.latLng(user_latitude, user_longitude);
				for(j = 0; j < cartList.length; ++j) {
					routing_poi_list[j+1] = L.latLng(cartList[j].latitude, cartList[j].longitude);
				}
				routing.setWaypoints(routing_poi_list);
		}
		
		function invertPOI( i, dir) {
			//Cases where we can't do anything
			var temp;
			
			if( ! ( (i == 0 && dir == 'up') || (i == cartList.length - 1 && dir == 'down') ) ) //Already at the bottom or at the top
			{
				if(dir == 'down')//Permutation
				{
					temp = cartList[i + 1];
					cartList[i + 1] = cartList[i];
					cartList[i] = temp;
				}
				else if(dir == 'up')//Permutation
				{
					temp = cartList[i - 1];
					cartList[i - 1] = cartList[i];
					cartList[i] = temp;
				}
			reloadCart();
			routing_poi_list = [] ;
			routing_poi_list[0] = L.latLng(user_latitude, user_longitude);
			for(j = 0; j < cartList.length; ++j) {
				routing_poi_list[j+1] = L.latLng(cartList[j].latitude, cartList[j].longitude);
			}
			routing.setWaypoints(routing_poi_list);
			}
		}
	
		function reloadCart() {
		
			var i = 0;
			document.getElementById("POI_CART").innerHTML = ''; //Reset
			
			for(i = 0; i <= cartList.length - 1; i++)//Display
			{
				document.getElementById("POI_CART").innerHTML = document.getElementById("POI_CART").innerHTML +
				"<div class=\"eltCart\"><div class=\"eltCartNumber\">" + (i+1) +"</div>" 
				+cartList[i].name + "<br/><i>" + cartList[i].type_name + "</i><br/><a href="+cartList[i].sitelink + 
				">" + <?php echo _MAP_POI_LINK; ?> + "</a><br/>" +
				"<span><a class=\"icon-up-dir\" onclick=\" invertPOI("+ i +",'up'); \"></a>   <a class=\"icon-down-dir\" onclick=\" invertPOI("+ i +",'down'); \"></a>  <a class=\"icon-trash-empty\" onclick=\" deletePOI( " + i + "); \"></a></span></div>" 
				
				
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

		poi_array_decode = <?php echo($poi_array_json_encoded); ?>;
		poi_array = poi_array_decode['poi_info'];
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
		var routing_poi_list = new Array();
		var routing = L.Routing.control({
  				waypoints: routing_poi_list
			}).addTo(map);
		routing.hide();

		for(j = 0; j < pagicon.length; ++j) {
			overlayMaps[pagicon[j][2]] = L.layerGroup([]);
		}

		L.control.layers(null, overlayMaps).addTo(map);

	//Complete list of symbols https://www.mapbox.com/maki/
		
		//marker.bindPopup("Vous êtes ici !").openPopup();

		/* place wiki POI */
		for(i = 0; i < Math.min(poi_array_decode.nb_poi, <?php echo $maxPOI ?>); ++i) {
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
			
			popup_content += poi_array[i].name + "<br /> <p><a target=\"_blank\" href=\"" + poi_array[i].sitelink + "\">" + <?php echo _MAP_POI_LINK; ?> + "</a> <br /> <a href=\"#\" onclick=\"addToCart(" + i + ",'" + cartList +"'); return false;\">[+]</a></p>";
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
