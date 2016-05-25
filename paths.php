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
	echo '<div class="container" id="first_content"><p>'._CONNECT_NECESS;
	echo ' <a href="./oauth/oauth_connexion.php?actipx=authorize">'._REGISTRATION.'</a></p></div>';
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
	$query = mysqli_query($handler_db,"SELECT * FROM savedpaths WHERE username='$username'") or die(mysqli_error($handler_db));
	?>

	<div class="container" id="first_content">
		<h1><?php echo _YOUR_PATHS; ?></h1>
		<p class="text-right"><?php echo $username; ?> - <a href="oauth/destroy.php"><?php echo _LOGOUT; ?></a></p>
	
	<?php
	$i = 0;
	while($data = mysqli_fetch_array($query))
	{
		$i ++;
		?>
		<div class="well">
			<div class="row">
				<div class="col-sm-4">
					<p class="paths_title"><?php echo $data['title']; ?></p>
					<img class="thumbnail_paths" src="<?php echo $data['image_url']; ?>" alt="Thumbnail" title="Thumbnail"/>
					<p class="text-center"><em><?php echo $data['mean_lat'].' - '.$data['mean_long']; ?></em></p>
				</div>
				<div class="col-sm-6"><p><?php echo $data['description']; ?></p></div>
				<div class="col-sm-2">
					<a href="map.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-block"><?php echo _LOAD; ?></a>
					<a href="paths.php?action=del&id=<?php echo $data['id']; ?>" class="btn btn-primary btn-block"><?php echo _REMOVE; ?></a>
				</div>
			</div>
		</div>
		<?php
	}

	if($i == 0) echo "<p>"._NO_PATHS_SAVED."</p>";

	echo '</div>';

	include('./include/bas.php');
}
?>