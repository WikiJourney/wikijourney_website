<?php
	/*
================== WIKIJOURNEY - About.PHP =======================
A quick discription of group


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
	include("./include/haut.php");	
?>

<h1><?php echo _ABOUT_TITLE; ?></h1>

<?php echo _ABOUT_TEXT; ?>

<h2><?php echo _TECHNICAL_TITLE; ?></h2>

<p><?php echo _TECHNICAL_TEXT; ?></p>
<p>Wiki : <a href="https://github.com/WikiJourney/wikijourney_website/wiki" title="Wiki">GitHub</a></p>
<p>Blog : <a href="http://blog.wikijourney.eu" title="Blog">Blog</a></p>

<h2><?php echo _TEAM_TITLE; ?></h2>
<p><a href="team.php"><?php echo _TEAM_WHO_R_WE; ?></a></p>

<h2>Copyrights</h2>

<p>Photo by <a href="https://www.flickr.com/photos/hailemichaelfiseha/6956440746">Fiseha Hailemichael</a><br/>
All trademarks and logos are the property of their respective owners.</p>
<?php
	include("./include/bas.php");
?>
