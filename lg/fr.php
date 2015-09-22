<?php
//========================================================//
//============> FICHIER DE LANGUE : FRANCAIS <============//
//========================================================//


//===================> Global Content <===================//

//===> General

define("_TITLE",			"Wiki Journey - Revisitez le tourisme.");
define("_SRC_IMAGE_LOGO",	"./images/design/logo_and_catchphrase/fr.png");
//===> Top
define("_INDEX",			"Accueil");
define("_TEAM",				"L'Équipe");
define("_ABOUT",			"À propos");
define("_TECHNICAL",		"Informations Techniques");

//===> Bottom
define("_OUR_PARTNERS",		"Nos partenaires");
define("_NO_PARTNERS_LOL",	"Pas de partenaires pour l'instant. Un partenariat vous intéresse ? Contactez nous !");
define("_FOLLOW_US",		"Suivez le projet !");

//========================> Pages <========================//

//===> index.php
define("_WELCOME_TITLE",	"Bienvenue !");
define("_WELCOME_MESSAGE",	"Bonjour et bienvenue sur le site du projet WikiJourney ! Nous vous proposons d'explorer vos environs, ou bien un lieu que vous choisirez, grâce à des données libres ! <br> Pour commencer, remplissez simplement ce formulaire. <br> <br>");
define("_BUTTON_POI_AROUND","Trouver des points d'intérêts autour de moi !");
define("_ADRESS_LOOK_UP",	"Ou à proximité d'une adresse !");
define("_ADRESS_FAILURE",	"Cette adresse n'existe pas !");
define("_GEOLOC_FAILURE",	"Désolé, mais il est impossible de vous géolocaliser.");
define("_AROUND_LOCATION", 	"Autour d'une adresse particulière");
define("_AROUND_ME",		"Autour de ma position !");
define("_NOTE_GEOLOC",		"Note : cette fonctionnalité utilise la géolocalisation. Il n'est pas toujours
							possible de récupérer votre position, cela dépend de votre navigateur et de
							votre connexion internet.");
define("_OPTIONS",			"Options :");
define("_RANGE",			"Rayon (km) : ");
define("_MAX_POI",			"Maximum :");
define("_PLACEHOLDER",		"Entrez un lieu ici.");
define("_LOADING",			"Chargement...");

//===> team.php
define("_TEAM_TITLE",		"Notre Équipe");
define("_TEAM_WHO_R_WE",	"Qui sommes nous ?");
define("_TEAM_QUICKDESC",	"Nous sommes une équipe de sept étudiants de l'École Centrale de Lille, école d'ingénieur généraliste située à Lille,
							dans le Nord de la France. Durant nos deux premières années d'études, nous devons développer un projet
							multidisciplinaire, dans lequel nous mettons nos connaissances en commun. Nous nous sommes donc retrouvés à sept 
							sur ce projet." );
define("_S_ARNOUTS_DESC",	"J'ai rejoint le projet WikiJourney car je suis vraiment intéressé par la programmation et le développement informatique. Ce projet est pour moi l'occasion de mettre mes compétences de programmation au profit d'un réel projet, qui de plus se place dans le cadre du logiciel libre." );
define("_S_ARNOUTS_POSTE", 	"Chef de Projet<br/>Développement Web") ;
define("_P_ARZELIER_DESC",	"Je suis dans ce groupe projet de par ma passion pour l'informatique; mon domaine de prédilection est l'administration de serveurs sous Linux et le développement en C, mais néanmoins capable de coder en utilisant des technologies web. En outre, le développement du tourisme dans les pays émergents ainsi que l'explosion des nouvelles technologies est un terreau fertile pour l'innovation dans ce domaine, assez peu exploré jusqu'à maintenant." );
define("_P_ARZELIER_POSTE", "Serveur<br/>Développement Web");
define("_T_GAUDIN_DESC",	"Le projet Wikijourney m'a attiré à la fois par à sa dominante informatique (développement Web et Android), et par son côté communautaire. En effet, je suis depuis longtemps un adepte des logiciels libres, et j'aimerais contribuer à mon tour au monde du Libre en participant à un projet novateur, liant tourisme et informatique, deux domaines rarement combinés." );
define("_T_GAUDIN_POSTE", 	"Développement Java<br/>Développement Serveur");
define("_N_HATIM_DESC",		"Interessé par l'informatique et l'aide à la décision, j'ai rejoint le projet WikiJourney pour m'initier à ces sujets et participer à un projet libre qui m'offrira sans doute une expérience unique et fort profitable." );
define("_N_HATIM_POSTE", 	"Trésorier - Partenariats<br/>Développement Java");
define("_B_HUBER_DESC",		"Après des années d’une formation très généraliste, je souhaitais m’intégrer à un projet concret, avec une forte emphase sur les NTIC. WikiJourney apparaissait alors comme Le projet à rejoindre pour développer mes compétences, d’autant plus qu’il répond à une problématique me touchant vraiment en tant qu’étudiant : donner un accès rapide à une information de qualité à des personnes cherchant à explorer le monde, et les guider dans leurs découvertes." );
define("_B_HUBER_POSTE", 	"Partenariats<br/>Développement Web");
define("_J_MAES_DESC",		"Depuis toujours intéressée par l’informatique, j’ai rejoint WikiJourney pour développer mes connaissances et surtout participer à un projet au concept primordial. Visitant de nouvelles villes plusieurs fois par an, j’ai pu remarquer que les guides touristiques ne sont pas toujours pratiques. Les informations sont librement disponibles sur internet, mais pas facilement accessibles aux touristes." );
define("_J_MAES_POSTE", 	"Secrétaire<br/>Développement Web");
define("_Y_WANG_DESC",		"Je connais bien les langages C et C++, et j'ai appris les langages CSS et HTML en autodidacte. Je m'intéresse à ce projet parce que c'est une bonne idée de combiner les cartes numériques avec les informations fournies par Wikipédia. De plus, le projet correspond bien à mes compétences." );
define("_Y_WANG_POSTE", 	"Développement Java");

//===> about.php
define("_ABOUT_TITLE", 		"Qu’est-ce que Wikijourney ?");
define("_ABOUT_TEXT","		
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
							Si vous utilisiez déjà l’application <a href=\"http://wiki-geolocalisation.wix.com/wanderwiki\">WanderWiki</a>, vous ne serez pas désorientés : WikiJourney reprend le projet. Wanderwiki revient, avec une nouvelle charte graphique et de nouvelles fonctionnalités !
							</p>

							<h2>Des questions, des propositions ? </h2>
							<p>
							Nous sommes ouverts à toute piste d’amélioration ! Contribuez au projet <a href=\"mailto:wikijourneydev@gmail.com\">en nous contactant par mail</a> ou en codant directement vos propositions sur notre Git !
							</p>");
							
							
//===> technical.php
define("_TECHNICAL_TITLE",	"Informations Techniques");
define("_TECHNICAL_TEXT",	"Ce site web est encore en construction, merci de revenir plus tard ! ;)");


//===> map.php
define("_MAP_POI_LINK",				"Lien Wikipédia");

define("_MAP_POI_TYPE_FILE",		"lg/fr.txt");
define("_LOOKING_FOR",				"Recherche des points d'intérêt à proximité : ");
define("_SEE_WIKIVOYAGE_GUIDES",	"Consultez les guides WikiVoyage autour de vous !");
define("_YOUR_PATH",				"Votre Parcours");
define("_CLEAR_CART",				"Vider");
define("_SAVE_CART",				"Sauvegarder !");
define("_CART_IS_EMPTY_POPUP",		"Votre parcours est vide, remplissez le avant de l\'exporter ! ;)");
define("_YOU_ARE_HERE",				"Vous êtes ici !");
define("_CENTER_BUTTON",			"Centrer la carte");



