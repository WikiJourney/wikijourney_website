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
if(isset($_POST['path'])) 
{
	$username = mysqli_real_escape_string($handler_db,$_SESSION['wj_username']);
	$usermail = mysqli_real_escape_string($handler_db,$_SESSION['wj_email']);
	$path = mysqli_real_escape_string($handler_db,$_COOKIE['temp_path']);
	$title = mysqli_real_escape_string($handler_db,$_POST['title']);
	$desc = mysqli_real_escape_string($handler_db,$_POST['desc']);
	
	$query = "INSERT INTO savedpaths VALUES('','$username','$usermail','$title','$desc','$path',NOW())";
	
	mysqli_query($handler_db,$query) or die(mysqli_error($handler_db));
	
	header("Location:index.php?message=confirm");
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
		?>
		<h2>To save your path, please give it a name and description</h2>

		<form action="" method="POST">
			<label for="title">Title :</label><input type="text" id="title" name="title" required /><br/>
			<label for="desc">Description :</label><input type="text" id="desc" name="desc" required /><br/>
			<input type="hidden" value="<?php echo $_COOKIE['temp_path']; ?>" name="path" /><br/>
			<input type="submit" value="Go!" />
		</form>
		
		<?php
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

