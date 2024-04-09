# SmartGeoGMap Documentation

## Intro
SmartGeoGMap free WordpPress plugin simplifies the process of embedding a Google Map on your WordPress website using GeoJSON for encoding geographic data structures.
SmartGeoGMap is based on [Google Maps Platform](https://developers.google.com/maps/documentation/javascript/get-api-key). Before you start using the Maps JavaScript API, you need a project with a billing account and the Maps JavaScript API enabled before you start using the Maps JavaScript API.

## Get Started with Google Maps Platform
Google Maps Platform products are secured from unauthorized use by restricting API calls to those that provide proper authentication credentials. These credentials are in the form of an API key - a unique alphanumeric string that associates your Google billing account with your project, and with the specific API or SDK.
Follow the steps here [Use API Keys](https://developers.google.com/maps/documentation/javascript/get-api-key) to create, restrict, and use your API Key for Google Maps Platform.

Here the main steps you have to follow:
1. Create API keys
2. Restrict API keys
3. Add the API key to your request

## Plugin Installation
1. Download, install and activate SmartGeoGMap in your WordPress website
2. Open the SmartGeoGMap settings page
3. Fill in the Google API Key in the Welcome tab
4. Optionally, change the other settings and add GEOJson files and/or Snazzy file (read below for additional info about the settings)
5. Save the changes
6. Click the clipboard icon in the Welcome tab in order to copy the available shortcode
7. Paste the copied available shortcode in the post or page you need
8. Open the page or post that contains the shortcode and check how the map is shown
9. Make your changes in the dashboard if needed
10. When everything is OK, don't forget to leave a positive review to the plugin in the [official WordPress directory page](https://wordpress.org/plugins/smart-geo-gmap/)
11. Or just click 5 stars [at the bottom of the page on my website!](https://www.giuseppemaccario.com/wordpress-map-plugin-smart-geo-gmap/)

## Settings documentation
### Welcome tab
* **Google API Key**: Insert here the Google API Key after you follow all the steps here [Use API Keys](https://developers.google.com/maps/documentation/javascript/get-api-key)

### Settings tab
* **Map width**: This changes the width of the rendered map. You can display the map to occupy either half or the full width of the window.
* **Map type**: Choose among four types of maps available within the Maps JavaScript API: Hybrid, Roadmap, Satellite, Terrain.
* **Zoom**: Choose among five zoom options in order to render the map as you want.
* **Javascript event for Info Windows (tooltip)**: If you inject a GeoJSON file, you may want to modify the method for opening tooltips on the map.

### Coordinates tab
* **City #**: Insert a city name to display at the center of the map. Users can click on it to be directed to the city (coordinates are mandatory).
* **Lat/Long #**: In combination with a city name, insert here the latitude and the longitude of the related city.

### Files tab
* **Snazzy file**: Download your favorite skin from [Snazzy Maps](https://snazzymaps.com/) and upload from this setting. The map will then be styled accordingly.
* **GeoJSON files**: Upload a max. of 3 [GEOJson](https://geojson.org/) files in order to encode a variety of geographic data structures. GeoJSON supports the following geometry types: Point, LineString, Polygon, MultiPoint, MultiLineString, and MultiPolygon.

### Legend tab
* **Toggle (Tick for show)**: Tick the checkbox if you want to display the legend with the map. By default, legend is not shown.
* **Position**: Choose where to place for the legend.
* **Icon #**: Choose among a multitude of icons to show inside the legend.
* **Label #**: Insert here a text to display next to the icon.

## Architecture Refactoring
The current version (1.5) of this plugin has undergone a complete refactor, featuring an entirely new architecture. It now embraces a framework-based approach, adopting object-oriented principles akin to a real framework, following the Laravel style.

## Backward compatibility
Due to the architecture refactoring, this version implements a backward compatibility system that converts old option names to the new ones. Additionally, it saves the names of Snazzy and GeoJSON files to the database.

### Contributors
Giuseppe Maccario - [gmaccario](https://www.giuseppemaccario.com/)
