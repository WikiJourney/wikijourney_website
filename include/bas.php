	<?php
	if(!isset($INCLUDE_MAP_PROPERTIES)) //Properties dedicated to the map
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
	<script src="lib/jquery/jquery-2.2.0.min.js"></script>
	<script src="lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="lib/easy-button/easy-button.js"></script>
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
		$(window).scroll(function() {
			if ($(document).scrollTop() > 10) {
				$('.logoNavbar').addClass('shrink').removeClass('notshrink');
			} else {
				$('.logoNavbar').removeClass('shrink').addClass('notshrink');
			}
		});
		<?php
		if(isset($INCLUDE_MAP_PROPERTIES)) //Properties dedicated to the map
		{ 
			?>
			$(".logoNavbar").removeClass("notshrink").addClass("shrink");
			
			var mq = window.matchMedia( "(max-width: 765px)" );

			if(mq.matches)
			{
				easyButtonShow = L.easyButton('glyphicon-map-marker', function(btn, map){
					$("#POI_CART_BLOCK").css('left',0);
				}).addTo(map);
				$("#cartHideButton").show();

				$("#cartHideButton").click(function(){
					$("#POI_CART_BLOCK").css('left','-100%');
				});

			}

			<?php
		}
		?>
	</script>
	<noscript><p><img src="//piwik.wikijourney.eu/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
</body>
</html>
