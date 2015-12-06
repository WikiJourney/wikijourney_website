<?php
session_start();

include('./include/haut.php');

$_SESSION['temp_path'] = $_POST['cartJsonExport'];

if(isset($_SESSION['wj_username']))
{
	echo "Vous êtes connecté, on peut enregistrer le parcours, d'après le JSON suivant :<br/>");
	echo $_SESSION['temp_path'];
}

else
{
?>
<a href="./oauth/oauth_connexion?action=authorize">Cliquez ici pour vous connecter avec votre compte WikiMedia !</a>

<?php
}
?>