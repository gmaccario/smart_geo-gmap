<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if ( $field === 'description'): ?>
    <span><?php esc_html_e( 'Smart GEO GMap is a WordPress plugin that provides an easy way to integrate a Google Map over WordPress Page/Post using an easy Shortcode. Upload up to 3 GeoJSON files for encoding a variety of geographic data structures and showing and drawing boundaries, shapes, markers and infowindows (tooltips) on the map. Make your map funny: Upload a Snazzy file to stylize the map.', 'smart-geo-gmap' ); ?></span>
<?php elseif ( $field === 'how_to'): ?>
    <ul>
        <li>
            <span><?php esc_html_e( 'Get your Google API Key here:', 'smart-geo-gmap' ); ?></span>
            <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">
                <span><?php esc_html_e( 'Google Documentation', 'smart-geo-gmap' ); ?></span>
            </a>
        </li>
        <li>
            <span><?php esc_html_e( 'Copy the key you get from Google, and paste it below in the Google API Key	input, then click Save changes.', 'smart-geo-gmap' ); ?></span>
        </li>
        <li>
            <span><?php esc_html_e( 'Open the Settings tab, and set up the coordinates, the zoom, and the event for the tooltip.', 'smart-geo-gmap' ); ?></span>
        </li>
        <li>
            <span><?php esc_html_e( 'Use the Files tab to upload the skin and the GEO files to show on the map.', 'smart-geo-gmap' ); ?></span>
            <span><?php esc_html_e( 'Files will be stored in uploads folder.', 'smart-geo-gmap' ); ?></span>
        </li>
        <li>
            <span><?php esc_html_e( 'Optional: Get a new skin for your map here:', 'smart-geo-gmap' ); ?></span>
            <a href="https://snazzymaps.com/" target="_blank">
                <span><?php esc_html_e( 'Snazzy Maps - Free Styles for GMaps', 'smart-geo-gmap' ); ?></span>
            </a>
        </li>
    </ul>
<?php elseif ( isset ( $smartgeogmapGoogleApiKey ) ): ?>
    <input type="password" id="smartgeogmap_google_api_key" name="smartgeogmap_google_api_key" value="<?php echo esc_attr( $smartgeogmapGoogleApiKey ); ?>" />
    <button type="button" class="button-link smartgeogmap_dashicons show-google_key" data-inputid="smartgeogmap_google_api_key"
            title="<?php esc_attr_e( 'Show Google Key', 'smart-geo-gmap' ); ?>" aria-label="<?php esc_attr_e( 'Show Google Key', 'smart-geo-gmap' ); ?>">
        <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
    </button>
<?php elseif ( $field === 'available_shortcodes'): ?>
    <ul>
        <li>
            <input type="text" id="smartgeogmap_shortcode" disabled value="[<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SHORTCODE ); ?>]"/>
            <button type="button" class="button-link smartgeogmap_dashicons copy-to-clipboard" data-inputid="smartgeogmap_shortcode"
                    title="<?php esc_attr_e( 'Copy to clipboard', 'smart-geo-gmap' ); ?>" aria-label="<?php esc_attr_e( 'Copy to clipboard', 'smart-geo-gmap' ); ?>">
                <span class="dashicons dashicons-clipboard" aria-hidden="true"></span>
            </button>
            <p>
                <a href="https://codex.wordpress.org/shortcode" target="_blank">
                    <span><?php esc_html_e( 'What is a shortcode?', 'smart-geo-gmap' ); ?></span>
                </a>
            </p>
        </li>
    </ul>
<?php endif; ?>




