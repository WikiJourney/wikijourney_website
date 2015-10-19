<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

function reqMultiCurls($urls) {
 
	// for storing cUrl handlers
	$chs = array();
	// for storing the reponses strings
	$contents = array();
 
	// loop through an array of URLs to initiate
	// one cUrl handler for each URL (request)
	foreach ($urls as $url) {
		$ch = curl_init($url);
		// tell cUrl option to return the response
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		$chs[] = $ch;
	}
 
	// initiate a multi handler
	$mh = curl_multi_init();
 
	// add all the single handler to a multi handler
	foreach($chs as $key => $ch){
		curl_multi_add_handle($mh,$ch);
	}
 
	// execute the multi cUrl handler
	do {
		  $mrc = curl_multi_exec($mh, $active);
	} while ($mrc == CURLM_CALL_MULTI_PERFORM  || $active);
 
	// retrieve the reponse from each single handler
	foreach($chs as $key => $ch){
		if(curl_errno($ch) == CURLE_OK){
				$contents[] = curl_multi_getcontent($ch);
		}
		else{
			echo "Err>>> ".curl_error($ch)."\n";
		}
	}
 
	curl_multi_close($mh);
	return $contents;
}

$urls = array(
	'https://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q1513&property=P625',
	'https://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q1513&property=P31',
	'http://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q1513&props=labels&languages=fr');
	
 print_r(reqMultiCurls($urls));
?>