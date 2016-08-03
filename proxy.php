<?php

// This file could be needed in development in order to avoid CORS issues

$api_url = "https://api.wikijourney.eu/?";

foreach ($_REQUEST as $key => $value) {
	$api_url .= $key."=".$value."&";
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);

$api_answer_json = curl_exec($ch);
curl_close($ch);

echo $api_answer_json;

