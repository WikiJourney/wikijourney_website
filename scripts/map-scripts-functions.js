/*
================== WIKIJOURNEY - MAP-SCRIPTS-FUNCTIONS.JS =======================
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
		alert(_CART_IS_EMPTY_POPUP);
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
	var flag = 0;

	for(j = 0; j < cartList.length; j++)
	{
		if( poi_array[i].id == cartList[j].id )//We test if this POI is already in the list
			flag = 1;
	}

	if(flag == 0) //If not, add it
		cartList[cartList.length] = poi_array[i];

	map.closePopup();
	reloadCart(cartList);

	//Play an animation to show that a POI was added
	var p = $("#buttonDrawerMap");
	p.addClass("buttonDrawerActive");
	setTimeout(function(){p.removeClass("buttonDrawerActive");}, 1000);
}

//center() : Center the map on the user's position when button is clicked
function center(){
	map.setView([user_location.latitude, user_location.longitude], 15);
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
	var htmlElement;

	document.getElementById("POI_CART").innerHTML = ''; //Reset the cart

	//Setting the cart with the POI in cartlist
	for(i = 0; i <= cartList.length - 1; i++)//Display
	{
		htmlElement = parseCartContent(cartList[i], i);
		document.getElementById("POI_CART").innerHTML = document.getElementById("POI_CART").innerHTML + htmlElement;
	}
}

//distance(i) : get the distance between a user and the POI i
function distance(i){
	Math.radians = function(degrees) {
	  return degrees * Math.PI / 180;
	};

	var userlat = Math.radians(user_location.latitude);
	var userlong = Math.radians(user_location.longitude);
	var poilat = Math.radians(poi_array[i].latitude);
	var poilong = Math.radians(poi_array[i].longitude);
	var r = 6633 ; //Earth's radius
	//Precise distance
	var dp = 2*Math.asin(Math.sqrt(Math.pow(Math.sin((userlat-poilat)/2),2)+Math.cos(userlat)*Math.cos(poilat)*Math.pow(Math.sin((userlong-poilong)/2),2)));
	//Conversion to kilometers
	var d = dp*r ;

	return d;
}

//initMap(user_location) : init the map on user's location
function initMap(user_location) {
	//===> Variables
	var tilesURL = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png';
	var attrib = 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
	var markerUserPosition;

	//===> Map loading
	map = L.map('map').setView([user_location['latitude'], user_location['longitude']], 15);
	var osm = L.tileLayer(tilesURL, {
		minZoom: 10, 
		maxZoom: 19,
		attribution: attrib
	}); 
	osm.addTo(map);

	//===> Putting a marker on user's position
	markerUserPosition = L.marker([user_location['latitude'],user_location['longitude']],{icon: markerUserIcon}).addTo(map);
	markerUserPosition.bindPopup(_YOU_ARE_HERE);  

	//===> Drawing a circle to show the range
	var circle_options = {
		color: ' rgb(248,99,99)',      // Stroke color
		opacity: 0.8,         // Stroke opacity
		weight: 3,         // Stroke weight
		fillColor: 'rgb(248,99,99)',  // Fill color
		fillOpacity: 0.05,    // Fill opacity
		dashArray: "5,10"
	};

	L.circle([user_location.latitude, user_location.longitude], range*1000, circle_options).addTo(map);

	map.on('dragstart',function(){
		map.closePopup();
	});
}

function parseCartContent(element, i) {
	var htmlElement = "";

	htmlElement += "<div class=\"eltCart\" style=\"background-image: url('"+element.image_url+"');\"><div class=\"eltCartContent\">";
	htmlElement += "<div class=\"eltCartNumber\">" + (i+1) +"</div>";
	htmlElement += "<div>"+element.name.charAt(0).toUpperCase() + element.name.substring(1).toLowerCase() + "<br/>";

	if(element.type_name != null)
	{
		htmlElement += "<i>" + element.type_name.charAt(0).toUpperCase() + element.type_name.substring(1).toLowerCase() + "</i><br/>";
	}
	else
		htmlElement += "<br/>";

	if(element.sitelink != null)
	{
		htmlElement  += "<a href=" + element.sitelink + ">" + _MAP_POI_LINK + "</a>";
	}

	htmlElement += "<br/><span class=\"POI_CART_icons\"><span class=\"glyphicon glyphicon-chevron-up\" onclick=\" invertPOI("+ i +",'up'); \"></span>   <span class=\"glyphicon glyphicon-chevron-down\" onclick=\" invertPOI("+ i +",'down'); \"></span>  <span class=\"glyphicon glyphicon-remove\" onclick=\" deletePOI( " + i + "); \"></span></div>";
	htmlElement += "</div></div>";
	return htmlElement;
}
//parsePopupContent(element) : given an element of the cart, it returns a string for the popup content
function parsePopupContent(element){
	//Title
	var popup_content = '<p class="POPUP_title">' + element.name.charAt(0).toUpperCase() + element.name.substring(1).toLowerCase() + " <a title=\" "+ _MAP_CART_LINK + "\" alt=\" "+ _MAP_CART_LINK +"\" class=\"icon-plus\" href=\"#\" onclick=\"addToCart(" + i + ",'" + cartList +"'); return false;\"></a></p>";
	//Image if available
	if(element.image_url != null)
	{
		popup_content += "<img class=\"POPUP_img\" src=\"" + element.image_url + "\" title=\"image\" alt=\"image\" />";
	}

	popup_content += '<p class="POPUP_links">';
	//Button to put it in the cart
	if(window.jQuery)
		popup_content += "<a title=\" "+  _MAP_CART_LINK +"\" href=\"#\" onclick=\"addToCart(" + i + ",'" + cartList +"'); return false;\">"+ _MAP_CART_LINK +"</a>";
	//Link to Wikipedia if available
	if(element.sitelink != null)
	{
		popup_content += "<br/><a target=\"_blank\" href=\"" + element.sitelink + "\">" + _MAP_POI_LINK + "</a>";
	}
	popup_content += "</p>";

	return popup_content;
}

//parseWikiVoyageElement(element) : given a wikivoyage element, it returns the string for integration
function parseWikiVoyageElement(element) {
	var html = '<a target="_blank" href="'+element.sitelink+'">';
		html += '<div class="WikiVoyageElement">';
		html += element.title;
		
		if(element.thumbnail != null)
			html += '<img class="WikiVoyageImg" src="' + element.thumbnail + '" />';
		
		html += '</div></a>';

	return html;
}

function placePOI(){
	for(i = 0; i < poi_array_decode.nb_poi; ++i)
	{
		var j = 0;
		var popup_content;

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
}

function placeWikiVoyage(guides){
	var i;
	var container = document.getElementById('WikiVoyageThumbnailContainerScroll');
	container.innerHTML = "";

	for(i = 0; i < guides.length; i ++)
	{
		container.innerHTML += parseWikiVoyageElement(guides[i]);
	}
}

//applyMediaQueries() : Set a series of medias queries for responsive design
function applyMediaQueries(){
	//Short screen, with drawer
	if(mq.matches)
	{
		$("#cartHideButton").show();
		$("#POI_CART_BLOCK").css('left','-100%');
		buttonDrawerMap.enable();
	}

	//Large screen, drawer always open
	else
	{
		$("#cartHideButton").hide();
		buttonDrawerMap.disable();
		$("#POI_CART_BLOCK").css('left','0');
	}

	//All cases
	$("#POI_CART").height($("#POI_CART_BLOCK").height() - $("#POI_CART_TITLE").height() - $("#POI_CART_FOOTER").height() - 50);
}

function wikiVoyageToggleDrawer(){
	if(isWikiVoyageOpen)
	{
		document.getElementById("WikiVoyageBox").style.bottom = "-165px";
		isWikiVoyageOpen = false;
	}
	else
	{
		document.getElementById("WikiVoyageBox").style.bottom = 0;
		isWikiVoyageOpen = true;
	}
	
	if(window.jQuery)
	{
		$("#wikiVoyageToggleButton").toggleClass("glyphicon-chevron-down");
		$("#wikiVoyageToggleButton").toggleClass("glyphicon-chevron-up");
	}
}