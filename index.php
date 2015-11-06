<?php
	include("./include/haut.php");
	

?>

<h1><?php echo _WELCOME_TITLE; ?></h1>

	<div id="welcome">
		<?php 
			if (defined('_WELCOME_MESSAGE')){
				echo _WELCOME_MESSAGE;
			} ?>
	</div>

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
			<!-- if IE then usual else cursor -->
			<!-- <script>
				var isIE = /*@cc_on!@*/false || !!document.documentMode;
				if (isIE) {
					document.getElementById("range").innerHTML = "<input class='miniInput' type='text' name='range' id='range' value='1'/>"
				} else {
					document.getElementById("range").innerHTML = "20<input class='range' type='range' name='points' id='range2' min='20' max='150' step='25'/>150"
						'au revoir'
				}
			</script>
			<label for="range"><?php echo _RANGE; ?></label><div id="range"></div><br/>
			<label for="maxPOI"><?php echo _MAX_POI; ?></label><input class="miniInput" type="text" name="maxPOI" id="maxPOI" value="10" /><br/><br/>
			-->
			
			<label for="range"><?php echo _PROFILE; ?></label>
				<input type="range" value="" max="5" min="1" step="1" name="profile">
			<br/><br/>

		<input type="hidden" name="longitude" id="longitude" value="null" />
		<input type="hidden" name="latitude" id="latitude" value="null" />
		
		<input type="submit" value="Go !" onclick="this.value='<?php echo _LOADING; ?>';"/>
		
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
		alert("Sorry, but geolocation is not supported by this browser.");
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

	//At the end of the page, so it could load.
	if(isset($_GET['message']))
	{
		if($_GET['message'] == 'adress')
		{
			echo '<script>alert("';
			echo _ADRESS_FAILURE;
			echo '"); </script>';
		}
		if($_GET['message'] == 'geoloc')
		{
			echo '<script>alert("';
			echo _GEOLOC_FAILURE;
			echo '"); </script>';
		}
	}
?>
