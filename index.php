<?php
	include("./include/haut.php");
?>

<h1><?php echo _WELCOME_TITLE; ?></h1>

<p>
	<form method="post" action="map.php">
		
		<input type="radio" name="choice" value="around" onclick="document.getElementById('adressValue').style.display = 'none';">Around me !<br/>
		<input type="radio" name="choice" value="adress" onclick="document.getElementById('adressValue').style.display = 'block';">Close to an adress !
		<br/><input type="text" value="Type your adress here." name="adressValue" id="adressValue" />
		<script type="text/javascript">
			document.getElementById("adressValue").style.display = "none";
		</script>
		<br/><br/>
		Options :<br/>
		<label for="range">Range (km) : </label><input type="text" name="range" id="range" value="1"/><br/>
		<label for="maxPOI">Max POI : </label><input type="text" name="maxPOI" id="maxPOI" value="10" /><br/><br/>
		<input type="submit" value="Go !" />
	</form>


 	<button onclick="getLocation()"><?php echo _BUTTON_POI_AROUND; ?></button>
	<script type="text/javascript">
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
	function showPosition(position) {
		var latlong = new Array();

		latlong[0] = position.coords.latitude;
		latlong[1] = position.coords.longitude;
		openWithPostData("map.php", latlong);
	}
	</script>   
	<br/><br/>
    <form name="inscription" method="post" action="map.php">
    <?php echo _ADRESS_LOOK_UP; ?> <input type="text" name="name"/>
    <input type="submit" name="valider" value="OK"/>
    </form>

</p>

<?php
	include("./include/bas.php");
?>
