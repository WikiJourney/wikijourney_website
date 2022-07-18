<?php
/*
================== WIKIJOURNEY - team.php =======================
Just a quick presentation of the team.

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
<div class="container" id="first_content">
	<h1><?php echo _TEAM_TITLE; ?></h1>

	<h2><?php echo _TEAM_WHO_R_WE; ?></h2>
	<p>
	<?php echo _TEAM_QUICKDESC; ?>
	</p>

	<h2>Trombinoscope</h2>

	<div class="row">
		<div class="col-sm-3 col-sm-offset-2 trombiElement shadowed">
			<img src="./images/trombi/Unk.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Sylvain Arnouts</span></p>
			<p class="trombiSocial">
				<a target="_blank" title="GitHub" href="https://github.com/sylvainar/"><img src="images/design/external_logos/github-mini.png"/></a>
				<a target="_blank" title="Twitter" href="https://twitter.com/SylvainNouts"><img src="images/design/external_logos/twitter-mini.png"/></a>
			</p>
		</div>
		<div class="col-sm-3 col-sm-offset-2 trombiElement shadowed">
			<img src="./images/trombi/Unk.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Thomas Gaudin</span></p>
			<p class="trombiSocial">
				<a target="_blank" title="GitHub" href="https://github.com/nymous"><img src="images/design/external_logos/github-mini.png"/></a>
				<a target="_blank" title="Twitter" href="https://twitter.com/nymousIO"><img src="images/design/external_logos/twitter-mini.png"/></a>
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3 col-sm-offset-1 trombiElement shadowed">
			<img src="./images/trombi/Unk.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Paul Arzelier</span></p>
		</div>
		<div class="col-sm-3 col-sm-offset-1 trombiElement shadowed">
			<img src="./images/trombi/Unk.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Eliot Maës</span></p>
		</div>
		<div class="col-sm-3 col-sm-offset-1 trombiElement shadowed">
			<img src="./images/trombi/Unk.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Yuzhen Wang</span></p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3 col-sm-offset-2 trombiElement shadowed">
			<img src="./images/trombi/Unk.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Naoufel Hatim</span></p>
		</div>
		<div class="col-sm-3 col-sm-offset-2 trombiElement shadowed">
			<img src="./images/trombi/Unk.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Bastien Huber</span></p>
		</div>
	</div>
</div>

<?php
	include("./include/bas.php");
?>
