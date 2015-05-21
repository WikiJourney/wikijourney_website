<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

	<title>Wiki Journey - Revisitez le tourisme.</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" />
	<link rel="Shortcut icon" href="./images/design/favicon.ico" />
	<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
	<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.css' rel='stylesheet' />
	
	<style>
		#map { 
			
			margin: 0;
			padding: 0;
			height: 500px; 
			width: 100%;
			border-collapse: collapse;
			
		}
		#corps p {
			margin: 0;
		}
	</style>
	</head>
	<body>
	
	<div id="banniere">
				<table>
					<tr>
					<td><img  id="logoban" src="./images/design/logo_et_slogan.png" alt="Logo Bannière" /></td>
					</tr>
				</table>
			
			
			<div id="menu">
				<table id="liste_menu.php" style="border-collapse: separate;" >
					<tr>
						<td id="lien_index.php"><a href="index.php">Accueil</a></td>
						<td id="lien_equipe.php"><a href="equipe.php">L'Équipe</a></td>
						<td id="lien_services.php"><a href="services.php">A propos</a></td>
						<td id="lien_contact.php"><a href="contact.php">Contact</a></td>
					</tr>
				</table>
			</div>	
			<?php
			//Coloration en rouge clair de la page active
				$nomPage = $_SERVER['PHP_SELF'];
				$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
				$nomPage = preg_replace($reg, '$2', $nomPage); 
			?>
			<script type="text/javascript">
				document.getElementById("lien_" + "<?php echo $nomPage; ?>").style.cssText = "background-color: rgb(137,160,173);";
			</script>
		
		</div>
		<div id="corps" style="padding: 0; padding-top: 0;">