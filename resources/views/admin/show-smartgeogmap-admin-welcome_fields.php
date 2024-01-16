<?php
// var_dump($snapWizardSecretKey);
// var_dump($args);

// $code = $_GET['code'];
// echo ":::CODE::: " . $code;

// var_dump($instagram);
//
?>

<?php if ( $field === 'description'): ?>
    <span><?php echo __( 'Smart GEO GMap is a WordPress plugin that provides an easy way to integrate a Google Map over WordPress Page/Post using an easy Shortcode. Upload up to 3 GeoJSON files for encoding a variety of geographic data structures and showing and drawing boundaries, shapes, markers and infowindows (tooltips) on the map. Make your map funny: Upload a Snazzy file to stylize the map.' ); ?></span>
<?php elseif ( $field === 'how_to'): ?>
    <ul>
        <li>
            <span><?php echo __( 'Get your Google API Key here:' ); ?></span>
            <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">
                <span><?php echo __( 'Google Documentation' ); ?></span>
            </a>
        </li>
        <li>
            <span><?php echo __( 'Copy the key you get from Google, and paste it below in the Google API Key	input, then click Save changes.' ); ?></span>
        </li>
        <li>
            <span><?php echo __( 'Open the Settings tab, and set up the coordinates, the zoom, and the event for the tooltip.' ); ?></span>
        </li>
        <li>
            <span><?php echo __( 'Use the Files tab to upload the skin and the GEO files to show on the map.' ); ?></span>
            <span><?php echo __( 'Files will be stored in uploads folder.' ); ?></span>
        </li>
        <li>
            <span><?php echo __( 'Optional: Get a new skin for your map here:' ); ?></span>
            <a href="https://snazzymaps.com/" target="_blank">
                <span><?php echo __( 'Snazzy Maps - Free Styles for GMaps' ); ?></span>
            </a>
        </li>
    </ul>
<?php elseif ( isset ( $smartgeogmapGoogleApiKey ) ): ?>
    <input type="text" id="smartgeogmap_google_api_key" name="smartgeogmap_google_api_key" value="<?php echo $smartgeogmapGoogleApiKey; ?>" />
<?php elseif ( $field === 'available_shortcodes'): ?>
    <ul>
        <li>
            <input type="text" id="smartgeogmap_shortcode" disabled value="[smart_geo_gmap]"/>
            <a href="#" target="_blank" class="smartgeogmap_dashicons copy-to-clipboard" title="<?php echo __( 'Copy to clipboard' ); ?>">
                <span class="dashicons dashicons-clipboard" data-inputid="smartgeogmap_shortcode"></span>
            </a>
            <p>
                <a href="https://codex.wordpress.org/shortcode" target="_blank">
                    <span><?php echo __( 'What is a shortcode?' ); ?></span>
                </a>
            </p>
        </li>
    </ul>
<?php endif; ?>




