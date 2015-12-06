<?php

/*
================== WIKIJOURNEY - MAP_EXPORT.PHP =======================
To process the datas from the routing


Source : https://github.com/WikiJourney/wikijourney_website
Copyright 2015 WikiJourney
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at
    http://www.apache.org/licenses/LICENSE-2.0
Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

session_start();

include('./include/haut.php');

$_SESSION['temp_path'] = $_POST['cartJsonExport'];

if(isset($_SESSION['wj_username']))
{
	echo "Vous �tes connect�, on peut enregistrer le parcours, d'apr�s le JSON suivant :<br/>");
	echo $_SESSION['temp_path'];
}

else
{
?>
<a href="./oauth/oauth_connexion?action=authorize">Cliquez ici pour vous connecter avec votre compte WikiMedia !</a>

<?php
}
?>

