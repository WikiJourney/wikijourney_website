
<?php
//========================================================//
//===============> LANGAGE FILE : GERMAN <===============//
//========================================================//
//===================> Global Content <===================//
//===> Allgemein
define("_TITLE",			"WikiJourney - Entdecke Tourismus.");
define("_CATCHPHRASE",		"Besuchen sie eine Stadt aus Wikipedia!");
define("_SRC_IMAGE_LOGO",	"./images/design/logo_and_catchphrase/en.png");
//===> Top
define("_INDEX",			"Index");
define("_TEAM",				"Team");
define("_ABOUT",			"Über");
define("_BLOG",				"Blog");
//===> Bottom
define("_OUR_PARTNERS",		"Unsere Partner");
define("_FOLLOW_US",		"Folge us!");
//========================> Pages <========================//
//===> index.php
define("_WELCOME_TITLE",	"Willkommen!");
define("_WELCOME_MESSAGE",	"Willkommen zum WikiJourney Project! Entdecken sie ihre unmittelbare Umgebung oder einen Ort ihrer Wahl, mit Informationen von Wikimedia, Wikipedia, Wikivoyage und dem OpenStreetMap Projekt! <br> Bitte füllen sie das Formular aus um zu beginnen. <br> <br>");
define("_BUTTON_POI_AROUND","Finde interessante Orte um mich!");
define("_ADRESS_LOOK_UP",	"Oder geben sie einen Ort ein!");
define("_ADRESS_FAILURE",	"Der eingegebene Ort konnte nicht gefunden werden!");
define("_GEOLOC_FAILURE",	"Entschuldigung, wir konnten ihre Position nicht herausfinden.");
define("_AROUND_LOCATION", 	"In der Nähe eines Ortes!");
define("_AROUND_ME",		"In meiner Umgebung!");
define("_NOTE_GEOLOC",		"<strong>Standordbestimmung gescheitert</strong><br>Abhängig von ihrem Gerät und ihrer Internetverbindung, können wir nicht immer ihren Standort zuverlässig bestimmen. Eventuell, müssen sie der Webseite den Zugriff auf ihren Standort erlauben um die Umgebungssuche nutzen zu können. Alternativ können sie ihre Position auch manuell eingeben.");
define("_NOTE_MAXPOI",      "Hinweis: Aufgrund der Beschränkungen seitens Wikipedia, können wir nicht alle Informationen (beispielsweise Bilder oder Beschreibungen) laden, wenn sie mehr als 50 Orte anzeigen wollen.");
define("_OPTIONS",			"Optionen");
define("_LANGUAGE",         "Sprache zur Suche auswählen");
define("_RANGE",			"Umkreis (km)");
define("_MAX_POI",			"Maximale Anzahl der anzuzeigenden Orte");
define("_PLACEHOLDER",		"Geben sie einen Ort ein.");
define("_LOADING",			"Laden...");
define("_RETRY",            "Bitte nochmals versuchen!");
define("_PATH_CREATED",		"Ihr Pfad wurde erstellt!");
//===> team.php
define("_TEAM_TITLE",		"Unser Team!");
define("_TEAM_WHO_R_WE",	"Wer sind wir?");
define("_TEAM_QUICKDESC",	"Wir sind ein Team aus sieben Studenten von der Ecole Centrale de Lille, eine 'graduate school' in Lille in Nordfrankreich. Wir
							mussten ein interdisziplinäres Projekt in zwei Jahren realisieren, weshalb wie wir begonnen haben zusammen an WikiJourney zu arbeiten.
						  Obwohl das Studentenprojekt offiziell vorüber ist, arbeiten wir mit immernoch daran und verbessern es weiterhin.");
define("_S_ARNOUTS_POSTE", 	"<strong>Project Manager<br/>Lead Developer Web</strong>") ;
define("_P_ARZELIER_POSTE", "Web Developer<br/><br/>");
define("_T_GAUDIN_POSTE", 	"<strong>Lead Developer Android</strong><br/>Sysadmin");
define("_N_HATIM_POSTE", 	"<strong>Schatzmeister</strong><br/>Partnerships");
define("_B_HUBER_POSTE", 	"Partnerschaften<br/><br/>");
define("_J_MAES_POSTE", 	"<strong>Sekretär</strong><br/>Web Developer");
define("_Y_WANG_POSTE", 	"Android Developer<br/><br/>");
//===> about.php
define("_ABOUT_TITLE", 		"Das WikiJourney Projekt");
define("_ABOUT_TEXT","		<p>WikiJourney ist ein Studentenprojekt, dessen Ziel es ist, Nutzer mit Inhalten und Informationen der Wikimediaprojekte zu verbinden.<br/>
              Außerdem haben wir eine App veröffentlicht, welche Touristen interessante Orte zum Besuchen vorschlägt. Einstellungen setzen, Pfad auswählen und los geht's!
							</p>
							<h2>Wieso eine App?</h2>
							<p>
              Es ist einfacher die Welt zu entdecken mit einem Handy als mit einem Computer, was die grundlegende Idee war, das WikiJourney Projekt mobil zu machen.
							<br/We are also working on a feature that will allow you to prepare your trips on your computer, then access them on your smartphone. Data will be viewable thanks to an offline mode.
							</p>
							<h2>Fragen, Vorschläge...?</h2>
							<p>Jede Idee ist willkommen! Trage dazu bei über Git oder schicke uns eine Email an <a href=\"mailto:wikijourneydev@gmail.com\"></a>!<br/>
							Oder <a target=\"_blank\" href=\"https://play.google.com/store/apps/details?id=eu.wikijourney.wikijourney\">teste die App</a> !</p>");
define("_COPYRIGHT",        "Copyright");
define("_COPYRIGHT_INFO",   "All trademarks and logos are the property of their respective owners.");
//===> technical.php
define("_TECHNICAL_TITLE",	"Technische Informationen");
define("_TECHNICAL_TEXT",	"Diese Webseite befindet sich noch im Aufbau, kommen sie später wieder ;)");
//===> map.php
define("_MAP_POI_LINK",				"Auf Wikipedia ansehen");
define("_MAP_CART_LINK",			"Zum Pfad hinzufügen!");
define("_MAP_POI_TYPE_FILE",		"lg/de.txt");
define("_LOOKING_FOR",				"Um einen Ort suchen: ");
define("_SEE_WIKIVOYAGE_GUIDES",	"WikiVoyage Guides");
define("_YOUR_PATH",				"Dein Pfad");
define("_CLEAR_CART",				"Auswahl löschen");
define("_SAVE_CART",				"Auswahl speichern!");
define("_CART_IS_EMPTY_POPUP",		"Es wurde nichts ausgewählt, weshalb nichts exportiert werden konnte ;)");
define("_YOU_ARE_HERE",				"dein Standort!");
define("_CENTER_BUTTON",			"aktuellen Standort zentrieren");
define("_ERROR_API",				"Ein Fehler passierte beim Abrufen der API. Vielleicht ist die Anzahl der zu ladenden Orte zu groß gewählt. <a href=\"index.php\">Zurück und nochmals versuchen!</a>");
define("_LOAD_SIMPLIFIED",			"Probleme mit der Karte? Dann probiere die vereinfachte Version!");
//===> paths.php
define("_CONNECT_NECESS",			"Bitte anmelden, um die Funktion nutzen zu können.");
define("_REGISTRATION",				"Hier klicken um mit einem Wikimedia Account anzumelden!");
define("_YOUR_PATHS",				"Deine Pfade");
define("_LOAD",						"Laden");
define("_REMOVE",					"Löschen");
define("_NO_PATHS_SAVED",			"Keine Pfade gespeichert!");
define("_LOGOUT",					"Abmelden");
//===> map_export.php
define("_PATH_HEADER",				"Es werden mehr Informationen zum Speichern des Pfades benötigt!");
define("_PATH_TITLE",				"Name und Beschreibung eingeben");
define("_PATH_NAME",				"Name:");
define("_PATH_DESC",				"Beschreibung:");
define("_PATH_IMG",					"Wähle ein Bild aus, das gut zum Pfad passt");
define("_PATH_LOGIN",				"Hier klicken um sich mit einem Wikimedia Account zu registrieren!");
