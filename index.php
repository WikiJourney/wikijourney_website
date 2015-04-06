<?php
	include("./include/haut.php");
?>

<h1>Texte d'accueil</h1>

 <p>
        <form name="inscription" method="post" action="map.php">
        Destination (nom du monument) : <input type="text" name="destination"/> <br/>
        <input type="submit" name="valider" value="Faites moi rêver.."/>
        </form>
</p>

<?php
	include("./include/bas.php");
?>