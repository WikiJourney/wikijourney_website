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

//hideRoutingContainer() : Hide or show the routing container when the button is clicked
function hideRoutingContainer() {
	if(document.getElementsByClassName('leaflet-routing-container')[0].style.display == "none")
	{
		document.getElementsByClassName('leaflet-routing-container')[0].style.display = "block";
	}
	else
	{
		document.getElementsByClassName('leaflet-routing-container')[0].style.display = "none";
	}

}

//showTheCart() : On the adding of the first POI in the cart, display the cart
function showTheCart() {
	document.getElementById("POI_CART_BLOCK").style.transform = 'scaleX(1)';
}

//DisplayCart() : display or hide the Cart when cart button is clicked
function displayCart(){
	if(document.getElementById("POI_CART_BLOCK").style.transform != 'scaleX(1)'){
	document.getElementById("POI_CART_BLOCK").style.transform = 'scaleX(1)';
} else {
	document.getElementById("POI_CART_BLOCK").style.transform = 'scaleX(0.001)';
	}
}

//razCart() : Clear the cart
function razCart() {
	cartList.length = 0;
	reloadCart();
}

//submitCart() : When button is clicked, create a JSON which contain the track, put it in an hidden
//form, and submit the form.
function submitCart() {

	if(cartList.length == 0) //The cart is empty
	{
		alert('<?php echo _CART_IS_EMPTY_POPUP; ?>');
	}
	else
	{
		//Because of markers objects are stocked in cartList, we're obliged to recompose a clean table
		var i;
		var exportList = new Array();

		//This is the structure
		function composeCartList(Nid, Nlatitude, Nlongitude, Nsite, Nname, Ntype_name, Nimage_url)
		{
			this.id = Nid;
			this.latitude = Nlatitude;
			this.longitude = Nlongitude;
			this.sitelink = Nsite;
			this.name = Nname;
			this.type_name = Ntype_name;
			this.image_url = Nimage_url;
		}

		for(i = 0; i < cartList.length; i++)
		{
			//Filling the new list
			exportList[i] = new composeCartList(cartList[i].id, cartList[i].latitude, cartList[i].longitude, cartList[i].sitelink, cartList[i].name, cartList[i].type_name, cartList[i].image_url);
		}

		//Putting the json list in an invisible form
		document.getElementById('cartJsonExport').value = JSON.stringify(exportList);
		//And submit this form
		document.getElementById('hiddenForm').submit();
	}
}

//addToCart() : add a marker to the cart when it's clicked
function addToCart(i) {

	var j = 0;
	var flag;

	flag = 0;

	for(j = 0; j < cartList.length; j++)
	{
		if( poi_array[i].id == cartList[j].id )//We test if this POI is already in the list
			flag = 1;
	}

	if(flag == 0) //If not, add it
		cartList[cartList.length] = poi_array[i];

	reloadCart(cartList);

	if(document.getElementById("POI_CART_BLOCK").style.transform != 'scaleX(1)')
	{
	document.getElementById("POI_CART_BLOCK").style.transform = 'scaleX(1)';
	}
}

//center() : Center the map on the user's position when button is clicked
function center(){
	map.setView([user_latitude, user_longitude], 15);
}

//deletePOI() : Delete a POI from the cart
function deletePOI(i) {
		cartList.splice(i,1);//Splice the cart at the position wanted
		reloadCart(); //And reload
}

//invertPOI() : Push up or down a POI when an arrow is clicked
function invertPOI( i, dir) {
	var temp;

	if( ! ( (i == 0 && dir == 'up') || (i == cartList.length - 1 && dir == 'down') ) ) //If not already at the bottom or at the top
	{
		if(dir == 'down')//Permutation
		{
			temp = cartList[i + 1];
			cartList[i + 1] = cartList[i];
			cartList[i] = temp;
		}
		else if(dir == 'up')//Permutation
		{
			temp = cartList[i - 1];
			cartList[i - 1] = cartList[i];
			cartList[i] = temp;
		}
	reloadCart();
	}
}

//reloadCart() : called at every modification of the cart. It reloads the display.
function reloadCart() {

	var i = 0;
	var _MAP_POI_LINK = document.getElementById('mapPoiLink').value; //Yep, it's ugly.

	var htmlElement;

	document.getElementById("POI_CART").innerHTML = ''; //Reset the cart

	//Setting the cart with the POI in cartlist
	for(i = 0; i <= cartList.length - 1; i++)//Display
	{
		htmlElement =
		"<div class=\"eltCart\"><div class=\"eltCartNumber\">" + (i+1) +"</div>"
		+cartList[i].name.charAt(0).toUpperCase() + cartList[i].name.substring(1).toLowerCase() + "<br/>";

		if(cartList[i].type_name != null)
		{
			htmlElement += "<i>" + cartList[i].type_name.charAt(0).toUpperCase() + cartList[i].type_name.substring(1).toLowerCase() + "</i><br/>";
		}
		else
			htmlElement += "<br/>";

		if(cartList[i].sitelink != null)
		{
			htmlElement  += "<a href=" + cartList[i].sitelink + ">" + _MAP_POI_LINK + "</a><br/>";
		}

		htmlElement  += "<span class=\"POI_CART_icons\"><a class=\"icon-up-dir\" onclick=\" invertPOI("+ i +",'up'); \"></a>   <a class=\"icon-down-dir\" onclick=\" invertPOI("+ i +",'down'); \"></a>  <a class=\"icon-trash-empty\" onclick=\" deletePOI( " + i + "); \"></a></span></div>";

		document.getElementById("POI_CART").innerHTML = document.getElementById("POI_CART").innerHTML + htmlElement;
	}

	//Refreshing the routing
	var routing_poi_list = new Array();

	routing_poi_list[0] = L.latLng(user_latitude, user_longitude);
	for(j = 0; j < cartList.length; ++j)
		routing_poi_list[j+1] = L.latLng(cartList[j].latitude, cartList[j].longitude);
	routing.setWaypoints(routing_poi_list);
}

//distance(i) : get the distance between a user and the POI i
function distance(i){
	Math.radians = function(degrees) {
	  return degrees * Math.PI / 180;
	};

	var userlat = Math.radians(user_latitude);
	var userlong = Math.radians(user_longitude);
	var poilat = Math.radians(poi_array[i].latitude);
	var poilong = Math.radians(poi_array[i].longitude);
	var r = 6633 ; //Earth's radius
	//Precise distance
	var dp = 2*Math.asin(Math.sqrt(Math.pow(Math.sin((userlat-poilat)/2),2)+Math.cos(userlat)*Math.cos(poilat)*Math.pow(Math.sin((userlong-poilong)/2),2)));
	//Conversion to kilometers
	var d = dp*r ;

	return d;
}
