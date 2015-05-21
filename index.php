<?php
	include("./include/haut.php");
?>

<h1>Bienvenue !</h1>

<p>
 	<button onclick="getLocation()">Find Point Of Interest around me now !</button>
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
    Or type an adress you want to look up ! <input type="text" name="name"/>
    <input type="submit" name="valider" value="OK"/>
    </form>

</p>

<?php
	include("./include/bas.php");
?>
