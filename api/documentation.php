<pre>
			Documentation - WikiJourney API
			
			
This documentation refers to the API of Wikijourney's website.
You can enter a position (latitude and longitude), it will return
the point of interest around, with informations, including POI
type, description, and link to the Wikipedia's page when available.
Since the Alpha 0.0.3 version, this API is also able to look for
WikiVoyage guides around the user's position. 

This API is based on datas from WikiData, and uses the system
of WFLabs to find POI around (thanks btw).

-------------> Versions :

BETA

1.1.0 : Added Cache support. The API is now a lot quicker if POI have already been visited.
1.0.0 : Added thumbnail for POIs. New technology implemented, making the API faster.

ALPHA

0.0.5 : Added the fake error function. 
0.0.4 : Added Nominatim support
0.0.3 : Added WikiVoyage informations.
0.0.2 : Error gestion. More information in the output.
0.0.1 : Creation of the API. Export in JSON.


-------------> INPUT :

Use this link : http://wikijourney.eu/api/api.php?PARAMETERS

Parameters could be (INS is for If Not Specified) :

		- [REQUIRED]	lat : 		user's latitude	
		- [REQUIRED]	long : 		user's longitude
		- [OPTIONNAL]	place :		If you want to do a request with a place name instead of coordinates. Uses OSM nominatim system.
		- [INS 1km ]	range : 	Range around we're gonna find POI in kilometers	
		- [INS 10  ]	maxPOI : 	number max of POI 						
		- [INS en  ] 	lg :		language used 	
		- [INS 0   ] 	wikivoyage :	contact or no WikiVoyage API. Value 0 or 1.
		- [INS 0   ] 	displayImg :	download or no thumbnail adress from WikiVoyage. Value 0 or 1.	
		- [INS 500 ]	thumbnailWidth : maximum width of thumbnails from Wikipedia's article. Value is in px, and has to be numeric.
		- [OPTIONNAL]	fakeError : 	use it if you need to test error on your device. It will simulate an error during the process.
		
Example : 	http://wikijourney.eu/api/api.php?latitude=2&longitude=2&lg=fr
Example :	http://wikijourney.eu/api/api.php?place=Washington&lg=fr

-------------> OUTPUT :

The output is a JSON array. You can obtain it using curl, file_get_contents, wget or whatever.

Structure :
- infos
	- source
	- link
	- api_version
- user_location
	- latitude
	- longitude
- guides ==>  Available only if wikivoyage=1
	- nb_guides
	- guides_info ==> Contains the array with informations on WikiVoyage's guides
		- pageid
		- title
		- sitelink
		- latitude
		- longitude
- poi
	- nb_poi
	- poi_info ==> Contains the array with informations on POIs
		- latitude
		- longitude
		- name
		- sitelink (could be null)
		- image_url (link to thumbnail - could be null)
		- type_name
		- type_id
		- id
- err_check
	- value (true if there's an error)
	- msg (defined only if value is set on true) : contains the error message
	
Example :

{  
   "infos":{  
      "source":"WikiJourney API",
      "link":"http:\/\/wikijourney.eu\/",
      "api_version":"alpha 0.0.2"
   },
   "user_location":{  
      "latitude":50,
      "longitude":2
   },
   "guides":{  
      "nb_guides":1,
      "guides_info":[  
         {  
            "pageid":19684,
            "title":"Lille",
            "sitelink":"https:\/\/en.wikivoyage.org\/wiki\/Lille",
            "latitude":50.6372,
            "longitude":3.0633
         }
      ]
   },
   "poi":{  
      "nb_poi":1,
      "poi_info":[  
         {  
            "latitude":50.007283,
            "longitude":1.997088,
            "name":"Longpre-les-Corps Saints British Cemetery",
			"sitelink":null,
            "type_name":"cemetery",
            "type_id":39614,
            "id":2364019,
			"image_url":null
         }
      ]
   },
   "err_check":{  
      "value":false
   }
}
</pre>