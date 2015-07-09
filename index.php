<?php
	include("./include/haut.php");
?>

<h1><?php echo _WELCOME_TITLE; ?></h1>


	<form method="post" action="map.php" id="formPOI">
		<p>
		<input type="radio" name="choice" value="adress" checked><?php echo _AROUND_LOCATION; ?>
		
		
			<input type="text" placeholder="<?php echo _PLACEHOLDER; ?>" name="adressValue" id="adressValue" />
			<br/>
			<input type="radio" name="choice" value="around" onclick="getGeolocation(); "><?php echo _AROUND_ME; ?>
			<br/>
			<p style="font-size: 12px; width: 50%; margin-left: 10%"><?php echo _NOTE_GEOLOC; ?></p>
			<br/>
			<br/>
			
			<?php echo _OPTIONS; ?><p>
			<label for="range"><?php echo _RANGE; ?></label><input class="miniInput" type="text" name="range" id="range" value="1"/><br/>
			<label for="maxPOI"><?php echo _MAX_POI; ?></label><input class="miniInput" type="text" name="maxPOI" id="maxPOI" value="10" /><br/><br/>
		
		<input type="hidden" name="longitude" id="longitude" value="" />
		<input type="hidden" name="latitude" id="latitude" value="" />
		
		<input type="submit" value="Go !" onclick="this.value='Loading...';"/>
		
		</p>
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




<?php
	include("./include/bas.php");
?>
