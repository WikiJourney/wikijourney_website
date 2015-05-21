<?php
	include("./include/haut_map.php"); 

error_reporting(E_ALL);
//	$name = $_POST['name'];

	/* Encode array and get informations about the page we want (id, description, etc) */
/*	$search_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbsearchentities&search=" . urlencode($name) . "&language=fr&format=json");
	$search_array = json_decode($search_array_json, true);
	$id = $search_array["search"][0]["id"];
	$description = $search_array["search"][0]["description"]; */

	/* Encode array and get informations about the localisation of that page (lat/long/height, etc) */
	/* $geoloc_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=$id&property=P625");
	$geoloc_array = json_decode($geoloc_array_json, true);

	$latitude = $geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["latitude"];
	$longitude = $geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["longitude"]; */
	
	/* Encode array and get fr wikipedia link about that page */
	/*$sitelink_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetentities&ids=$id&sitefilter=frwiki&props=sitelinks/urls&format=json");
	$sitelink_array = json_decode($sitelink_array_json, true);
	$sitelink = $sitelink_array["entities"]["$id"]["sitelinks"]["frwiki"]["url"]; */




	/* Obtain current user latitude/longitude */
	$user_latitude= $_POST[0];
	$user_longitude= $_POST[1];

	/* Returns a $poi_id_array_clean array with a list of wikidata pages ID within a $range km range from user location */
	$range = 1;
	$poi_id_array_json = file_get_contents("http://wdq.wmflabs.org/api?q=around[625,$user_latitude,$user_longitude,$range]");
	$poi_id_array = json_decode($poi_id_array_json, true);
	$poi_id_array_clean = $poi_id_array["items"];
	$nb_poi = count($poi_id_array_clean);
	
	/* stocks latitude, longitude, name and description of every POI located by ↑ in $poi_array */
	for($i = 0; $i < $nb_poi; $i++) {
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
	
		$poi_array["nb_poi"] = $nb_poi;
		$poi_array[$i]["latitude"] = $temp_latitude;
		$poi_array[$i]["longitude"] = $temp_longitude;
		$poi_array[$i]["name"] = $name;
		$poi_array[$i]["sitelink"] = $temp_sitelink;
	}
	$poi_array_json_encoded = json_encode((array)$poi_array);
?>

<div id="map" class="map"></div>
<script>
	var poi_array = new Array();
	poi_array = <?php echo($poi_array_json_encoded); ?>;
	user_latitude = <?php echo($user_latitude); ?>;
	user_longitude = <?php echo($user_longitude); ?>;

	L.mapbox.accessToken = 'pk.eyJ1IjoicG9sb2Nob24tc3RyZWV0IiwiYSI6Ikh5LVJqS0UifQ.J0NayavxaAYK1SxMnVcxKg';
	var map = L.mapbox.map('map', 'polochon-street.kpogic18')
	
	/* place the first marker with 50% opacity to distinguish it */	
	var marker = L.marker([user_latitude, user_longitude], {opacity:0.5}).addTo(map);
	marker.bindPopup(poi_array[0].name).openPopup();

	/* place wiki POI */
	for(i = 0; i < poi_array.nb_poi; ++i) {
		var popup_content = new Array();
		if(poi_array[i].sitelink != null)
			popup_content = poi_array[i].name + "<br /> <p><a target=\"_blank\" href=\"http:" + poi_array[i].sitelink + "\">Lien wikipédia</a> <br /> <a href=\"http://perdu.com\">[+]</a></p>";
		else
			popup_content = poi_array[i].name + "<br /> <a href=\"http://perdu.com\">[+]</a></p>";
		var marker = L.marker([poi_array[i].latitude, poi_array[i].longitude]).addTo(map); 
		marker.bindPopup(popup_content).openPopup();
	}
	
	map.setView([user_latitude, user_longitude], 16);
</script>


<?php
	include("./include/bas.php");
?>
