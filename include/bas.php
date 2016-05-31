	<?php
	if(!isset($INCLUDE_MAP_PROPERTIES)) //No footer for map.php
	{ 
		?>

	<div class="footer">
		<div class="row">
			<div class="col-sm-6 text-center">
				<h6><?php echo _OUR_PARTNERS; ?></h6>
				<p  class="text-center"><a target="_blank" href="http://www.wikimedia.fr/"><img src="./images/design/wikimedia_france_logo.png" title="Wikimedia France" alt="Wikimedia France"/></a></p>
			</div>
			<div class="col-sm-6 text-center">
				<h6><?php echo _FOLLOW_US; ?></h6>
				<p class="text-center"><a target="_blank" href="https://www.facebook.com/WikiJourney"><img src="./images/design/fb.png" alt="Facebook" title="Facebook" /></a>
				<a target="_blank" href="https://twitter.com/WikiJourney"><img src="./images/design/twitter.png" alt="Twitter" title="Twitter" /></a>
				<a target="_blank" href="https://github.com/WikiJourney/"><img src="./images/design/github.png" alt="GitHub" title="GitHub" /></a>
				<a target="_blank" href="http://blog.wikijourney.eu"><img src="./images/design/pluxml.png" alt="Our Blog!" title="Our Blog!" /></a></p>
			</div>
		</div>
	</div>
		<?php 
	}
	?>
	<!-- SCRIPTS -->
	<?php
	if(!(isset($_GET['simplified']) && $_GET['simplified'] == 1))
	{
		?>
	<script src="lib/jquery/jquery-2.2.0.min.js"></script>
		<?php
	}
	?>
	<script src="lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="lib/leaflet/leaflet.js"></script>

	<?php
	if(isset($INCLUDE_MAP_PROPERTIES)) //Special scripts for the map
	{ 
	?>
	<script src="lib/easy-button/easy-button.js"></script>
	<script src="lib/leafletawesomemarkers/leaflet.awesome-markers.min.js"></script>
	<script src="scripts/map-scripts-functions.js"></script>
	<script src="scripts/map-scripts.js"></script>
	<script src="scripts/jsonparse.js"></script>
	<?php
	}
	?>

	<script type="text/javascript">
		//PIWIK TRACKER
		var _paq = _paq || [];
		_paq.push(['trackPageView']);
		_paq.push(['enableLinkTracking']);
		(function() {
			var u="//piwik.wikijourney.eu/";
			_paq.push(['setTrackerUrl', u+'piwik.php']);
			_paq.push(['setSiteId', 1]);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
			g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
		})();
		
		//Navbar Logo animation
		if(window.jQuery)
		{
			$(window).scroll(function() {
				if ($(document).scrollTop() > 10) {
					$('.logoNavbar').addClass('shrink').removeClass('notshrink');
				} else {
					$('.logoNavbar').removeClass('shrink').addClass('notshrink');
				}
			});
		}
		else
			document.getElementsByClassName('logoNavbar')[0].className += " shrink";
	</script>
	<noscript><p><img src="//piwik.wikijourney.eu/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
</body>
</html>
