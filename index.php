<?php
	include("./include/haut.php");
?>

<h1><?php echo _WELCOME_TITLE; ?></h1>

<p>
	<form method="post" action="map.php" id="formPOI">
		
		<input type="radio" name="choice" value="adress" checked>Close to a location !
		<p>
		<input type="text" value="Type a location here" name="adressValue" id="adressValue" /></p>
		<br/>
		<input type="radio" name="choice" value="around" onclick="getGeolocation(); ">Around me ! 
		<br/>
		<p style="font-size: 12px; width: 50%; margin-left: 10%">Note : This fonctionnality involve geolocation and could not work, it
		depends of the device you're on and the way you're connected to the internet.</p>
		<br/>
		<br/>
		
		Options :<p>
		<label for="range">Range (km) : </label><input class="miniInput" type="text" name="range" id="range" value="1"/><br/>
		<label for="maxPOI">Max POI : </label><input class="miniInput" type="text" name="maxPOI" id="maxPOI" value="10" /><br/><br/>
		</p>

		<input type="hidden" name="longitude" id="longitude" value="" readonly />
		<input type="hidden" name="latitude" id="latitude" value="" readonly />
		
		<input type="submit" value="Go !" />
		
		
	</form>


 	<script type="text/javascript">
	function showPosition(position) {
		document.getElementById('latitude').value = position.coords.latitude;
		document.getElementById('longitude').value  = position.coords.longitude;
		
	}

	function getGeolocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
		x.innerHTML = "Sorry, but geolocation is not supported by this browser.";
		}
	}
	
	/*
	function openWithPostData(page,data) {
		var form = document.createElement('form');
    	form.setAttribute('action', page);
    	form.setAttribute('method', 'post');
    	for (var n in data) {
        	var inputvar = document.createElement('input');
        	inputvar.setAttribute('type', 'hidden');
        	inputvar.setAttribute('name', n);
        	inputvar.setAttribute('value', data[n]);
        	form.appendChild(inputvar);
    	}
    document.body.appendChild(form);
    form.submit();
	}
	*/

	</script>   


</p>

<?php
	include("./include/bas.php");
?>
