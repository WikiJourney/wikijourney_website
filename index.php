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

<div class="jumbotron shadowed" id="banniere">
	<div class="container">
		<div class="row"><h1 class="bigtitle"><?php echo _CATCHPHRASE; ?></h1></div>
		<div class="row stores_logos_block">
			<div class="col-xs-6 col-md-3">
				<a target="_blank" href="https://play.google.com/store/apps/details?id=eu.wikijourney.wikijourney"><img src="./images/design/stores/google_play.png" alt="Google Play" title="Google Play" height="40px" width="135px" /></a>
			</div>
			<div class="col-xs-6 col-md-3">
				<a target="_blank" href="https://f-droid.org/repository/browse/?fdid=com.wikijourney.wikijourney"><img src="./images/design/stores/fdroid.png" alt="F-Droid" title="F-Droid" height="40px" width="114px" /></a>
			</div>
			<div class="col-xs-6 col-md-3">
				<a target="_blank" href="http://www.amazon.com/WikiJourney/dp/B0191WMI52/"><img src="./images/design/stores/amazon.png" alt="Amazon" title="Amazon" height="40px" width="116px" /></a>
			</div>
			<div class="col-xs-6 col-md-3">
				<a target="_blank" href="http://wikijourney.store.aptoide.com/"><img src="./images/design/stores/aptoide.png" alt="Aptoide" title="Aptoide" height="40px" width="132px" /></a>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<h2><?php echo _WELCOME_TITLE; ?></h2>

	<p><?php if (defined('_WELCOME_MESSAGE')) {echo _WELCOME_MESSAGE;} ?></p>

	<form method="post" action="map.php" id="formPOI">
		<div class="row">
			<input type="hidden" id="latitude" name="latitude" value="" />
			<input type="hidden" id="longitude" name="longitude" value="" />
			<input type="hidden" id="from" name="from" value="form" />
			<div class="col-sm-8 col-sm-offset-2">
				<!-- Around a place -->
				<div class="row">
					<div class="col-sm-6"><label for="input-location"><?php echo _AROUND_LOCATION; ?></label></div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-xs-8">
								<input type="text" id="input-location" placeholder="<?php echo _PLACEHOLDER; ?>" name="adressValue" id="adressValue" class="form-control" required >
							</div>
							<div class="col-xs-4">
								<button type="submit" class="btn btn-primary btn-block" type="button" name="go" value="adress">Go!</button>
							</div>
						</div>
					</div>
				</div><br/>
				<!-- Around my position -->
				<div class="row">
					<div class="col-sm-6"><label><?php echo _AROUND_ME; ?></label></div>
					<div class="col-sm-6">
						<button class="btn btn-primary btn-block" type="button" onclick="getGeolocation();">Go!</button>
						<p class="help-block"><?php echo _NOTE_GEOLOC; ?></p>
					</div>

				</div><br/>
				<!-- Option Range -->
				<div class="row">
					<div class="col-sm-6"><label for="range"><?php echo _RANGE; ?></label></div>
					<div class="col-sm-6">
						<input type="number" name="range" id="range" class="form-control" min="0" value="1" />
					</div>
				</div><br/>

				<!-- Option Max -->
				<div class="row">
					<div class="col-sm-6"><label for="maxPOI"><?php echo _MAX_POI; ?></label></div>
					<div class="col-sm-6">


						<div class="input-group">
							<input type="number" name="maxPOI" id="maxPOI" class="form-control" min="0" value="50" />
							<span class="input-group-btn">
								<a class="btn btn-default" onclick="$('#infoMaxPOIcollapse').collapse('toggle');"><span class="glyphicon glyphicon-info-sign"></span></a>
      						</span>
						</div>
						<div id="infoMaxPOIcollapse" class="collapse in"><p class="help-block"><?php echo _NOTE_MAXPOI; ?></p></div>
					</div>

				</div><br/>

			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	window.onload = function(e) {
		$('#infoMaxPOIcollapse').collapse();

		$('#maxPOI').change(function(){
			if(parseInt($('#maxPOI').val()) > 50)
			{
				$('#infoMaxPOIcollapse').collapse('show');
			}
			else
				$('#infoMaxPOIcollapse').collapse('hide');

		});
	}

	function showPosition(position) {
		if(position.coords.latitude == null)
			alert("Sorry, but geolocation is not supported by this browser.");
		else
		{
			document.getElementById('latitude').value = position.coords.latitude;
			document.getElementById('longitude').value  = position.coords.longitude;
			$('#formPOI').submit();
		}

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
