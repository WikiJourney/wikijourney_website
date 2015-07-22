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

	
	//Make the url
	$api_url = "http://wikijourneydev.alwaysdata.net/api/api2.php?displayImg=1&wikivoyage=1&long=".$user_longitude."&lat=".$user_latitude."&lg=".$language."&maxPOI=".$maxPOI."&range=".$range;

	echo "<!-- ".$api_url."-->"; //Test only ? Maybe.
	//DON'T FORGET TO REPLACE api2.php BY api.php
	/* TEST ONLY !!
	
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
	//This line is test only
	$api_answer_array = json_decode('{"infos":{"source":"WikiJourney API","link":"http:\/\/wikijourney.eu\/","api_version":"alpha 0.0.3"},"user_location":{"latitude":"48.857","longitude":"2.3521334"},"guides":{"nb_guides":27,"guides_info":[{"pageid":24700,"title":"Nogent-sur-Marne","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Nogent-sur-Marne","latitude":48.8375,"longitude":2.4833},{"pageid":26799,"title":"Paris","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris","latitude":48.856,"longitude":2.351,"thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/c\/cc\/Paris%2C_France.jpg\/144px-Paris%2C_France.jpg"},{"pageid":26807,"title":"Paris\/10th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/10th_arrondissement","latitude":48.8759,"longitude":2.3604,"thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/8\/88\/Paris_10th_canal_st_martin.jpg\/108px-Paris_10th_canal_st_martin.jpg"},{"pageid":26809,"title":"Paris\/11th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/11th_arrondissement","latitude":48.8594,"longitude":2.3794,"thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/1\/1d\/Paris_place_de_la_republic_tree.jpg\/108px-Paris_place_de_la_republic_tree.jpg"},{"pageid":26811,"title":"Paris\/12th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/12th_arrondissement","latitude":48.8408,"longitude":2.38818,"thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/a\/a3\/Paris_12th_jardin_rabin.jpg\/144px-Paris_12th_jardin_rabin.jpg"},{"pageid":26813,"title":"Paris\/13th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/13th_arrondissement","latitude":48.8282,"longitude":2.3641,"thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/d\/d2\/St_Anne_Church.jpg\/144px-St_Anne_Church.jpg"},{"pageid":26815,"title":"Paris\/14th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/14th_arrondissement","latitude":48.8292,"longitude":2.3278,"thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/f\/f3\/Paris_14e_arrondissement_-_Quartiers.svg\/144px-Paris_14e_arrondissement_-_Quartiers.svg.png"},{"pageid":26817,"title":"Paris\/15th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/15th_arrondissement","latitude":48.8406,"longitude":2.2939,"thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/0\/04\/Paris_15e_arrondissement_-_Quartiers.svg\/144px-Paris_15e_arrondissement_-_Quartiers.svg.png"},{"pageid":26819,"title":"Paris\/16th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/16th_arrondissement","latitude":48.8636,"longitude":2.27649,"thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/b\/be\/Paris_16th_arrondissement_map_with_listings_2.png\/144px-Paris_16th_arrondissement_map_with_listings_2.png"},{"pageid":26821,"title":"Paris\/17th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/17th_arrondissement","latitude":48.8869,"longitude":2.3088,"thumbnail":"https:\/\/upload.wikimedia.org\/wikivoyage\/en\/thumb\/6\/6e\/Palais_des_Congres.jpeg\/144px-Palais_des_Congres.jpeg"},{"pageid":26823,"title":"Paris\/18th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/18th_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/b\/bf\/Paris_18th_sacre_coeur.jpg\/108px-Paris_18th_sacre_coeur.jpg"},{"pageid":26825,"title":"Paris\/19th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/19th_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/6\/68\/Passage_paris_19th.jpg\/144px-Passage_paris_19th.jpg"},{"pageid":26827,"title":"Paris\/1st arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/1st_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/8\/8d\/Louvre_01.jpg\/144px-Louvre_01.jpg"},{"pageid":26829,"title":"Paris\/20th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/20th_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/8\/80\/Pere_Lachaise_avenue_ciculaire.jpg\/144px-Pere_Lachaise_avenue_ciculaire.jpg"},{"pageid":26831,"title":"Paris\/2nd arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/2nd_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/f\/f9\/Gallerie_st_denis.jpg\/96px-Gallerie_st_denis.jpg"},{"pageid":26833,"title":"Paris\/3rd arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/3rd_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/f\/f5\/Musee-des-arts-et-metiers-d.jpg\/108px-Musee-des-arts-et-metiers-d.jpg"},{"pageid":26835,"title":"Paris\/4th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/4th_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/7\/70\/Paris_4th_notre_dame_facade.jpg\/108px-Paris_4th_notre_dame_facade.jpg"},{"pageid":26837,"title":"Paris\/5th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/5th_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/1\/12\/Paris_5th_pantheon.jpg\/144px-Paris_5th_pantheon.jpg"},{"pageid":26839,"title":"Paris\/6th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/6th_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/9\/9f\/Paris_6th_tower_st_germain_de_pres.jpg\/108px-Paris_6th_tower_st_germain_de_pres.jpg"},{"pageid":26841,"title":"Paris\/7th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/7th_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/0\/04\/Eiffel_tower_panorama.jpg\/107px-Eiffel_tower_panorama.jpg"},{"pageid":26843,"title":"Paris\/8th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/8th_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/d\/d0\/Paris_8e_arrondissement_-_Quartiers.svg\/139px-Paris_8e_arrondissement_-_Quartiers.svg.png"},{"pageid":26845,"title":"Paris\/9th arrondissement","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/9th_arrondissement","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/e\/ef\/Opera_PoesieLyrique.JPG\/144px-Opera_PoesieLyrique.JPG"},{"pageid":26855,"title":"Paris\/La D\u00e9fense","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Paris\/La_D%C3%A9fense","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/d\/dd\/Les_marches_de_Grande_Arche.jpg\/144px-Les_marches_de_Grande_Arche.jpg"},{"pageid":30498,"title":"Saint Denis","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Saint_Denis","thumbnail":"https:\/\/upload.wikimedia.org\/wikipedia\/commons\/thumb\/1\/19\/Saint-Denis_-_Basilique_-_Vue_de_la_maison_d%27%C3%A9ducation_de_la_L%C3%A9gion_d%27honneur.JPG\/144px-Saint-Denis_-_Basilique_-_Vue_de_la_maison_d%27%C3%A9ducation_de_la_L%C3%A9gion_d%27honneur.JPG"},{"pageid":79938,"title":"Boulogne-Billancourt","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Boulogne-Billancourt"},{"pageid":110984,"title":"Levallois-Perret","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Levallois-Perret"},{"pageid":111365,"title":"Bobigny","sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Bobigny"}]},"poi":{"nb_poi":1,"poi_info":[{"latitude":48.853,"longitude":2.3498,"name":"Notre Dame de Paris","sitelink":"https:\/\/en.wikipedia.org\/wiki\/Notre_Dame_de_Paris","type_name":"cathedral","type_id":2977,"id":2981}]},"err_check":{"value":false}}',true);

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
		var pagicon = [["16970", 'place-of-worship', <?php echo _MAP_POI_TYPE_CATHO ?>], ["2095", 'restaurant', <?php echo _MAP_POI_TYPE_FOOD ?>], ["12518", 'monument', <?php echo _MAP_POI_TYPE_MONUM ?>], ["34627", 'religious-jewish', <?php echo _MAP_POI_TYPE_JEWISH ?>], ["10387575 916475", 'town-hall', <?php echo _MAP_POI_TYPE_MUSEUM ?>], ["207694", 'art-gallery', <?php echo _MAP_POI_TYPE_ART ?>], ["3914 3918 9826 847027", 'college', <?php echo _MAP_POI_TYPE_SCHOOL ?>], ["928830", "rail-metro", <?php echo _MAP_POI_TYPE_SUBWAY ?>, ]];
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
