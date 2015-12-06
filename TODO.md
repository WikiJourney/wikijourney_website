TODO
=======

If you're interested in our project, you can help us by implementing some of these functions:

## Global
 - check the English translation
 - translate important text on the website to other languages

### User account
 - integrate Wikipedia OAuth on the website (work in progress, see branch *dev_oauth*)
 - add SSL to the server (using [Let's Encrypt](https://letsencrypt.org/)?)
 - implement a connection module
 - add tracks storage, so that logged in users can retrieve their previous tracks
 - use the Wikipedia collections to store these tracks?

## Map integration
### Filter Points of Interest by type
 - enrich the table by grouping the points into new categories (query types on [wikidata](https://www.wikidata.org/wiki/Wikidata:Main_Page)) and logos on [maki](https://www.mapbox.com/maki/)
 - make the table easier to modify by creating a .txt (or whatever) file
 - filter POIs by importance (weight depending on the size of the monument's Wikipedia page?)
 - create a cursor that allows the user to choose how many pages are displayed (weighted with importance)

### Finish the "cart" function
 - JS function: have the clicked icon change color

### Path creation
 - optimize path (for pedestrians?) (OpenRouteService API)
 - default: path is not displayed

### Offline
 - create a button to export the path as .gpx
 - write the function creating the .gpx

If you contribute, whether it's a big contribution or not, feel free to open a pull request, or send an email explaining the changes you made!
Thank you very much for your contribution to this project :smile: