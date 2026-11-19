# Changelog

All notable changes to Smart GEO GMap are documented here. The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and the plugin uses [Semantic Versioning](https://semver.org/).

The same entries, in WordPress.org format, are in the `== Changelog ==` section of [README.txt](README.txt).

## [Unreleased]

## [1.6.5] - 2026-11-19

### Security

- Every setting is sanitized on save: text fields with `sanitize_text_field()`, choices (width, map type, zoom, info window event, legend position) limited to their allowed values, legend icons to icon names.
- File uploads and deletions verify the settings nonce, and the names of the files to delete are unslashed and sanitized before use.
- The Documentation tab output is filtered with `wp_kses_post()`.

### Added

- Lat/Long fields are validated as `latitude, longitude`: an invalid value is not saved and an error notice explains why.

### Changed

- "Google Key missing" is shown to administrators only, with a hint on where to add the key. Visitors see nothing.
- The map settings are a single `window.smartGeoGMap` object instead of 17 global variables, and the map script is scoped, so it can't clash with the theme or other plugins. The Google Maps callback is now `smartGeoGMapInit` (was `initMap`).
- Text domain is `smart-geo-gmap` (the plugin slug), so the plugin can be translated on translate.wordpress.org. Admin labels, tab names and messages are now translatable.
- WordPress file functions instead of direct PHP calls: `wp_mkdir_p()`, `wp_delete_file()` and `WP_Filesystem` (uninstall). Upload folders are no longer created with `0777` permissions.
- The admin script loads in the footer.
- Plugin name in the header is "Smart GEO GMap", as on WordPress.org.
- `DOC.md` moved to `resources/docs/documentation.md`.
- No more global variables in the main file, the old main file and `uninstall.php`.

### Fixed

- `MapFiles` no longer throws a TypeError when it is created without a logger, as its constructor allows.
- The map no longer breaks when the legend is enabled without a position: it defaults to the top left corner.
- Uninstall also removes the `smartgeogmap_documentation` option.

### Removed

- The `Intl` helper, which prevented strings from being translated.

## [1.6.4] - 2026-11-17

### Fixed

- The Snazzy Maps skin is applied to the map again: the style file URL was passed to Google Maps instead of its styles.
- Map settings with quotes, backslashes or new lines no longer break the map script. All values are now printed with `wp_json_encode()`.
- Uploaded files are found after the site moves to another server or folder: paths are resolved from the file name in the current uploads folder.
- PHP warnings when all GeoJSON files are deleted or a coordinate is malformed.
- Uninstall no longer fails when the upload folders don't exist.
- Ajax actions namespace (`SmartGeoGMap\Actions\Ajax`).

### Changed

- The map scripts and styles load only on pages that use the `[smart_geo_gmap]` shortcode, in the footer.
- The Google Maps API loads with `loading=async`.
- The map settings are added with `wp_add_inline_script()` instead of an inline `<script>` in the template.
- Recenter buttons and legend labels are inserted as text, not HTML.

### Removed

- The unused `lablnet/encryption` dependency.

## [1.6.3] - 2026-11-17

### Added

- "Settings saved" notice, and error notices for rejected uploads (wrong extension, failed upload, invalid JSON).

### Changed

- Tested up to WordPress 7.1. Requires WordPress 6.0 and PHP 8.0.
- Parsedown updated to 1.8.0.
- Shortcode copy button uses the Clipboard API.

### Fixed

- PHP 8.4 deprecations for implicitly nullable parameters.
- Files tab: unclosed checkbox tags and duplicate ids.
- Field labels linked to their inputs.
- Active tab style in the admin panel.
- The Save button is no longer shown on the Documentation tab.

## [1.6.2] - 2024-05-06

### Changed

- Small changes.

## [1.6.1]

### Fixed

- Bug fix.

## [1.6]

### Added

- Documentation tab in the admin panel.
- Button to show the Google API key.

### Changed

- The Google API key field is a password field.
- Admin panel restyling and updated screenshots.

### Fixed

- File links and CSS classes.

## [1.5]

### Added

- Full width or half width (centered) map.
- Map type setting.
- Dynamic legend.

### Changed

- Architecture refactoring, with automatic migration of the settings of previous versions.

[Unreleased]: https://github.com/gmaccario/smart_geo-gmap/compare/1.6.5...HEAD
[1.6.5]: https://github.com/gmaccario/smart_geo-gmap/compare/1.6.4...1.6.5
[1.6.4]: https://github.com/gmaccario/smart_geo-gmap/compare/1.6.3...1.6.4
[1.6.3]: https://github.com/gmaccario/smart_geo-gmap/compare/1.6.2...1.6.3
[1.6.2]: https://github.com/gmaccario/smart_geo-gmap/releases/tag/1.6.2
