/*
================== WIKIJOURNEY - MAP-SCRIPTS.JS =======================
Contains scripts used in map.php, in order to add POIs in the cart
and make operations on them.

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

// ===> Variables declaration

var cartList = new Array();
var j;
var ismerged = false;
var overlayMaps = new Array();
var map;
var routing_poi_list = new Array();
var xhttp = new XMLHttpRequest();

// ===> DOM manipulation, for responsive design

//Add a button to close the drawer
$("#cartHideButton").click(function(){
	$("#POI_CART_BLOCK").css('left','-100%');
});			

//Media queries (check map-script-functions.js for details)
var mq = window.matchMedia( "(max-width: 765px)" );

$( window ).resize(function() {
	applyMediaQueries();
	$("#POI_CART_BLOCK").css('left','0');
});

$body = $("body");

// ===> Creating marker objects

var markerUserIcon = L.AwesomeMarkers.icon({
	icon: 'user',
	markerColor: 'red',
	prefix: 'glyphicon'
}); //Marker for user's position

var defaultPOIIcon = L.icon({
	iconUrl: 'lib/leaflet/images/marker-icon.png',
	shadowUrl: 'lib/leaflet/images/marker-shadow.png',
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
}); //Default Marker

// ===> Map initialisation

initMap(user_location);

//Add a button to center the map 
L.easyButton( 'glyphicon-screenshot', function(){
	center();
}, _CENTER_BUTTON).addTo(map);

//And a button to show the drawer
var buttonDrawerMap = L.easyButton({
  id: 'buttonDrawerMap',
  states: [{
    stateName: 'default-open',
    icon: 'glyphicon-chevron-right',
    title: _YOUR_PATH,
    onClick: function(control) {
      $("#POI_CART_BLOCK").css('left',0);
    }
  }]
}).addTo(map);

applyMediaQueries();


// ===> Setting overlays

for(j = 0; j < pagicon.length; ++j) {
	overlayMaps[pagicon[j][2]] = L.layerGroup([]);
}

L.control.layers(null, overlayMaps).addTo(map);

for(j = 0; j < pagicon.length; ++j)
	map.addLayer(overlayMaps[pagicon[j][2]]);


// ===> Place markers on the map!
if(!thePathWasSaved)
{
	xhttp.onreadystatechange = function() {
		if(xhttp.readyState == 1)
		{
			console.log("Request in progress");
			$body.addClass("loading");
		}
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$body.removeClass("loading");
			// ===> Parse result
			var api_return = JSON.parse(xhttp.response);
			console.log(api_return);
			// ===> Check errors
			if(api_return.err_check.value == true)
			{
				alert(api_return.err_check.msg);
			}
			else
			{
				poi_array_decode = api_return.poi;
				poi_array = poi_array_decode.poi_info;
			}

			// ===> Place on map !
			placePOI();
		}
	};
	xhttp.open("GET", api_link, true);
	xhttp.send();
}
else
{
	poi_array = poi_array_decode.poi_info;
	placePOI();
}


