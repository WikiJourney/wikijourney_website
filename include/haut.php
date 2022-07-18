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
	<meta property="og:title" content="WikiJourney" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://wikijourney.eu" />
	<meta property="og:image" content="https://wikijourney.eu/images/design/wj_logos/logo_small.png" />
	<meta property="og:description" content="Revisitez le tourisme grâce à la connaissance de Wikipédia" />
	<meta property="og:locale" content="fr_FR" />
	<meta property="og:locale:alternate" content="en_US" />
	<meta property="og:locale:alternate" content="ar_AR" />
	<meta property="og:locale:alternate" content="zh_CN" />
	<link rel="shortcut icon" href="./images/design/wj_logos/logo_small.png" />
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="lib/leaflet/leaflet.css">
	<link rel="stylesheet" href="lib/chosen/bootstrap-chosen.css">
	<link rel="stylesheet" media="screen" type="text/css" href="./style/design.css" />

	<?php
	if(isset($INCLUDE_MAP_PROPERTIES)) //Properties dedicated to the map
	{
	?>
	<link rel="stylesheet" href="lib/easy-button/easy-button.css" />
	<link rel="stylesheet" href="lib/leafletawesomemarkers/leaflet.awesome-markers.css">
	<link rel="stylesheet" href="lib/lrm/leaflet-routing-machine-3.0.3.css">
	<link rel="stylesheet" href="lib/lrm-valhalla/leaflet.routing.mapzen.css">
	<link rel="stylesheet" href="./style/map.css" />
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

	<nav class="navbar navbar-custom navbar-fixed-top shadowed">
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
						<img alt="Logo WikiJourney" class="logoNavbar <?php if(isset($INCLUDE_MAP_PROPERTIES)) echo "shrink"; else echo "notshrink"; ?>" src="./images/design/wj_logos/logo_small.png"> WikiJourney
					</a>
				</div>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li <?php echo ($nomPage == 'paths.php' ? 'class="active"' : '') ?>><a href="paths.php"><?php echo _YOUR_PATHS;?></a></li>
					<li <?php echo ($nomPage == 'about.php' ? 'class="active"' : '') ?>><a href="about.php"><?php echo _ABOUT ;?></a></li>
					<li <?php echo ($nomPage == 'team.php' ? 'class="active"' : '') ?>><a href="team.php"><?php echo _TEAM ;?></a></li>
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


	
