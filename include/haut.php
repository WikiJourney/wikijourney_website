<?php

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
	<meta name=viewport content="width=device-width,initial-scale=1">
	<link rel="shortcut icon" href="./images/design/logo_small.png" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" media="screen" type="text/css" href="./style/fontello.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="./style/design.css" />

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
	<?php
		//Colorating the active page
		$nomPage = $_SERVER['SCRIPT_FILENAME'];
		$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
		$nomPage = preg_replace($reg, '$2', $nomPage);
	?>

	<nav class="navbar navbar-custom navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">
						<img alt="Logo WikiJourney" src="./images/design/logo_small.png"> WikiJourney
					</a>
				</div>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li <?php echo ($nomPage == 'paths.php' ? 'class="active"' : '') ?>><a href="paths.php"><?php echo _YOUR_PATHS;?></a></li>
					<li <?php echo ($nomPage == 'about.php' ? 'class="active"' : '') ?>><a href="about.php"><?php echo _ABOUT ;?></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li id="lien_contact.php"><a href="http://blog.wikijourney.eu/" target="_blank"><?php echo _BLOG ;?></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-globe"></span> Languages <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="action.php?lg=en">English</a></li>
							<li><a href="action.php?lg=fr">Français</a></li>
							<li><a href="action.php?lg=zh">中文</a></li>
							<li><a href="action.php?lg=ar">عربية</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>


	
