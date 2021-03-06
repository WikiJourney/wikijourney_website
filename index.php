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

// Store the language file in an array, we're gonna parse it in a loop.
$wp_languages_raw = file("config/wikipedia_languages.txt");
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

	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
			<form method="post" action="map.php" id="formPOI" class="form-horizontal" role="form">
				<!-- Some hidden form, the first two are gonna be filled by the geoloc callback -->
				<!-- The last one gives to map.php the origin of the user -->
				<input type="hidden" id="latitude" name="latitude" value="" />
				<input type="hidden" id="longitude" name="longitude" value="" />
				<input type="hidden" id="from" name="from" value="form" />

				<div class="row">
					<!-- Around a place -->
					<div class="col-md-6">
							<label class="control-label label-top" for="adressValue"><?php echo _AROUND_LOCATION; ?></label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="<?php echo _PLACEHOLDER; ?>" name="adressValue" id="adressValue" required >
							<span class="input-group-btn">
								<button type="submit" class="input-prepend btn btn-primary btn-block" type="button" name="go" value="adress">Go!</button>
							</span>
							</div>
					</div>

					<!-- Around my position -->
					<div class="col-md-6">
							<label class="control-label label-top" for="adressValue"><?php echo _AROUND_ME; ?></label>
							<button id="buttonGoGeoloc" class="btn btn-primary btn-block" type="button" onclick="getGeolocation();">Go!</button>
							<div id="infoGeolocCollapse" class="collapse"><p class="help-block"><?php echo _NOTE_GEOLOC; ?></p></div>
					</div>
				</div>
				<hr/>
				<h4><?php echo _OPTIONS; ?></h4>

				<!-- Option Language -->
				<div class="row">
					<label class="col-sm-6 control-label" for="adressValue"><?php echo _LANGUAGE; ?></label>
					<div class="col-sm-6">
						<select class="form-control chosen-select" id="selectLanguage" name="selectedLanguage">
							<?php
							foreach($wp_languages_raw as $key => $value)
							{
								// On the left, the language code, useful for the API.
								// On the right, the name of the language, to put in the option.
								$wp_language = explode(':', $value);
								// Next "if" is to avoid blank lines.
								if(isset($wp_language[1])) {
									?>
									<option value="<?php echo $wp_language[0]; ?>"<?php echo ($wp_language[0] == $language) ? " selected" : ""; ?>><?php echo substr($wp_language[1],0,-1); ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
				</div><br/>

				<!-- Option Range -->
				<div class="row">
					<label class="col-sm-6 control-label" for="adressValue"><?php echo _RANGE; ?></label>
					<div class="col-sm-6">
						<div class="input-group">
							<input type="range" name="range" id="range" class="form-control" min="1" value="1" max="10"/>
							<span class="input-group-addon" id="rangeValue"></span>
						</div>
					</div>
				</div><br/>

				<!-- Option Max -->
				<div class="row">
					<label class="col-sm-6 control-label" for="adressValue"><?php echo _MAX_POI; ?></label>
					<div class="col-sm-6">
						<div class="input-group">
							<input type="range" name="maxPOI" id="maxPOI" class="form-control" min="0" value="50" max="200" step="10" />
							<span class="input-group-addon" id="maxPOIvalue"></span>
						</div>
						<div id="infoMaxPOIcollapse" class="collapse"><p class="help-block"><?php echo _NOTE_MAXPOI; ?></p></div>
					</div>
				</div><br/>
			</form>
		</div>
	</div>

</div>

<script type="text/javascript">
	// When the page is load, we set the listener for the maxPOI collapse
	window.onload = function(e) {
		$('#maxPOI').change(function(){
			if(parseInt($('#maxPOI').val()) > 50)
			{
				$('#infoMaxPOIcollapse').collapse('show');
			}
			else
				$('#infoMaxPOIcollapse').collapse('hide');

		});

		$(".chosen-select").chosen();

		// Sliders init
		$("#maxPOIvalue").html($("#maxPOI").val());
		$("#rangeValue").html($("#range").val());
		// Sliders set event
		$("#maxPOI").on("input", function(){ $("#maxPOIvalue").html($("#maxPOI").val()) });
		$("#range").on("input", function(){ $("#rangeValue").html($("#range").val()) });

	};

	// Callback when geoloc is successful
	function successPosition(position) {
		console.log(position);
		if(position.coords.latitude == null || position.coords.latitude == 0 || position.coords.longitude == 0)
			geolocationFailed();
		else
		{
			document.getElementById('latitude').value = position.coords.latitude;
			document.getElementById('longitude').value  = position.coords.longitude;
			$('#formPOI').submit();
		}

	}

	// This function is triggered when geolocation fails, it opens the note block
	function geolocationFailed(){
		$("#buttonGoGeoloc").html("<?php echo _RETRY; ?>");
		$('#infoGeolocCollapse').collapse('show');
	}

	//Geolocation call
	function getGeolocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(successPosition, geolocationFailed);
		} else {
			geolocationFailed();
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
