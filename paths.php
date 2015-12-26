<?php
/*
================== WIKIJOURNEY - PATHS.PHP =======================
Showing user's paths


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

ini_set('display_errors', 'On');
session_start();
include('./include/haut.php');

if(!isset($_SESSION['wj_username']))
{
	echo "<p>You need to be connected to access to this function.";
	echo ' <a href="./oauth/oauth_connexion.php?action=authorize">Click here to register with your Wikimedia account !</a></p>';
}
else if(isset($_GET['action']))
{
	if($_GET['action'] == 'del')
	{
		include('./include/connectdb.php');
		$id = mysqli_real_escape_string($handler_db,$_GET['id']);
		$usermail = mysqli_real_escape_string($handler_db,$_SESSION['wj_email']);
		mysqli_query($handler_db,"DELETE FROM savedpaths WHERE usermail='$usermail' AND id='$id'");
		header('Location:paths.php');
	}
}
else
{
	include('./include/connectdb.php');
	
	$username = mysqli_real_escape_string($handler_db,$_SESSION['wj_username']);
	$usermail = mysqli_real_escape_string($handler_db,$_SESSION['wj_email']);
	echo '<p>Connected as '.$usermail.'. <a href="oauth/destroy.php">Log Out</a></p>';
	$query = mysqli_query($handler_db,"SELECT * FROM savedpaths WHERE usermail='$usermail'") or die(mysqli_error($handler_db));
	
	echo '<h1>Your paths</h1>';
	
	
	echo '<p><table id="paths">';
	$i = 0;
	while($data = mysqli_fetch_array($query))
	{
		$i ++;
		echo '<tr>';
		echo '<td><p class="paths_title">'.$data['title'].'</p><img class="thumbnail_paths" src="'.$data['image_url'].'" alt="Thumbnail" title="Thumbnail"/></td>';
		echo '<td><p>Latitude<br/>'.$data['mean_lat'].'</p><br/><p>Longitude<br/>'.$data['mean_long'].'</p>';
		echo '<td>'.$data['description'].'</td>';
		echo '<td><a href="map.php?id='.$data['id'].'">Load</a></td>';
		echo '<td><a href="paths.php?action=del&id='.$data['id'].'">Remove</a></td>';
		echo '</tr>';
	}
	
	echo '</table></p>';
	
	if($i == 0) echo "<p>No paths saved.</p>";
	
	include('./include/bas.php');
}
?>