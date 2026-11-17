=== Smart GEO GMap ===
Contributors: gmaccario
Donate link: https://www.giuseppemaccario.com/wordpress-map-plugin-smart-geo-gmap/
Tags: google maps, geojson, snazzy maps, markers, map
Requires at least: 6.0
Tested up to: 7.1
Requires PHP: 8.0
Stable tag: 1.6.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Embed a Google Map with a shortcode and draw your own GeoJSON boundaries, shapes, markers and info windows on it. Style it with a Snazzy Maps skin.

== Description ==

Smart GEO GMap adds a Google Map to any page or post with a single shortcode, `[smart_geo_gmap]`, and draws your own geographic data on it.

Upload up to 3 [GeoJSON](https://geojson.org/) files to show boundaries, shapes and markers. Every feature gets an info window (tooltip) with its properties. Give the map a new look with a [Snazzy Maps](https://snazzymaps.com/) skin, add recenter buttons for up to 3 locations and a legend with your own labels.

Everything is configured from the admin panel: no coding needed.

**Live demo:** [Smart GEO GMap live demo](https://www.giuseppemaccario.com/smart-geo-gmap-live-demo/)

= Features =

* One shortcode: `[smart_geo_gmap]`
* Up to 3 GeoJSON files: boundaries, shapes, markers and info windows
* Info windows opened on mouseover or click
* Up to 3 recenter buttons to jump between locations
* One Snazzy Maps skin to style the map
* Map type: roadmap, satellite, hybrid or terrain
* Zoom: world, landmass/continent, city, streets or buildings
* Full width or half width (centered) map
* Legend with icons and labels, placed where you want on the map
* Responsive and full-screen map
* The map scripts load only on pages that show the map

= What you need =

A Google Maps API key with the **Maps JavaScript API** enabled, on a Google Cloud project with billing. Google gives a monthly free usage tier. [How to get an API key](https://developers.google.com/maps/documentation/javascript/get-api-key)

= Source code =

Development happens on GitHub: [github.com/gmaccario/smart_geo-gmap](https://github.com/gmaccario/smart_geo-gmap). Bug reports and pull requests are welcome.

== External services ==

This plugin uses the **Google Maps JavaScript API**, provided by Google, to display the map.

* **What is sent and when:** on pages that contain the `[smart_geo_gmap]` shortcode, the visitor's browser loads the API from `maps.googleapis.com` with your Google API key. Google receives the visitor's IP address and browser information, and the map requests needed to draw the map (for example the area and zoom level being viewed). The URLs of your GeoJSON files are loaded by the visitor's browser from your own site.
* **No data is sent** on pages without the shortcode, or from the admin panel.
* Google Maps Platform Terms of Service: [https://cloud.google.com/maps-platform/terms](https://cloud.google.com/maps-platform/terms)
* Google Privacy Policy: [https://policies.google.com/privacy](https://policies.google.com/privacy)

Snazzy Maps skins are files you download from snazzymaps.com and upload yourself: the plugin doesn't connect to Snazzy Maps.

== Installation ==

1. In your admin area, go to **Plugins → Add New Plugin** and search for **Smart GEO GMap**.
2. Click **Install Now**, then **Activate**.
3. Open **SmartGeoGMap** in the admin menu.
4. In the **Welcome** tab, paste your Google API key and save.
5. Optionally, set the map in the **Settings**, **Coordinates** and **Legend** tabs, and upload your GeoJSON and Snazzy files in the **Files** tab.
6. Add the `[smart_geo_gmap]` shortcode to a page or post.

The **Documentation** tab in the admin panel describes every setting.

== Frequently Asked Questions ==

= The map shows "Sorry! Something went wrong." =

Google rejected the API key. Check that the **Maps JavaScript API** is enabled for the key, that billing is active on the project, and that your site's address is allowed in the key's **Website restrictions** (for example `https://www.example.com/*`). The browser console shows the exact error.

= The map shows "Google Key missing" =

Paste your Google API key in the **Welcome** tab and save. Only administrators see this message: visitors see nothing until the key is set.

= Which files can I upload? =

GeoJSON files (`.json` or `.geojson`, up to 3) and one Snazzy Maps style (`.json`). Files must contain valid JSON. They are stored in `wp-content/uploads/smart-geo-gmap-data/` and `wp-content/uploads/smart-geo-gmap-snazzy/`.

= What is shown in the info windows? =

Every non-empty property of the GeoJSON feature, one per line. Underscores in property names become spaces, so `opening_hours` is shown as "Opening hours".

= My markers are in the wrong place =

GeoJSON coordinates are `[longitude, latitude]`, the opposite order of the **Coordinates** tab, which uses `latitude, longitude` (for example `52.370216, 4.895168`).

= Can I show more than one map on the same page? =

No, one map per page.

= What is removed when I delete the plugin? =

All the plugin settings and the uploaded GeoJSON and Snazzy files.

== Screenshots ==

1. Welcome tab: Google API key and shortcode.
2. Settings tab: map width, type, zoom and info window event.
3. A map with GeoJSON boundaries and markers, and an info window.
4. Coordinates tab: up to 3 recenter locations.
5. Files tab: Snazzy and GeoJSON files.
6. Legend tab: position, icons and labels.

== Changelog ==

= 1.6.5 =
* Security: every setting is sanitized on save.
* Lat/Long fields are validated: an invalid value is not saved and an error notice explains why.
* "Google Key missing" is shown to administrators only.
* The map script no longer defines global variables that could clash with the theme or other plugins.
* The plugin can be translated: text domain is now smart-geo-gmap.

= 1.6.4 - 2026-11-17 =
* Fix: the Snazzy Maps skin is applied to the map again.
* Fix: map settings with quotes, backslashes or new lines no longer break the map.
* Fix: uploaded files are found after the site moves to another server or folder.
* Fix: PHP warnings when all GeoJSON files are deleted or a coordinate is malformed.
* Fix: safer uninstall when the upload folders don't exist.
* Improvement: the map scripts load only on pages that use the shortcode.
* Improvement: the Google Maps API loads asynchronously.
* Remove an unused dependency.

= 1.6.3 - 2026-11-17 =
* Tested up to WordPress 7.1.
* PHP 8.4 compatibility: fix implicitly nullable parameter deprecations.
* Update Parsedown to 1.8.0.
* Admin: show "Settings saved" and upload error notices.
* Admin: fix the Files tab markup, field labels, active tab style and shortcode copy button.

= 1.6.2 - 2024-05-06 =
* Small changes.

= 1.6.1 =
* Bug fix.

= 1.6 =
* Fix file links.
* Admin panel restyling.
* The Google API key field is now a password field, with a button to show it.
* Fix CSS classes.
* Add the Documentation tab in the admin panel.
* Update screenshots.

= 1.5 =
* Architecture refactoring.
* Backward compatibility with the settings of previous versions.
* Full width or half width (centered) map.
* Map type setting.
* Dynamic legend.
* Minor fixes.

== Upgrade Notice ==

= 1.6.5 =
Hardening release: settings are sanitized and validated, and the map script no longer clashes with other scripts.

= 1.6.4 =
Bug fix release: the Snazzy Maps skin works again, and the map scripts load only where the map is used.

= 1.6.3 =
Compatibility release for WordPress 7.1 and PHP 8.4.

= 1.6.2 =
Small changes.

= 1.5 =
New plugin architecture. Your settings are migrated automatically.
