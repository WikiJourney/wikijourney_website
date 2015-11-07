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

			<script type="text/javascript">
			function displayVal(value)
			{
				var profile = value;
				var range;
				var maxPOI;
				
				switch (profile) {
				
					case '1':
						name = <?php echo _PROFILE_LANDSCAPE; ?> ;
						range = 10 ;
						maxPOI = 30 ;
						break;
					case '2':
						name = <?php echo _PROFILE_SMALLTOWN; ?>;
						range = 2 ;
						maxPOI = 20 ;
						break;
					case '3':
						name = <?php echo _PROFILE_MIDTOWN; ?>;
						range = 1 ;
						maxPOI = 20 ;
						break;
					case '4':
						name = <?php echo _PROFILE_BIGTOWN; ?>;
						range = 1 ;
						maxPOI = 30 ;
						break;		
					default:
						name = <?php echo _PROFILE_CITY; ?>;
						range = 0.5;
						maxPOI = 60;
						break;
					}
					
					document.getElementById('name').innerHTML = name;
					document.getElementById('maxPOI').value = maxPOI;
					document.getElementById('range').value = range;
			}
			</script>
			
			<!-- if IE then usual else cursor --> <!--
			<script>
				var isIE = /*@cc_on!@*/false || !!document.documentMode;
				if (isIE) {
					document.getElementById('range').innerHTML = '<input class="miniInput" type="text" name="range" id="range2" value="1"/>' ;
				} else {
					var html = '<input id="profile" type="range" value="" max="5" min="1" step="1" value="1" name="profile" oninput="displayVal(this.value)" onchange="displayVal(this.value)">'
					document.getElementById('range').innerHTML = html ;
				}
			</script>
			<label for="range"><?php echo _RANGE; ?></label><p id="range"> bouh</p><br/>
			<label for="maxPOI"><?php echo _MAX_POI; ?></label><input class="miniInput" type="text" name="maxPOI" id="maxPOI" value="10" /><br/><br/>
			-->
			
			<label for="range"><?php echo _PROFILE; ?></label>
				<input id="profile" type="range" value="" max="5" min="1" step="1" value="1" name="profile" oninput="displayVal(this.value)" onchange="displayVal(this.value)">
				<p id="name" style="float:right"> </p>
			<br/><br/>
			<input type="hidden" value="" id="maxPOI" name="maxPOI"/>
			<input type="hidden" value="" id="range" name="range"/>

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
