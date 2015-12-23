<?php
ini_set('display_errors','On');
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


include('./include/connectdb.php');
include('./include/haut.php');

//==> Final case, we have to enter the path in the database
if(0) //TODO
{
	$username = mysqli_real_escape_string($handler_db,$_SESSION['wj_username']);
	$usermail = mysqli_real_escape_string($handler_db,$_SESSION['wj_email']);
	$path = mysqli_real_escape_string($handler_db,$_SESSION['wj_email']);
	echo "Connected, we can save your path with that JSON : <br/>";
	echo $_COOKIE['temp_path'];
	mysqli_query($handler_db,"INSERT INTO savedpaths VALUES ('','$username,'$usermail','Sans titre 1','blablabla','',NOW())");
	echo "Parcours sauvegarde.";
}

//==> Case we have data from form or cookies
if(isset($_POST['cartJsonExport']) OR isset($_COOKIE['temp_path']))
{
	if(isset($_POST['cartJsonExport']))//First, set the path in a cookie. In this way, if the user has to go to Wikimedia to be registered, his path is saved somewhere.
	{
		setcookie("temp_path",$_POST['cartJsonExport'],time()+500);
	}
	
	//==> If he has already a session, we can display the form
	if(isset($_SESSION['wj_username'])) 
	{
		echo "This is the form";
		echo $_COOKIE['temp_path'];
	}
	
	//==> If not, we send him to Wikimedia to register
	else
	{
		?>
		<a href="./oauth/oauth_connexion.php?action=authorize">Click here to register with your Wikimedia account !</a>
		<?php
	}

}
?>

