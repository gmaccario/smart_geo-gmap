<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if( empty( $smartgeogmapGoogleApiKey )): ?>

    <div id="smart-geo-gmap-error">
        <p><?php esc_html_e( 'Google Key missing' ); ?>.</p>
    </div>

<?php else: ?>

    <?php if ( $smartgeogmapDefaultWidth === 'full_width' ): ?>
        <style>.smart-geo-gmap-wrapper{max-width:100%!important;}</style>
    <?php endif; ?>

    <?php // The map settings are printed as JS variables by SmartGeoGMapFrontend::getScriptData() ?>
    <div class="smart-geo-gmap-wrapper">
        <div id="smart-geo-gmap"></div>
        <?php if ($legend['smartgeogmapLegendToggle'] === 'on'): ?>
            <div id="legend">
                <h3><?php esc_html_e( 'Legend' ); ?></h3>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>
