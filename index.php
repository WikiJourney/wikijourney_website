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
	header('Location: https://www.wikijourney.eu/oauth/oauth_connexion.php?oauth_verifier='.$_GET['oauth_verifier'].'&oauth_token='.$_GET['oauth_token'].'');
}

include('./include/haut.php');

?>

	<div id="banniere_sup">
		<div class="row">
			<div class="col-xs-12">
				<h2><?php
				if($language == 'fr')
					echo 'Téléchargez notre application mobile !';
				else
					echo 'Download our mobile app!';
				?></h2>
			</div>
		</div>
		<div class="row" id="stores_logos_block">
			<div class="col-sm-3">
				<a target="_blank" href="https://play.google.com/store/apps/details?id=eu.wikijourney.wikijourney"><img src="./images/design/google_play.png" alt="Google Play" title="Google Play" /></a>
			</div>
			<div class="col-sm-3">
				<a target="_blank" href="https://f-droid.org/repository/browse/?fdid=com.wikijourney.wikijourney"><img src="./images/design/fdroid.png" alt="F-Droid" title="F-Droid" /></a>
			</div>
			<div class="col-sm-3">
				<a target="_blank" href="http://www.amazon.com/WikiJourney/dp/B0191WMI52/"><img src="./images/design/amazon.png" alt="Amazon" title="Amazon" /></a>
			</div>
			<div class="col-sm-3">
				<a target="_blank" href="http://wikijourney.store.aptoide.com/"><img src="./images/design/aptoide.png" alt="Aptoide" title="Aptoide" /></a>
			</div>
		</div>
	</div>

	<h1><?php echo _WELCOME_TITLE; ?></h1>

	<p><?php if (defined('_WELCOME_MESSAGE')) {echo _WELCOME_MESSAGE;} ?></p>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form method="post" action="map.php" id="formPOI">
				<input type="radio" name="choice" value="adress" checked="checked" />
				<?php echo _AROUND_LOCATION; ?>
				<input type="text" placeholder="<?php echo _PLACEHOLDER; ?>" name="adressValue" id="adressValue" />
				<br/>
				<input type="radio" name="choice" value="around" onclick="getGeolocation();" /> <?php echo _AROUND_ME; ?>
				<br/>
				<p class="small"><?php echo _NOTE_GEOLOC; ?></p>
				<br/>
				<br/>

				<p><?php echo _OPTIONS; ?></p>
				<label for="range"><?php echo _RANGE; ?></label><input class="miniInput" type="text" name="range" id="range" value="1" /><br/>
				<label for="maxPOI"><?php echo _MAX_POI; ?></label><input class="miniInput" type="text" name="maxPOI" id="maxPOI" value="25" /><br/><br/>

				<input type="hidden" name="longitude" id="longitude" value="null" />
				<input type="hidden" name="latitude" id="latitude" value="null" />

				<input type="submit" value="Go !" onclick="this.value='<?php echo _LOADING; ?>';" class="btn btn-primary" />
			</form>
		</div>
	</div>

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
		if($_GET['message'] == 'confirm')
		{
			echo '<script>alert("';
			echo _PATH_CREATED;
			echo '"); </script>';
		}
	}
?>
