			Documentation - WikiJourney API
			
			
This documentation refers to the API of Wikijourney's website.
You can enter a position (latitude and longitude), it will return
the point of interest around, with informations, including POI
type, description, and link to the Wikipedia's page when available.

This API is based on datas from WikiData, and uses the system
of WFLabs to find POI around (thanks btw).

-------------> Versions :


ALPHA

0.0.2 : Error gestion. More information in the output.
0.0.1 : Creation of the API. Export in JSON.


-------------> INPUT :

Use this link : http://wikijourney.eu/api/api.php?PARAMETERS

Parameters could be (INS is for If Not Specified) :

		- [REQUIRED]	lat : 		user's latitude	
		- [REQUIRED]	long : 		user's longitude
		- [INS 10km]	range : 	Range around we're gonna find POI in kilometers	
		- [INS 10  ]	maxPOI : 	number max of POI 						
		- [INS en  ] 	lg :		language used 							
		
Example : http://wikijourney.eu/api/api.php?latitude=2&longitude=2&lg=fr

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
- poi
	- nb_poi
	- poi_info ==> Contains the array with informations on POIs
		- latitude
		- longitude
		- name
		- sitelink (could be null)
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
            "id":2364019
         }
      ]
   },
   "err_check":{  
      "value":false
   }
}