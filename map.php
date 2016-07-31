<?php
/*
================== WIKIJOURNEY - MAP.PHP =======================

This file loads the map, displays the user's position on it, shows
POIs around, and create routing. It uses Wikijourney's API.

Source : https://github.com/WikiJourney/wikijourney_website

Copyright 2015 WikiJourney

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

*/
	
	//==> Configuration
	$CONFIG_API_URL = "proxy.php"; //Link to the API

	//==> First, include the top, with special properties.
	session_start();
	$INCLUDE_MAP_PROPERTIES = 1;
	include("./include/haut.php");
	//This include also loads translation for all the text in this page.

	//==> In case the user arrived directly on the page, he's redirected to the index
	if(!(isset($_POST['from']) OR isset($_GET['id']) OR isset($_GET['simplified'])))
		header("Location: index.php");

	//****************************************************************
	//*********************** Simplified version *********************
	//****************************************************************
	if(isset($_GET['simplified']) && $_GET['simplified'] == 1)	
	{
		$user_longitude = htmlspecialchars($_GET['user_longitude']);
		$user_latitude = htmlspecialchars($_GET['user_latitude']);
		$maxPOI = htmlspecialchars($_GET['maxPOI']);
		$range = htmlspecialchars($_GET['range']);
		$API_language = htmlspecialchars($_GET['API_language']);

		$api_url = $CONFIG_API_URL."?displayImg=1&wikivoyage=1&long=".$user_longitude."&lat=".$user_latitude."&lg=".$API_language."&maxPOI=".$maxPOI."&range=".$range;
		echo "<!-- ".$api_url."-->"; //For debugging purpose.
		$thePathWasSaved = false;
	}

	//****************************************************************
	//************* The user is looking for POI around ***************
	//****************************************************************
	if(isset($_POST['from']) && $_POST['from'] == 'form')
	{
		//****************************************************************
		//***************** Getting user's coordinates *******************
		//****************************************************************

		//==> If the user typed an adress, we get location with OSM Nominatim
		if(isset($_POST['go']) && $_POST['go'] == 'adress') {
			$name = $_POST['adressValue'];
			$osm_array_json = file_get_contents("http://nominatim.openstreetmap.org/search?format=json&q=\"" . urlencode($name)."\"");
			$osm_array = json_decode($osm_array_json, true);

			if (!isset($osm_array[0]["lat"]))
			{
				header("Location: index.php?message=adress");
				die();
			}

			$user_latitude = $osm_array[0]["lat"];
			$user_longitude = $osm_array[0]["lon"];
		}

		//==> We look for POI around his geolocation
		else if($_POST['latitude'] != NULL && $_POST['longitude'] != NULL) {
			$user_latitude= $_POST['latitude'];
			$user_longitude= $_POST['longitude'];
		}
		//==> If none of those worked, that means that a problem occurred with geolocation
		else
			header("Location : index.php?message=geoloc");	//Redirect to homepage with a failure message



		//==> Get range and maxPOI from POST data
		if(is_numeric($_POST['range']))
			$range = $_POST['range'];
		else
			$range = 1;

		$maxPOI = intval($_POST['maxPOI']);
		$API_language = htmlspecialchars($_POST['selectedLanguage']);

		//****************************************************************
		//*********************** Contact the API ************************
		//****************************************************************

		//==> Make the url
		$api_url = $CONFIG_API_URL."?wikivoyage=1&thumbnailWidth=300&long=".$user_longitude."&lat=".$user_latitude."&lg=".$API_language."&maxPOI=".$maxPOI."&range=".$range;

		echo "<!-- ".$api_url."-->"; //For debugging purpose.

		$thePathWasSaved = false;
	}
	//****************************************************************
	//************* The user wants to load a path ********************
	//****************************************************************
	if(isset($_GET['id']))
	{
		//==> Looking in the database and fetch the path
		include("./include/connectdb.php");
		$id = mysqli_real_escape_string($handler_db,$_GET['id']);
		$username = mysqli_real_escape_string($handler_db,$_SESSION['wj_username']);
		$query = mysqli_query($handler_db,"SELECT path FROM savedpaths WHERE username='$username' AND id='$id'");
		$poi_array_json_encoded = mysqli_fetch_array($query)['path'];

		//==> Setting user's position on first point
		$array = json_decode($poi_array_json_encoded,1);
		$user_latitude = $array[0]['latitude'];
		$user_longitude = $array[0]['longitude'];

		//==> Format the json array for the JS script
		$nbPOI = $maxPOI = count($array);
		$outputArray['nb_poi'] = $maxPOI;
		$outputArray['poi_info'] = $array;
		$poi_array_json_encoded = json_encode($outputArray);
		$thePathWasSaved = true;
	}
	//****************************************************************
	//*************** Load File with Pagicon name ********************
	//****************************************************************

	if(file_exists(_MAP_POI_TYPE_FILE)) //It depends of the language selected.
	{
		$content = file_get_contents(_MAP_POI_TYPE_FILE); //Read only.

		$table1 = explode("\n",$content);
		for($i = 0;$i < count($table1);$i++)
		{
			if($table1[$i] != "")
			{
				$typesArray[$i] = explode(":",$table1[$i]);
			}
		}
		$pagicon_json_array = json_encode($typesArray);

	}
	else
		$pagicon_json_array = "[]";

