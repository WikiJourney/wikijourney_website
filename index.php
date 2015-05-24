<?php
	include("./include/haut.php");
?>

<h1><?php echo _WELCOME_TITLE; ?></h1>

<p>
	<form method="post" action="map.php" id="formPOI">
		
		<input type="radio" name="choice" value="adress" checked>Close to an adress !
		<input type="text" value="Type your adress here." name="adressValue" id="adressValue" />
		<br/>
		<input type="radio" name="choice" value="around" onclick="getGeolocation(); ">Around me ! (Not working with Safari for the moment..)
		<br/>
				<input type="text" name="longitude" id="longitude" value="" readonly />
				<input type="text" name="latitude" id="latitude" value="" readonly />
		<br/><br/>
		
		Options :<br/>
		<label for="range">Range (km) : </label><input type="text" name="range" id="range" value="1"/><br/>
		<label for="maxPOI">Max POI : </label><input type="text" name="maxPOI" id="maxPOI" value="10" /><br/><br/>
		

		
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
