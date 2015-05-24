<?php include("./lg/fr.php");?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

	<title><?php echo _TITLE; ?></title>
	<meta charset="UTF-8">
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" />
	<link rel="Shortcut icon" href="./images/design/favicon.ico" />
	<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
	<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.css' rel='stylesheet' />

	</head>
	<body>
	
	<div id="banniere">
				<table>
					<tr>
					<td><img  id="logoban" src="<?php echo _SRC_IMAGE_LOGO; ?>" alt="Logo" /></td>
					</tr>
				</table>
			
			
			<div id="menu">
				<table id="liste_menu.php" style="border-collapse: separate;" >
					<tr>
						<td id="lien_index.php"><a href="index.php"><?php echo _INDEX ;?></a></td>
						<td id="lien_team.php"><a href="team.php"><?php echo _TEAM ;?></a></td>
						<td id="lien_about.php"><a href="about.php"><?php echo _ABOUT ;?></a></td>
						<td id="lien_contact.php"><a href="technical.php"><?php echo _TECHNICAL ;?></a></td>
					</tr>
				</table>
			</div>	
			<?php
			//Colorating the active page
				$nomPage = $_SERVER['PHP_SELF'];
				$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
				$nomPage = preg_replace($reg, '$2', $nomPage); 
			?>
			<script type="text/javascript">
				document.getElementById("lien_" + "<?php echo $nomPage; ?>").style.cssText = "background-color: rgb(137,160,173);";
			</script>
		
		</div>
		<div id="corps" style="padding: 0; padding-top: 0;">