?>

<script>
//==> We put here the variables for the translation
var _CART_IS_EMPTY_POPUP = 		"<?php echo _CART_IS_EMPTY_POPUP; ?>";
var _YOU_ARE_HERE = 			"<?php echo _YOU_ARE_HERE; ?>";
var _MAP_CART_LINK = 			"<?php echo _MAP_CART_LINK; ?>";
var _MAP_POI_LINK = 			"<?php echo _MAP_POI_LINK; ?>";
var _YOUR_PATH = 				"<?php echo _YOUR_PATH; ?>";
var _CENTER_BUTTON = 			"<?php echo _CENTER_BUTTON; ?>";
var _SEE_WIKIVOYAGE_GUIDES =	"<?php echo _SEE_WIKIVOYAGE_GUIDES; ?>";


var thePathWasSaved = 			<?php echo ($thePathWasSaved) ? "true" : "false"; ?>;

//==> Giving variables from script
var range = 					<?php echo (isset($range)) ? $range : 0; ?>;
var user_location = 			new Array();
var poi_array = 				new Array();
var poi_array_decode = 			new Array();
var pagicon = 					<?php echo $pagicon_json_array; ?>; //For the icon/ID/label association
var api_link = 					'<?php echo (isset($api_url))? $api_url : ''; ?>';

poi_array_decode = 				<?php if($thePathWasSaved) echo $poi_array_json_encoded; else echo '[]'; ?>;

user_location['latitude'] = 	<?php echo $user_latitude; ?>;
user_location['longitude'] = 	<?php echo $user_longitude; ?>;

</script>


<div id="mapAndCartContainer">
	<?php
	if(!(isset($_GET['simplified']) && $_GET['simplified'] == 1))
	{
	?>
	<div id="POI_CART_BLOCK" class="drawer drawer-left">
		<button id="cartHideButton" class="btn btn-default drawer-button"><span class="glyphicon glyphicon-chevron-left"></span></button>
		<div id="POI_CART_TITLE" class="drawer-title"><?php echo _YOUR_PATH; ?></div>
		<div id="POI_CART"><!-- THIS IS GOING TO BE FILLED BY CART ELEMENTS IN JAVASCRIPT --></div>
		<div id="POI_CART_FOOTER">
			<input type="submit" id="razCart" value="<?php echo _CLEAR_CART; ?>" onclick="razCart();" class="btn btn-primary" />
			<input type="submit" title="This function is unavailable for the moment. Stay tuned for the next version ! ;)" id="exportCart" value="<?php echo _SAVE_CART; ?>" onclick="submitCart();" class="btn btn-primary" />
			<!-- Let's put the hidden form here.. Random. -->
			<form action="map_export.php" method="post" id="hiddenForm">
				<input type="hidden" id="cartJsonExport" name="cartJsonExport" value="" />
			</form>
		</div>
	</div>
	<?php
	}
	?>

	<div id="mapContainer">

		<div id="WikiVoyageBox" class="drawer drawer-bottom" style="display: none;">
			<div onclick="wikiVoyageToggleDrawer();" class="WikiVoyageTitle"><span id="wikiVoyageToggleButton" class="glyphicon glyphicon-chevron-down"></span><?php echo _SEE_WIKIVOYAGE_GUIDES; ?></div>
			<div id="WikiVoyageThumbnailContainer">
				<div id="WikiVoyageThumbnailContainerScroll">
				<!-- PLACE WHERE WIKIVOYAGE GUIDES ARE DEPLOYED -->
				</div>
			</div>
		</div>

		<div id="map" class="map">
			<div class="modal"><!-- Loading --></div>
			<!-- THIS IS GOING TO BE FILLED BY THE MAP THANKS TO LEAFLET -->
			<a id="simplifiedLink" href="<?php echo "map.php?simplified=1&API_language=".$API_language."&user_latitude=".$user_latitude."&user_longitude=".$user_longitude."&maxPOI=".$maxPOI."&range=".$range; ?>"><?php echo _LOAD_SIMPLIFIED; ?></a>
		</div>
	</div>

	
</div>		



<?php
	include("./include/bas.php");
?>
