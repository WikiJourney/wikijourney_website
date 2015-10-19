<?php

//error_reporting(E_ERROR | E_WARNING | E_PARSE);
require("multiCurl.php");

$urls = array(
	'https://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q1513&property=P625',
	'https://www.wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q1513&property=P31',
	'http://www.wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q1513&props=labels&languages=fr');
	
reqMultiCurls($urls);
?>