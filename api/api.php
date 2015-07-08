<?php
/* 
============================ WIKIJOURNEY API =========================
Version Alpha 0.0.2
======================================================================

See documentation on http://wikijourney.eu/api/documentation.php
*/		
	
	error_reporting(0); //No need error reporting, or else it will crash the JSON export
	
	function test()
	{
		$error = "test";
	}
	 
	function secureInput($string)
	{
		if(ctype_digit($string)) //If number
		{
			$string = intval($string);
		}
		else //If string
		{
			//To secure
			$string = addcslashes($string, '%_');
		}
		return $string;
	}
	
	//Required informations
	if(isset($_GET['lat']))	$user_latitude = secureInput($_GET['lat']);
		else $error = "Latitude missing";
	
	if(isset($_GET['long']))$user_longitude = secureInput($_GET['long']);
		else $error = "Longitude missing";
	
	//Not required
	if(isset($_GET['range'])) $range = secureInput($_GET['range']);
		else $range = 1;
	if(isset($_GET['maxPOI'])) $maxPOI = secureInput($_GET['maxPOI']);
		else $maxPOI = 10;
	if(isset($_GET['lg'])) $language = secureInput($_GET['lg']);
		else $language = 'en';
	
	
	//============> INFO SECTION
	$output['infos']['source'] 		= "WikiJourney API";
	$output['infos']['link']		= "http://wikijourney.eu/";
	$output['infos']['api_version']		= "alpha 0.0.2";
	

	
	//============> INFO POINT OF INTEREST
	if(!isset($error))
	{
		$output['user_location']['latitude'] = $user_latitude;
		$output['user_location']['longitude'] = $user_longitude;
		
		/* P31 */
		/* Returns a $poi_id_array_clean array with a list of wikidata pages ID within a $range km range from user location */
		
		$poi_id_array_json = file_get_contents("http://wdq.wmflabs.org/api?q=around[625,$user_latitude,$user_longitude,$range]");
		
		if($poi_id_array_json == FALSE)
		{
			$error = "API WMFlabs isn't responding.";
		}
		else
		{
			$poi_id_array = json_decode($poi_id_array_json, true);
			$poi_id_array_clean = $poi_id_array["items"];
			$nb_poi = count($poi_id_array_clean);
			
			
			/* stocks latitude, longitude, name and description of every POI located by ↑ in $poi_array */
			for($i = 0; $i < min($nb_poi, $maxPOI); $i++) {
				
				$temp_geoloc_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q" . $poi_id_array_clean["$i"] . "&property=P625");
				if($temp_geoloc_array_json == FALSE)
				{
					$error = "API Wikidata isn't responding on request 1.";
					break;
				}
				
				$temp_geoloc_array = json_decode($temp_geoloc_array_json, true);
				$temp_poi_type_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q" . $poi_id_array_clean["$i"] . "&property=P31");
				if($temp_poi_type_array_json == FALSE)
				{
					$error = "API Wikidata isn't responding on request 2.";
					break;
				}
				
				$temp_poi_type_array = json_decode($temp_poi_type_array_json, true);
				$temp_poi_type_id = $temp_poi_type_array["claims"]["P31"][0]["mainsnak"]["datavalue"]["value"]["numeric-id"];
				$temp_description_type_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q" . $temp_poi_type_id . "&props=labels&languages=$language");
				if($temp_description_type_array_json == FALSE)
				{
					$error = "API Wikidata isn't responding on request 3.";
					break;
				}
				
				$temp_description_type_array = json_decode($temp_description_type_array_json, true);
				$type_name = $temp_description_type_array["entities"]["Q" . $temp_poi_type_id]["labels"]["$language"]["value"];
				$temp_latitude = $temp_geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["latitude"];
				$temp_longitude = $temp_geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["longitude"];
				$temp_description_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q" . $poi_id_array_clean["$i"] . "&props=labels&languages=$language");
				if($temp_description_array_json == FALSE)
				{
					$error = "API Wikidata isn't responding on request 4.";
					break;
				}
				
				$temp_description_array = json_decode($temp_description_array_json, true);
				$name = $temp_description_array["entities"]["Q" . $poi_id_array_clean["$i"]]["labels"]["$language"]["value"];
				$temp_sitelink_array_json = file_get_contents("http://www.wikidata.org/w/api.php?action=wbgetentities&ids=Q" . $poi_id_array_clean["$i"] . "&sitefilter=$language&props=sitelinks/urls&format=json");
				if($temp_sitelink_array_json == FALSE)
				{
					$error = "API Wikidata isn't responding on request 5.";
					break;
				}
				
				$temp_sitelink_array = json_decode($temp_sitelink_array_json, true);
				$temp_sitelink = $temp_sitelink_array["entities"]["Q" . $poi_id_array_clean["$i"]]["sitelinks"][$language . "wiki"]["url"];
			
				$poi_array[$i]["latitude"] = 		$temp_latitude;
				$poi_array[$i]["longitude"] = 		$temp_longitude;
				
				$poi_array[$i]["name"] = 		$name;
				$poi_array[$i]["sitelink"] = 		$temp_sitelink;
				$poi_array[$i]["type_name"] = 		$type_name;
				$poi_array[$i]["type_id"] = 		$temp_poi_type_id;
				$poi_array[$i]["id"] = 			$poi_id_array_clean[$i];
			}
		}
		$output['poi']['nb_poi'] = $i;
		$output['poi']['poi_info'] = $poi_array; //Output 
		
	}
	
	
	if(isset($error))
	{
		$output['err_check']['value'] = true;
		$output['err_check']['err_msg'] = $error;	
	}
	else
		$output['err_check']['value'] = false;
	
	echo json_encode($output); //Encode in JSON. (user will get it by file_get_contents, curl, wget, or whatever)
	
		
	
	//Next line is a legacy, please don't touch.
	/* yolo la police */
?>