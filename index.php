<?php
	/*
================== WIKIJOURNEY - INDEX.PHP =======================
Index page of the website



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

//Oauth redirection 
if(isset($_GET['oauth_verifier']) OR isset($_GET['oauth_token'])) 
{
	header('Location: https://dev.wikijourney.eu/dev_oauth/oauth/oauth_connexion.php?oauth_verifier='.$_GET['oauth_verifier'].'&oauth_token='.$_GET['oauth_token'].'');
}	

include('./include/haut.php');

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
			<label for="range"><?php echo _RANGE; ?></label><input class="miniInput" type="text" name="range" id="range" value="1"/><br/>
			<label for="maxPOI"><?php echo _MAX_POI; ?></label><input class="miniInput" type="text" name="maxPOI" id="maxPOI" value="10" /><br/><br/>
		
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
