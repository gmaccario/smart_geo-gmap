# Smart GEO GMap

[![WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/smart-geo-gmap)](https://wordpress.org/plugins/smart-geo-gmap/)
[![WordPress Tested](https://img.shields.io/wordpress/plugin/tested/smart-geo-gmap)](https://wordpress.org/plugins/smart-geo-gmap/)
[![PHP](https://img.shields.io/badge/php-%3E%3D8.0-777bb4)](https://www.php.net/)
[![License: GPL v2](https://img.shields.io/badge/license-GPLv2-blue)](LICENSE)

A WordPress plugin that embeds a Google Map in any page or post with a single shortcode, and draws your own geographic data on it from **GeoJSON** files: boundaries, shapes, markers and info windows. Style the map with a **Snazzy Maps** skin and add a legend.

- **WordPress.org:** [wordpress.org/plugins/smart-geo-gmap](https://wordpress.org/plugins/smart-geo-gmap/)
- **Live demo:** [giuseppemaccario.com/smart-geo-gmap-live-demo](https://www.giuseppemaccario.com/smart-geo-gmap-live-demo/)
- **Plugin page:** [giuseppemaccario.com/wordpress-map-plugin-smart-geo-gmap](https://www.giuseppemaccario.com/wordpress-map-plugin-smart-geo-gmap/)

## Features

- No coding needed: everything is configured from the admin panel
- Up to 3 GeoJSON files: boundaries, shapes, markers and info windows (tooltips)
- Info windows opened on mouseover or click
- 3 recenter controls to jump between locations
- One Snazzy Maps skin to style the map
- Map type (roadmap, satellite, hybrid, terrain), zoom level and full or half width
- Legend with icons and labels, positioned where you want
- Responsive and full-screen map
- Scripts load only on pages that show the map

## Requirements

| | Version |
|---|---|
| WordPress | 6.0 or later (tested up to 7.1) |
| PHP | 8.0 or later (tested on 8.4) |
| Google Maps | An API key with the **Maps JavaScript API** enabled, on a project with billing |

## Installation

### From WordPress.org

1. In your admin area, go to **Plugins → Add New** and search for **Smart GEO GMap**.
2. Click **Install**, then **Activate**.

### From this repository

The `vendor/` folder isn't committed, so install the dependencies before activating:

```sh
cd wp-content/plugins
git clone https://github.com/gmaccario/smart_geo-gmap.git smart-geo-gmap
cd smart-geo-gmap
composer install --no-dev --optimize-autoloader
```

The folder must be named `smart-geo-gmap`.

## Getting started

1. [Create a Google Maps API key](https://developers.google.com/maps/documentation/javascript/get-api-key) and restrict it to your domain.
2. Open **SmartGeoGMap** in the admin menu, paste the key in the **Welcome** tab and save.
3. Optionally set the map width, type, zoom and tooltip event in **Settings**, the recenter locations in **Coordinates**, your files in **Files** and the legend in **Legend**.
4. Add the shortcode to a page or post:

   ```
   [smart_geo_gmap]
   ```

The **Documentation** tab in the admin panel describes every setting.

## Screenshots

| Map with GeoJSON boundaries, markers and an info window | Welcome tab |
|---|---|
| ![Map](https://ps.w.org/smart-geo-gmap/assets/screenshot-3.png) | ![Welcome tab](https://ps.w.org/smart-geo-gmap/assets/screenshot-1.png) |

More screenshots on the [WordPress.org page](https://wordpress.org/plugins/smart-geo-gmap/#screenshots).

## Settings

| Tab | Setting | Description |
|---|---|---|
| Welcome | Google API Key | Required. The map isn't shown without it. |
| Settings | Map width | Full width, or half width and centered. |
| | Map type | Roadmap, Satellite, Hybrid or Terrain. |
| | Zoom | World, Landmass/continent, City, Streets or Buildings. |
| | Info window event | Open tooltips on mouseover or click. |
| Coordinates | City / Lat,Long 1–3 | Up to 3 recenter buttons. Location 1 is also the map's initial center. Use the format `52.370216, 4.895168`. |
| Files | Snazzy file | A `.json` style downloaded from [Snazzy Maps](https://snazzymaps.com/). |
| | GeoJSON files | Up to 3 `.json` / `.geojson` files. |
| Legend | Toggle, position, icons, labels | Up to 3 legend entries. |

Uploaded files are stored in `wp-content/uploads/smart-geo-gmap-data/` and `wp-content/uploads/smart-geo-gmap-snazzy/`.

### GeoJSON tips

[GeoJSON](https://geojson.org/) supports `Point`, `LineString`, `Polygon`, `MultiPoint`, `MultiLineString` and `MultiPolygon`. Every non-empty property of a feature is listed in its info window, with underscores turned into spaces:

```json
{
  "type": "FeatureCollection",
  "features": [
    {
      "type": "Feature",
      "geometry": { "type": "Point", "coordinates": [4.895168, 52.370216] },
      "properties": { "name": "Amsterdam", "opening_hours": "9:00 - 18:00" }
    }
  ]
}
```

GeoJSON coordinates are `[longitude, latitude]`, the opposite order of the Coordinates tab.

## Troubleshooting

| Symptom | Cause and fix |
|---|---|
| "Sorry! Something went wrong." on the map | Google rejected the key. Enable the Maps JavaScript API and billing, and add your site to the key's **Website restrictions** (e.g. `http://localhost/*` for local development). The browser console shows the exact error. |
| "Google Key missing" | Save the API key in the Welcome tab. |
| Markers in the wrong place | GeoJSON uses `[lng, lat]`; the Coordinates tab uses `lat, lng`. |
| Upload rejected | Only `.json` / `.geojson` files with valid JSON are accepted. The notice at the top of the page says why. |

## Privacy and external services

On pages with the shortcode, the visitor's browser loads the Google Maps JavaScript API from `maps.googleapis.com`, so Google receives the visitor's IP address and map requests. See the [Google Maps Platform Terms](https://cloud.google.com/maps-platform/terms) and the [Google Privacy Policy](https://policies.google.com/privacy). Nothing is loaded on other pages, and the plugin doesn't connect to Snazzy Maps.

## Development

```
smart-geo-gmap/
├── smart-geo-gmap.php      # Plugin bootstrap
├── smart_geo_gmap.php      # Old main file, kept to migrate installs from < 1.5
├── uninstall.php           # Removes options and uploaded files
├── app/                    # PSR-4: SmartGeoGMap\
│   ├── Dispatcher.php      # Registers admin, ajax or public hooks
│   ├── Actions/            # Admin settings, public scripts
│   ├── Filters/            # Plugin action links
│   ├── Shortcodes/         # [smart_geo_gmap]
│   ├── Helpers/            # Settings fields, file uploads, views, logger
│   └── Services/           # Backward compatibility (option migration)
└── resources/views/        # admin/ and public/ templates and assets
```

```sh
composer install                                              # dependencies
find . -name '*.php' -not -path './vendor/*' -exec php -l {} \;  # lint
```

With `WP_DEBUG` enabled, the plugin writes upload and file operations to the PHP error log and the map script logs to the browser console.

### Releasing

1. Bump `Version` in `smart-geo-gmap.php` and `Stable tag` in `README.txt`. Move the `[Unreleased]` entries in `CHANGELOG.md` to the new version, and add the same entries to the `== Changelog ==` and `== Upgrade Notice ==` sections of `README.txt`.
2. Run `composer install --no-dev --optimize-autoloader`.
3. Copy the plugin to the WordPress.org SVN `trunk` **including `vendor/`** and excluding `.git`, `.gitignore`, `.gitattributes`, `.DS_Store`, `README.md` and `CHANGELOG.md`.
4. Tag the release in SVN and in git (tags without a `v`, e.g. `1.6.4`), and create the GitHub release with the changelog entry as notes.

## Changelog

See [CHANGELOG.md](CHANGELOG.md).

### 1.6.4 (2026-11-17)

- Fix: the Snazzy Maps skin is applied to the map again.
- Fix: map settings with quotes, backslashes or new lines no longer break the map.
- Fix: uploaded files are found after the site moves to another server or folder.
- The map scripts load only on pages that use the shortcode.

## License

[GPLv2 or later](LICENSE). Created by [Giuseppe Maccario](https://www.giuseppemaccario.com).
