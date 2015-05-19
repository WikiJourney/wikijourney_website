<?php
	include("./include/haut.php");
	
if(isset($_GET['lg']))
{
		if($_GET['lg'] == 'fr')
		{
?>

<h1>Qu’est-ce que Wikijourney ?</h1>

<p>Wikijourney est un projet étudiant visant à mettre en lien un utilisateur et le contenu informatif de Wikipedia, via sa position dans une ville.
<br> Concrètement, nous souhaitons coder une application qui proposerait au touriste des points d’intérêts à visiter. Rentrez vos préférences, choisissez un itinéraire et c’est parti !
</p>

<h2>Pourquoi une application ? </h2>
<p>
Tout simplement parce qu’il s’agit du moyen technologique le plus portatif. Grâce aux forfaits 3G, il est plus simple de jeter un coup d’oeil à son portable pour obtenir des informations, un itinéraire, que de transporter avec soi son ordinateur !
<br>Nous proposerons également de préparer son parcours à l’avance, via un module web ainsi qu’un mode hors-ligne.
</p>

<h2>WanderWiki revient ! </h2>
<p>
Si vous utilisiez déjà l’application <a href="http://wiki-geolocalisation.wix.com/wanderwiki">WanderWiki</a>, vous ne serez pas désorientés : WikiJourney reprend le projet. Wanderwiki revient, avec une nouvelle charte graphique et de nouvelles fonctionnalités !
</p>

<h2>Des questions, des propositions ? </h2>
<p>
Nous sommes ouverts à toute piste d’amélioration ! Contribue au projet <a href="mailto:wikijourneydev@gmail.com">en nous contactant par mail</a> ou en codant directement tes propositions sur notre Git !
</p>
<?php
		}
}

else{
?>

<h1>Tell me more about WikiJourney ?</h1>
<p>It's a student project, which was made to connect an user and Wikimedia contents, linked by its position in a city.<br/>
We are trying to release a mobile app which will recommend to tourists some interesting points of interest to visit. Adjust your settings, chose a path, and let's go !
</p>
<h2>Why an application ?</h2>
<p>
Because it's the more portative way, and the simplest when we talk about tourism. When you're walking in a city, you'd rather take a quick look at your phone than using your laptop, aren't you ?
<br/>It will also be possible to prepare his trip before, on a computer. Data will be viewable thanks to an offline mode.
</p>
<h2>WanderWiki is back ! </h2>
<p>
You already knew about <a href="http://wiki-geolocalisation.wix.com/wanderwiki">WanderWiki</a> ? Great ! WikiJourney is the pursuit of this project. We are trying to make
it more powerful, with new functionalities.</p>

<h2>Questions, Proposals ..?</h2>
<p>We are listening to anyone ! Contribute on our Git, or <a href="mailto:wikijourneydev@gmail.com">send us a mail</a> !</p>



<?php
}
	include("./include/bas.php");
?>