<?php
//========================================================//
//============> FICHIER DE LANGUE : FRANCAIS <============//
//========================================================//


//===================> Global Content <===================//

//===> General

define("_TITLE",			"WikiJourney - Revisitez le tourisme.");
define("_CATCHPHRASE",		"Faites du tourisme avec Wikipédia&#8239;!");
define("_SRC_IMAGE_LOGO",	"./images/design/logo_and_catchphrase/fr.png");
//===> Top
define("_INDEX",			"Accueil");
define("_TEAM",				"Équipe");
define("_ABOUT",			"À propos");
define("_BLOG",				"Blog");

//===> Bottom
define("_OUR_PARTNERS",		"En collaboration avec :");
define("_FOLLOW_US",		"Suivez le projet !");

//========================> Pages <========================//

//===> index.php
define("_WELCOME_TITLE",	"Bienvenue !");
define("_WELCOME_MESSAGE",	"Bonjour et bienvenue sur le site du projet WikiJourney ! Nous vous proposons d'explorer vos environs, ou bien un lieu que vous choisirez, grâce à des données libres ! Les informations viennent de Wikipédia, de Wikidata et de WikiVoyage, et les cartes d'OpenStreetMaps !<br> Pour commencer, remplissez simplement ce formulaire. ");
define("_BUTTON_POI_AROUND","Trouver des points d'intérêts autour de moi !");
define("_ADRESS_LOOK_UP",	"Ou à proximité d'une adresse !");
define("_ADRESS_FAILURE",	"Cette adresse n'existe pas !");
define("_GEOLOC_FAILURE",	"Désolé, mais il est impossible de vous géolocaliser.");
define("_AROUND_LOCATION", 	"Autour d'une adresse particulière");
define("_AROUND_ME",		"Autour de ma position !");
define("_NOTE_GEOLOC",		"<strong>Géolocalisation impossible</strong><br/>Il n'est pas toujours
							possible de récupérer votre position, cela dépend de votre navigateur et de
							votre connexion internet. Vous devez également autoriser WikiJourney à accéder à votre position.");
define("_NOTE_MAXPOI",      "Note : au dessus de 50 points d'intérêts, vous ne pourrez pas afficher les
                            images et les informations des points les plus éloignés. Ceci est dû à une
                            restriction des serveurs Wikimédia.");
define("_OPTIONS",			"Options :");
define("_RANGE",			"Rayon (km) : ");
define("_MAX_POI",			"Maximum :");
define("_PLACEHOLDER",		"Entrez un lieu ici.");
define("_LOADING",			"Chargement...");
define("_RETRY",            "Réessayer !");
define("_LANGUAGE",         "Langue ");
define("_PATH_CREATED",		"Votre parcours a bien été créé !");

//===> team.php
define("_TEAM_TITLE",		"Notre Équipe");
define("_TEAM_WHO_R_WE",	"Qui sommes nous ?");
define("_TEAM_QUICKDESC",	"Nous sommes une équipe de sept étudiants de l'École Centrale de Lille, école d'ingénieur généraliste située à Lille,
							dans le Nord de la France. Durant nos deux premières années d'études, nous devons développer un projet
							multidisciplinaire, dans lequel nous mettons nos connaissances en commun. Même si ce projet est officiellement terminé dans le cadre de 
							l'école, une partie de l'équipe continue aujourd'hui à le maintenir." );
define("_S_ARNOUTS_POSTE", 	"<strong>Chef de Projet<br/>Lead Développeur Web</strong>") ;
define("_P_ARZELIER_POSTE", "Développeur Web<br/><br/>");
define("_T_GAUDIN_POSTE", 	"<strong>Lead Développeur Androïd</strong><br/>Administrateur Serveur");
define("_N_HATIM_POSTE", 	"<strong>Trésorier</strong><br/>Partenariats");
define("_B_HUBER_POSTE", 	"Partenariats<br/><br/>");
define("_J_MAES_POSTE", 	"<strong>Gestion de Projet</strong><br/>Développeur Web");
define("_Y_WANG_POSTE", 	"Développeur Androïd<br/><br/>");

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
							Si vous utilisiez déjà l’application <a href=\"http://wiki-geolocalisation.wix.com/wanderwiki\">WanderWiki</a>, vous ne serez pas désorientés : WikiJourney reprend le projet. WanderWiki revient, avec une nouvelle charte graphique et de nouvelles fonctionnalités !
							</p>

							<h2>Des questions, des propositions ? </h2>
							<p>
							Nous sommes ouverts à toute piste d’amélioration ! Contribuez au projet <a href=\"mailto:wikijourneydev@gmail.com\">en nous contactant par mail</a> ou en codant directement vos propositions sur notre Git !<br/>
							Ou devenez <a target=\"_blank\" href=\"https://play.google.com/store/apps/details?id=eu.wikijourney.wikijourney\">testeur de l'application</a> !
							</p>");


//===> technical.php
define("_TECHNICAL_TITLE",	"Informations Techniques");
define("_TECHNICAL_TEXT",	"Vous trouverez toutes les informations techniques relatives au projets en suivant ces liens : ");


//===> map.php
define("_MAP_POI_LINK",				"Voir sur Wikipédia");
define("_MAP_CART_LINK",			"Ajouter au parcours !");
define("_MAP_POI_TYPE_FILE",		"lg/fr.txt");
define("_LOOKING_FOR",				"Recherche des points d'intérêt à proximité : ");
define("_SEE_WIKIVOYAGE_GUIDES",	"Guides WikiVoyage");
define("_YOUR_PATH",				"Votre Parcours");
define("_CLEAR_CART",				"Vider");
define("_SAVE_CART",				"Sauvegarder !");
define("_CART_IS_EMPTY_POPUP",		"Votre parcours est vide, remplissez le avant de l\'exporter ! ;)");
define("_YOU_ARE_HERE",				"Vous êtes ici !");
define("_CENTER_BUTTON",			"Centrer la carte");
define("_ERROR_API",				"Erreur : l'API n'a pas répondu à temps. Peut-être que vous avez demandé un trop grand nombre de points d'intérêt. <a href=\"index.php\">Rééssayez !</a>");
define("_LOAD_SIMPLIFIED",			"La carte ne s'affiche pas ? Essayez la version simplifiée !");

//===> paths.php
define("_CONNECT_NECESS",			"Pour récupérer vos parcours, vous devez vous connecter :");
define("_REGISTRATION",				"Cliquez ici pour utiliser votre compte Wikimedia !");
define("_YOUR_PATHS",				"Parcours");
define("_LOAD",						"Charger");
define("_REMOVE",					"Supprimer");
define("_NO_PATHS_SAVED",			"Pas de parcours sauvegardés.");
define("_LOGOUT",					"Se déconnecter");

//===> map_export.php
define("_PATH_HEADER",				"Quelques données sont nécessaires à la création de votre parcours :");
define("_PATH_TITLE",				"Donnez un nom et une description :");
define("_PATH_NAME",				"Nom :");
define("_PATH_DESC",				"Description:");
define("_PATH_IMG",					"Choisissez une image :");
define("_PATH_LOGIN",				"Cliquez ici pour utiliser votre compte Wikimedia");

