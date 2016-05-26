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

// ===> DOM manipulation, for responsive design

// Shrink the logo on loading
$(".logoNavbar").removeClass("notshrink").addClass("shrink");

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



// ===> Variables declaration

var cartList = new Array();
var j;
var ismerged = false;
var overlayMaps = new Array();
var map;
var routing_poi_list = new Array();

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

//Add a button to show the drawer
var buttonDrawerMap = L.easyButton( 'glyphicon-map-marker', function(){
	$("#POI_CART_BLOCK").css('left',0);
}, _YOUR_PATH).addTo(map);

//And another one to center the map 
L.easyButton( 'glyphicon-screenshot', function(){
	center();
}, _CENTER_BUTTON).addTo(map);

applyMediaQueries();
// ===> Setting overlays

for(j = 0; j < pagicon.length; ++j) {
	overlayMaps[pagicon[j][2]] = L.layerGroup([]);
}

L.control.layers(null, overlayMaps).addTo(map);

// ===> Place markers on the map!

for(i = 0; i < poi_array_decode.nb_poi; ++i)
{
	var popup_content = new Array();
	var j = 0;

	for(j = 0; ((j < pagicon.length) && ((pagicon[j][0]).search(String(poi_array[i].type_id)))); j++)
		;

	if (distance(i) < 0.07 && !ismerged){

		popup_content = _YOU_ARE_HERE;
		ismerged = true ;
		poi_array[i]['marker'] = L.marker([user_location.latitude, user_location.longitude],{icon: defaultPOIIcon}).addTo(map);
	}
	else if(j < pagicon.length){

		poi_array[i]["marker"] = L.marker([poi_array[i].latitude, poi_array[i].longitude],{icon: defaultPOIIcon}).addTo(map);

		overlayMaps[pagicon[j][2]].addLayer(poi_array[i]['marker']);
	}
	else{
		poi_array[i]["marker"] = L.marker([poi_array[i].latitude, poi_array[i].longitude],{icon: defaultPOIIcon}).addTo(map);
	}

	popup_content = parsePopupContent(poi_array[i]);


	poi_array[i]['marker'].bindPopup(popup_content);


	if(thePathWasSaved == true)
		addToCart(i,cartList);//If the path was saved, we put all POI directly in the cart
}


for(j = 0; j < pagicon.length; ++j)
	map.addLayer(overlayMaps[pagicon[j][2]]);
