<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
		<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.js'></script>
		<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.css' rel='stylesheet' />
		<title>Wiki Journey - Revisitez le tourisme.</title>
		
		<!-- <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" /> -->
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
</style>
 
 </head>
 <body>
        <p>
        Error: page not found
        <?php
 
#function strpos_offset($needle, $haystack, $occurrence) {
  // explode the haystack
#  $arr = explode($needle, $haystack);
  // check the needle is not out of bounds
#  switch( $occurrence ) {
#    case $occurrence == 0:
  #    return false;
 #   case $occurrence > max(array_keys($arr)):
   #   return false;
   # default:
   #   return strlen(implode($needle, array_slice($arr, 0, $occurrence)));
  #}
#}     
        // Même chose que error_reporting(E_ALL);
        ini_set('error_reporting', E_ALL);
        $name = $_POST['name'];
        $dom2 = new DomDocument();
        $dom1 = new DomDocument();
        $dom3 = new DomDocument();
        $dom4 = new DomDocument();
 
        $dom1->load("http://www.wikidata.org/w/api.php?action=wbsearchentities&search=$name&language=fr&format=xml");
 
        $listvalues = $dom1->getElementsByTagName('entity');
        if ($listvalues->length!=0) {
 
        $value = $listvalues->item(0);
        $id = $value->getAttribute("id");
        $description = $value->getAttribute("description");
 
 
        $dom2->load("http://www.wikidata.org/w/api.php?action=wbgetclaims&format=xml&entity=$id&property=P625");
        $listvalues = $dom2->getElementsByTagName('value');
        if ($listvalues->length!=0) {
        $value = $listvalues->item(0);
        $latitude = $value->getAttribute("latitude");
        $longitude = $value->getAttribute("longitude");
 
        $dom3->load("http://www.wikidata.org/w/api.php?action=wbgetentities&ids=$id&sitefilter=frwiki&props=sitelinks/urls&format=xml");
        $listvalues = $dom3->getElementsByTagName('sitelink');
        $value = $listvalues->item(0);
        $url = $value->getAttribute("url");
 
        //echo ($listvalues[0])->getAttribute("latitude");
        //$latitude = $coordinxml->getAttribute("latitude");
        }
        }
        ?>
 
        <!--<?php echo "Latitude: $latitude"; ?> <br />
        <?php echo "Longitude: $longitude"; ?> <br />
        <?php echo "Description: $id"; ?> <br />
        <a href=<?php echo "http://www.openstreetmap.org/#map=17/$latitude/$longitude"; ?>>OSM</a>
        -->
        </p>
        <div id='map'></div>
 
	<script>
		   
		L.mapbox.accessToken = 'pk.eyJ1IjoicG9sb2Nob24tc3RyZWV0IiwiYSI6Ikh5LVJqS0UifQ.J0NayavxaAYK1SxMnVcxKg';
		var map = L.mapbox.map('map', 'polochon-street.kpogic18')
		.setView([<?php echo "$latitude";?>, <?php echo "$longitude";?>], 18);
		var marker = L.marker([<?php echo "$latitude";?>, <?php echo "$longitude";?>]).addTo(map);
		marker.bindPopup("<?php echo "$description";?> <br /> <p><a target=\"_blank\" href=\"http:<?php echo "$url";?>\">Lien wikipedia</a> <br /> <a href=\"http://perdu.com\">[+]</a></p>").openPopup();
	</script>
 
</body>
</html>