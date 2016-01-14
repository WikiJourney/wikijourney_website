﻿<?php 

if(isset($_COOKIE['lg']))
{

	if($_COOKIE['lg'] == 'en') {
		include("./lg/en.php"); // TODO dynamic pages
		$language = "en";
	}
	
	else if($_COOKIE['lg'] == 'fr') {
		include("./lg/fr.php");
		$language = "fr";
	}

	else if($_COOKIE['lg'] == 'zh') {
		include("./lg/zh.php");
		$language = "zh";
	}
	
	else if($_COOKIE['lg'] == 'ar') {
		include("./lg/ar.php");
		$language = "ar";
	}

	else //Not normal
	{
		include("./lg/en.php");
		setcookie("lg","en"); //Redefine cookie
		$language = "en";
	}
}

else 
{
	include("./lg/fr.php");
	setcookie("lg","fr"); //Define cookie
	$language = "fr";
}
	


?>
<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
	<head>

	<title><?php echo _TITLE; ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" media="screen" type="text/css" href="./style/design.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="./style/fontello.css" />
	<link rel="Shortcut icon" href="./images/design/favicon.ico" />
	
	<?php
	if(isset($INCLUDE_MAP_PROPERTIES)) //Properties dedicated to the map
	{
	?>
		<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
		<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.js'></script>
		<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.css' rel='stylesheet' />
		<link rel="stylesheet" href="./style/leaflet-routing-machine.css" />
		<script src="scripts/leaflet-routing-machine.js"></script>
	<?php
	}
	?>

	
	</head>
	<body>
	
	<!-- Piwik -->
	<script type="text/javascript">
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
	</script>
	<noscript><p><img src="//piwik.wikijourney.eu/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
	<!-- End Piwik Code -->
	
	<div id="banniere">
				<table id="logoLanguageBoxContainer">
					<tr>
						<td><img  id="logoban" src="<?php echo _SRC_IMAGE_LOGO; ?>" alt="Logo" /></td>
						
						<td><p id="languagesBox">
							<a href="action.php?lg=en">English</a><br/>
							<a href="action.php?lg=fr">Français</a><br/>
							<a href="action.php?lg=zh">中文</a><br/>
							<a href="action.php?lg=ar">عربية</a>
							</p>
						</td>
						
					</tr>
				</table>
			
			
			<div id="menu">
				<table id="liste_menu.php" style="border-collapse: separate;" >
					<tr>
						<td id="lien_index.php"><a href="index.php"><?php echo _INDEX ;?></a></td>
						<td id="lien_paths.php"><a href="paths.php"><?php echo _YOUR_PATHS;?></a></td>
						<td id="lien_about.php"><a href="about.php"><?php echo _ABOUT ;?></a></td>
						<td id="lien_contact.php"><a href="http://blog.wikijourney.eu/" target="_blank"><?php echo _BLOG ;?></a></td>
					</tr>
				</table>
			</div>	
			<?php
			//Colorating the active page
				$nomPage = $_SERVER['SCRIPT_FILENAME'];
				$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
				$nomPage = preg_replace($reg, '$2', $nomPage); 
				
			?>
			<script type="text/javascript">
				if(document.getElementById("lien_" + "<?php echo $nomPage; ?>") != null)
					document.getElementById("lien_" + "<?php echo $nomPage; ?>").style.cssText = "background-color: rgb(137,160,173);";
			</script>
		
		</div>
		<?php
		if($nomPage == 'index.php')
		{
		?>
			<!-- Temporary code for app launching -->
			<style>
			#banniere_sup {
			margin-top : 20px;
			border: 1px solid black;
			margin-left: auto;
			margin-right: auto;
			width: 1000px;
			background-color: white;
			}
			
			#banniere_sup p{
			text-align: left;
			font-family: "Helvetica","Trebuchet MS";
			font-weight: bold;
			margin: 10px;
			margin-left: 50px;
			font-size: 26px;
			
			color: rgb(248,99,99);

			}

			#stores_logos_block{
			text-align: center;
			}
			#stores_logos_block img
			{
			height: 40px;
			display: inline-block;
			margin: 5px 40px 10px 40px;
			}
			</style>

			<div id="banniere_sup">
			<?php
			if($language == 'fr')
				echo '<p>Téléchargez notre application mobile !</p>';
			else
				echo '<p>Download our mobile app!</p>';
			?>
			<div id="stores_logos_block">
				<a target="_blank" href="https://play.google.com/store/apps/details?id=eu.wikijourney.wikijourney"><img src="./images/design/google_play.png" alt="Google Play" title="Google Play" /></a>
				<a target="_blank" href="https://f-droid.org/repository/browse/?fdid=com.wikijourney.wikijourney"><img src="./images/design/fdroid.png" alt="F-Droid" title="F-Droid" /></a>
				<a target="_blank" href="http://www.amazon.com/WikiJourney/dp/B0191WMI52/"><img src="./images/design/amazon.png" alt="Amazon" title="Amazon" /></a>
				<a target="_blank" href="http://wikijourney.store.aptoide.com/app/market/com.wikijourney.wikijourney/16/14074410/WikiJourney"><img src="./images/design/aptoide.png" alt="Aptoide" title="Aptoide" /></a>
			</div>
			</div>
			<!-- End temporary code -->
		<?php
		}
		?>
		<div id="corps">
