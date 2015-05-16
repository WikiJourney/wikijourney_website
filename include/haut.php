<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
	<head>

	<title>Wiki Journey - Revisitez le tourisme.</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" />
	<!-- <link rel="Shortcut icon" href="./images/design/favicon.ico" /> -->
	

	
	</head>
	<body>
	
	<div id="banniere">
				<table>
					<tr>
					<td><img  id="logoban" src="./images/logo_et_slogan.png" alt="Logo Bannière" /></td>
					</tr>
				</table>
			
			
			<div id="menu">
				<table id="liste_menu.php" style="border-collapse: separate;" >
					<tr>
						<td id="lien_index.php"><a href="index.php">Accueil</a></td>
						<td id="lien_equipe.php"><a href="equipe.php">L'Équipe</a></td>
						<td id="lien_services.php"><a href="services.php">A propos</a></td>
						<td id="lien_contact.php"><a href="technical.php">Informations Techniques</a></td>
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
		<div id="corps">