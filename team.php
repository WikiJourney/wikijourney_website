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
			<img src="./images/trombi/Arn.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Sylvain Arnouts</span><br/><span class="trombiFonc"><?php echo _S_ARNOUTS_POSTE; ?></span></p>
		</div>
		<div class="col-sm-3 col-sm-offset-2 trombiElement shadowed">
			<img src="./images/trombi/Gau.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Thomas Gaudin</span><br/><span class="trombiFonc"><?php echo _T_GAUDIN_POSTE; ?></span></p>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3 col-sm-offset-1 trombiElement shadowed">
			<img src="./images/trombi/Arz.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Paul Arzelier</span><br/><span class="trombiFonc"><?php echo _P_ARZELIER_POSTE; ?></span></p>
		</div>
		<div class="col-sm-3 col-sm-offset-1 trombiElement shadowed">
			<img src="./images/trombi/Mae.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Juliette Maës</span><br/><span class="trombiFonc"><?php echo _J_MAES_POSTE; ?></span></p>
		</div>
		<div class="col-sm-3 col-sm-offset-1 trombiElement shadowed">
			<img src="./images/trombi/Wan.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Yuzhen Wang</span><br/><span class="trombiFonc"><?php echo _Y_WANG_POSTE; ?></span></p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3 col-sm-offset-2 trombiElement shadowed">
			<img src="./images/trombi/Hat.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Naoufel Hatim</span><br/><span class="trombiFonc"><?php echo _N_HATIM_POSTE; ?></span></p>
		</div>
		<div class="col-sm-3 col-sm-offset-2 trombiElement shadowed">
			<img src="./images/trombi/Hub.jpg" alt="Photo" class="img-circle shadowed" />
			<p class="text-center"><span class="trombiNom">Bastien Huber</span><br/><span class="trombiFonc"><?php echo _B_HUBER_POSTE; ?></span></p>
		</div>
	</div>
</div>

<?php
	include("./include/bas.php");
?>
