<?php
/* 
============================ WIKIJOURNEY API =========================
Version Beta 1.1
======================================================================

See documentation on http://wikijourney.eu/api/documentation.php
*/		
	
	error_reporting(0); //No need error reporting, or else it will crash the JSON export
	header('Content-Type: text/html; charset=utf-8'); //Set the header to UTF8
	$handler_db = mysqli_connect('localhost','wikijourney_web','','wikijourney_cache'); //Connect to db

	require("multiCurl.php");

	function secureInput($string)
	{
		$string = addcslashes($string, '%_"');
		//Add more securities here
		
		return $string;
	}
	
	//Required informations
	if(isset($_GET['place'])) //If it's a place
	{
		$name = secureInput($_GET['place']);
		$osm_array_json = file_get_contents("http://nominatim.openstreetmap.org/search?format=json&q=\"" . urlencode($name)."\""); //Contacting Nominatim API to have coordinates
		$osm_array = json_decode($osm_array_json, true);
		
		if (!isset($osm_array[0]["lat"]))
			$error = "Location doesn't exist";
		else
		{
			$user_latitude = $osm_array[0]["lat"];
			$user_longitude = $osm_array[0]["lon"];
		}
	}
	else //Else it's long/lat
	{
		if(isset($_GET['lat']))	$user_latitude = secureInput($_GET['lat']);
			else $error = "Latitude missing";
	
		if(isset($_GET['long']))$user_longitude = secureInput($_GET['long']);
			else $error = "Longitude missing";
	}
	
	//Not required
	if(isset($_GET['range'])) 	$range = secureInput($_GET['range']);
		else $range = 1;
	if(isset($_GET['maxPOI'])) 	$maxPOI = secureInput($_GET['maxPOI']);
		else $maxPOI = 10;
	if(isset($_GET['lg'])) 		$language = secureInput($_GET['lg']);
		else $language = 'en';
	if(isset($_GET['displayImg'])) $displayImg = secureInput($_GET['displayImg']);
		else $displayImg = 0;
	if(isset($_GET['wikivoyage'])) $wikivoyageSupport = secureInput($_GET['wikivoyage']);
		else $wikivoyageSupport = 0;
	if(isset($_GET['thumbnailWidth'])) $thumbnailWidth = secureInput($_GET['thumbnailWidth']);
		else $thumbnailWidth = 500;
	
	if(!(is_numeric($range) && is_numeric($user_latitude) && is_numeric($user_longitude) && is_numeric($maxPOI) && is_numeric($thumbnailWidth)))
		$error = "Error : latitude, longitude, maxPOI, thumbnailWidth and range should be numeric values.";
		
	//============> INFO SECTION
	$output['infos']['source'] 		= "WikiJourney API";
	$output['infos']['link']		= "http://wikijourney.eu/";
	$output['infos']['api_version']		= "Beta 1.1";
	
	//============> FAKE ERROR
	if(isset($_GET['fakeError']) && $_GET['fakeError'] == "true")
		$error = "Error ! If you want to see all the error messages that can be sent by our API, please refer to the source code on our GitHub repository.";
	
	//============> INFO POINT OF INTEREST & WIKIVOYAGE GUIDES
	if(!isset($error))
	{
		// ==================================> Put in the output the user location (can be useful)
		$output['user_location']['latitude'] = floatval($user_latitude);
		$output['user_location']['longitude'] = floatval($user_longitude);
		
		// ==================================> Wikivoyage requests : find travel guides around
		if($wikivoyageSupport == 1)
		{
			if($displayImg == 1) //We add description and image
			{
				$wikivoyageRequest = "https://en.wikivoyage.org/w/api.php?action=query&format=json&" //Base
									."prop=coordinates|info|pageterms|pageimages|langlinks&"	//Props list
									."piprop=thumbnail&pithumbsize=144&pilimit=50&inprop=url&wbptterms=description" //Properties dedicated to image, url and description
									."&llprop=url"//Properties dedicated to langlinks
									."&generator=geosearch&ggscoord=$user_latitude|$user_longitude&ggsradius=10000&ggslimit=50"; //Properties dedicated to geosearch
			}
			else //Simplified request
			{
				$wikivoyageRequest = "https://en.wikivoyage.org/w/api.php?action=query&format=json&" //Base
									."prop=coordinates|info|langlinks&"	//Props list
									."inprop=url" //Properties dedicated to url
									."&llprop=url"//Properties dedicated to langlinks
									."&generator=geosearch&ggscoord=$user_latitude|$user_longitude&ggsradius=10000&ggslimit=50"; //Properties dedicated to geosearch
			}
			
			$wikivoyage_json = file_get_contents($wikivoyageRequest); //Request is sent to WikiVoyage API
			
			if($wikivoyage_json == FALSE)
			{
				$error = "API Wikivoyage is not responding.";
			}
			else
			{
				$wikivoyage_array = json_decode($wikivoyage_json, true);
				
				if(isset ($wikivoyage_array['query']['pages'])) //If there's guides around
				{	
					$realCount = 0;
					
					$wikivoyage_clean_array = array_values($wikivoyage_array['query']['pages']);//Reindexing the array (because it's initially indexed by pageid)
					
					for($i = 0; $i < count($wikivoyage_clean_array); $i++)
					{
						$j = 0;
						
						while($wikivoyage_clean_array[$i]['langlinks'][$j]['lang'] != $language && $j < count($wikivoyage_clean_array[$i]['langlinks'])-1)
							$j++; //We walk in the array trying to find the user's language

						if($wikivoyage_clean_array[$i]['langlinks'][$j]['lang'] == $language || $language == 'en') //If we found it or if it's english
						{
							$realCount ++;
							
							$wikivoyage_output_array[$i]['pageid'] = $wikivoyage_clean_array[$i]['pageid'];
							
							if($language == 'en') //Special for english
							{
								$wikivoyage_output_array[$i]['title'] = $wikivoyage_clean_array[$i]['title'];
								$wikivoyage_output_array[$i]['sitelink'] = $wikivoyage_clean_array[$i]['fullurl'];
							}
							else
							{
								$wikivoyage_output_array[$i]['title'] = $wikivoyage_clean_array[$i]['langlinks'][$j]['*'];
								$wikivoyage_output_array[$i]['sitelink'] = $wikivoyage_clean_array[$i]['langlinks'][$j]['url'];
							}
							
							if(isset($wikivoyage_clean_array[$i]['coordinates'][0]['lat'])) 	//If there are coordinates
							{
								$wikivoyage_output_array[$i]['latitude'] = $wikivoyage_clean_array[$i]['coordinates'][0]['lat']; 	//Warning : could be null
								$wikivoyage_output_array[$i]['longitude'] = $wikivoyage_clean_array[$i]['coordinates'][0]['lon'];	//Warning : could be null
							}
							
							if(isset($wikivoyage_clean_array[$i]['thumbnail']['source'])) 	//If we can find an image
								$wikivoyage_output_array[$i]['thumbnail'] = $wikivoyage_clean_array[$i]['thumbnail']['source'];
						}
						//No else, because if we didn't found the language it means that there's no guide for the user's language
					}
					$output['guides']['nb_guides'] = $realCount;
					if($realCount != 0) $output['guides']['guides_info'] = array_values($wikivoyage_output_array);
				}
				else //Case we're in the middle of Siberia
					$output['guides']['nb_guides'] = 0;
					
				
			}
		}

		// ==================================> End Wikivoyage requests
		
		// ==================================> Wikidata requests : find wikipedia pages around		

		$poi_id_array_json = file_get_contents("http://wdq.wmflabs.org/api?q=around[625,$user_latitude,$user_longitude,$range]"); // Returns a $poi_id_array_clean array with a list of wikidata pages ID within a $range km range from user location 
		if($poi_id_array_json == FALSE)
		{
			$error = "API WMFlabs isn't responding.";
		}
		else
		{
			
			$poi_id_array = json_decode($poi_id_array_json, true);
			$poi_id_array_clean = $poi_id_array["items"];
			$nb_poi = count($poi_id_array_clean);
			
			for($i = 0; $i < min($nb_poi, $maxPOI); $i++) 
			{
				$id = $poi_id_array_clean[$i];
				
				//=============> We check if the db is online. If not, then bypass the cache.
				if($handler_db)
				{
					
					//==> We look in the cache to know if the POI is there
					$answer = mysqli_query($handler_db,"SELECT * FROM cache_".$language." WHERE id=$id");
					$dataPOI = mysqli_fetch_assoc($answer);
					
					//==> If we have it we can display it
					if(count($dataPOI) != 0)
					{
						$poi_array[$i] = $dataPOI;
					}
					
					mysqli_free_result($answer);
				}
				
				
				//=============> If the POI is not in the cache, or if the database is unreachable, then contact APIs.
				if($poi_array[$i] == NULL)
				{
					
					
					//=============> First call, we're gonna fetch geoloc infos, type ID, description and sitelink
					
					$URL_list = array(
						//Geoloc infos
						"https://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q" . $poi_id_array_clean["$i"] . "&property=P625",
						//Type ID
						"https://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q" . $poi_id_array_clean["$i"] . "&property=P31",
						//Description
						"https://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q" . $poi_id_array_clean["$i"] . "&props=labels&languages=$language",
						//Sitelink
						"https://www.wikidata.org/w/api.php?action=wbgetentities&ids=Q" . $poi_id_array_clean["$i"] . "&sitefilter=$language&props=sitelinks/urls&format=json");
					
					$curl_return = reqMultiCurls($URL_list); //Using multithreading to fetch urls
					
					//==> Get geoloc infos
						$temp_geoloc_array_json = $curl_return[0];
						if($temp_geoloc_array_json == FALSE)
						{
							$error = "API Wikidata isn't responding on request 1.";
							break;
						}
						$temp_geoloc_array = json_decode($temp_geoloc_array_json, true);
						$temp_latitude = $temp_geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["latitude"];
						$temp_longitude = $temp_geoloc_array["claims"]["P625"][0]["mainsnak"]["datavalue"]["value"]["longitude"];
						
					//==> Get type id
						$temp_poi_type_array_json = $curl_return[1];
						if($temp_poi_type_array_json == FALSE)
						{
							$error = "API Wikidata isn't responding on request 2.";
							break;
						}
						$temp_poi_type_array = json_decode($temp_poi_type_array_json, true);
						$temp_poi_type_id = $temp_poi_type_array["claims"]["P31"][0]["mainsnak"]["datavalue"]["value"]["numeric-id"];
						
					//==> Get description
						$temp_description_array_json = $curl_return[2];
						if($temp_description_array_json == FALSE)
						{
							$error = "API Wikidata isn't responding on request 3.";
							break;
						}
						$temp_description_array = json_decode($temp_description_array_json, true);
						$name = $temp_description_array["entities"]["Q" . $poi_id_array_clean["$i"]]["labels"]["$language"]["value"];
						
					//==> Get sitelink
						$temp_sitelink_array_json = $curl_return[3];
						if($temp_sitelink_array_json == FALSE)
						{
							$error = "API Wikidata isn't responding on request 4.";
							break;
						}
						$temp_sitelink_array = json_decode($temp_sitelink_array_json, true);
						$temp_sitelink = $temp_sitelink_array["entities"]["Q" . $poi_id_array_clean["$i"]]["sitelinks"][$language . "wiki"]["url"];
						
					
					//=============> Now we make a second call to fetch images and types' titles
					
					//==> With the sitelink, we make the image's url
						$temp_url_explode = explode("/", $temp_sitelink);
						$temp_url_end = $temp_url_explode[count($temp_url_explode)-1];
						
					//==> Calling APIs
						$URL_list = array(
							//Type
							"https://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q" . $temp_poi_type_id . "&props=labels&languages=$language",
							//Images
							"https://".$language.".wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&pithumbsize=".$thumbnailWidth."&pilimit=1&titles=".$temp_url_end);
						
						$curl_return = reqMultiCurls($URL_list);
						
							
					//==> Get type
						$temp_description_type_array_json = $curl_return[0];
						if($temp_description_type_array_json == FALSE)
						{
							$error = "API Wikidata isn't responding on request 5.";
							break;
						}
						$temp_description_type_array = json_decode($temp_description_type_array_json, true);
						$type_name = $temp_description_type_array["entities"]["Q" . $temp_poi_type_id]["labels"]["$language"]["value"];
						
					//==> Get image
						$temp_image_json = $curl_return[1];
						if($temp_image_json == FALSE)
						{
							$error = "API Wikidata isn't responding on request 6.";
							break;
						}
						//We put an @ because it can be null (case there is no image for this article)
						$image_url = @array_values(json_decode($temp_image_json, true)["query"]["pages"])[0]["thumbnail"]["source"];
					
					
					//=============> And now we can make the output
					if($name != null)
					{
						$poi_array[$i]["latitude"] = 		$temp_latitude;
						$poi_array[$i]["longitude"] = 		$temp_longitude;
						$poi_array[$i]["name"] = 			$name;
						$poi_array[$i]["sitelink"] = 		$temp_sitelink;
						$poi_array[$i]["type_name"] = 		$type_name;
						$poi_array[$i]["type_id"] = 		$temp_poi_type_id;
						$poi_array[$i]["id"] = 				$poi_id_array_clean[$i];
						$poi_array[$i]["image_url"] = 		$image_url;
						
						if($handler_db)
						{
							//Insert this POI in the cache
						
							$sql_query = "INSERT INTO cache_".$language." VALUES ($id,$temp_latitude,$temp_longitude,'".mysqli_real_escape_string ($handler_db,$name)."','".mysqli_real_escape_string($handler_db,$temp_sitelink)."','".mysqli_real_escape_string($handler_db,$type_name)."','".mysqli_real_escape_string($handler_db,$temp_poi_type_id)."','".mysqli_real_escape_string($handler_db,$image_url)."',NOW())";
							@mysqli_query($handler_db,$sql_query); //No error display, or else it crashes the JSON. 
							
						}
					}
				}

			}
		}
		$output['poi']['nb_poi'] = count($poi_array);
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
	
	mysqli_close($handler_db); //Close the database.
	
	//Next line is a legacy, please don't touch.
	/* yolo la police */
?>
