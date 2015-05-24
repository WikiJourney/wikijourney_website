<?php
	include("./include/haut.php");
?>

<h1><?php echo _WELCOME_TITLE; ?></h1>

<p>
	<form method="post" action="map.php" id="formPOI">
		
		<input type="radio" name="choice" value="around" onclick="document.getElementById('adressValue').style.display = 'none';">Around me !<br/>
		<input type="radio" name="choice" value="adress" onclick="document.getElementById('adressValue').style.display = 'block';">Close to an adress !
		<br/><input type="text" value="Type your adress here." name="adressValue" id="adressValue" />
		
		<script type="text/javascript">
			document.getElementById("adressValue").style.display = "none"; //Default
		</script>
		<br/><br/>
		
		Options :<br/>
		<label for="range">Range (km) : </label><input type="text" name="range" id="range" value="1"/><br/>
		<label for="maxPOI">Max POI : </label><input type="text" name="maxPOI" id="maxPOI" value="10" /><br/><br/>
		
		<input type="hidden" name="longitude" id="longitude" value="" />
		<input type="hidden" name="latitude" id="latitude" value="" />
		
		<input type="submit" value="Go !" onclick="submitForm();" />
		
		
	</form>


 	<script type="text/javascript">
	function showPosition(position) {
		document.getElementById('latitude').value = position.coords.latitude;
		document.getElementById('longitude').value  = position.coords.longitude;
		document.forms['formPOI'].submit();
	}

	function submitForm() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
		x.innerHTML = "Sorry, but geolocation is not supported by this browser.";
		}
	}
	
	
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
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
		x.innerHTML = "Sorry, but geolocation is not supported by this browser.";
		}
	}

	</script>   


</p>

<?php
	include("./include/bas.php");
?>
