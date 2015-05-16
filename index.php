<?php
	include("./include/haut.php");
?>

<h1>Bienvenue !</h1>

 <p>
        <form name="inscription" method="post" action="map.php">
        Destination (nom du monument) : <input type="text" name="name"/>
        <input type="submit" name="valider" value="Go !"/>
        </form>
</p>

<?php
	include("./include/bas.php");
?>