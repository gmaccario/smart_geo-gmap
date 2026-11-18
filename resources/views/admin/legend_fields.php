<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php // phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- Included by View::make(): these variables are local to that method, not globals ?>

<?php if ( isset ( $smartgeogmapLegendToggle ) ): ?>
    <input type="checkbox" id="smartgeogmap_legend_toggle" name="smartgeogmap_legend_toggle" <?php checked( (bool) $smartgeogmapLegendToggle ); ?> />
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendPosition ) ): ?>
    <select id="smartgeogmap_legend_position" name="smartgeogmap_legend_position">
        <option value="" <?php selected( $smartgeogmapLegendPosition, '' ); ?>><?php esc_html_e( 'Choose a position', 'smart-geo-gmap' ); ?></option>
        <option value="TOP_CENTER" <?php selected( $smartgeogmapLegendPosition, 'TOP_CENTER' ); ?>><?php esc_html_e( 'Top Center', 'smart-geo-gmap' ); ?></option>
        <option value="TOP_LEFT" <?php selected( $smartgeogmapLegendPosition, 'TOP_LEFT' ); ?>><?php esc_html_e( 'Top Left', 'smart-geo-gmap' ); ?></option>
        <option value="TOP_RIGHT" <?php selected( $smartgeogmapLegendPosition, 'TOP_RIGHT' ); ?>><?php esc_html_e( 'Top Right', 'smart-geo-gmap' ); ?></option>
        <option value="LEFT_TOP" <?php selected( $smartgeogmapLegendPosition, 'LEFT_TOP' ); ?>><?php esc_html_e( 'Left Top', 'smart-geo-gmap' ); ?></option>
        <option value="RIGHT_TOP" <?php selected( $smartgeogmapLegendPosition, 'RIGHT_TOP' ); ?>><?php esc_html_e( 'Right Top', 'smart-geo-gmap' ); ?></option>
        <option value="LEFT_CENTER" <?php selected( $smartgeogmapLegendPosition, 'LEFT_CENTER' ); ?>><?php esc_html_e( 'Left Center', 'smart-geo-gmap' ); ?></option>
        <option value="RIGHT_CENTER" <?php selected( $smartgeogmapLegendPosition, 'RIGHT_CENTER' ); ?>><?php esc_html_e( 'Right Center', 'smart-geo-gmap' ); ?></option>
        <option value="LEFT_BOTTOM" <?php selected( $smartgeogmapLegendPosition, 'LEFT_BOTTOM' ); ?>><?php esc_html_e( 'Left Bottom', 'smart-geo-gmap' ); ?></option>
        <option value="RIGHT_BOTTOM" <?php selected( $smartgeogmapLegendPosition, 'RIGHT_BOTTOM' ); ?>><?php esc_html_e( 'Right Bottom', 'smart-geo-gmap' ); ?></option>
        <option value="BOTTOM_CENTER" <?php selected( $smartgeogmapLegendPosition, 'BOTTOM_CENTER' ); ?>><?php esc_html_e( 'Bottom Center', 'smart-geo-gmap' ); ?></option>
        <option value="BOTTOM_LEFT" <?php selected( $smartgeogmapLegendPosition, 'BOTTOM_LEFT' ); ?>><?php esc_html_e( 'Bottom Left', 'smart-geo-gmap' ); ?></option>
        <option value="BOTTOM_RIGHT" <?php selected( $smartgeogmapLegendPosition, 'BOTTOM_RIGHT' ); ?>><?php esc_html_e( 'Bottom Right', 'smart-geo-gmap' ); ?></option>
    </select>
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendImage1 ) ): ?>
    <?php
        $id = 'smartgeogmap_legend_image_1';
        $name = 'smartgeogmap_legend_image_1';
        $target = $smartgeogmapLegendImage1;

        include( 'include' . DIRECTORY_SEPARATOR . 'select-images-legend.php' );
    ?>
<?php elseif ( isset ( $smartgeogmapLegendLabel1 ) ): ?>
	<input type="text" id="smartgeogmap_legend_label_1" name="smartgeogmap_legend_label_1" value="<?php echo esc_attr( $smartgeogmapLegendLabel1 ); ?>" />
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendImage2 ) ): ?>
	<?php
	$id = 'smartgeogmap_legend_image_2';
	$name = 'smartgeogmap_legend_image_2';
	$target = $smartgeogmapLegendImage2;

	include( 'include' . DIRECTORY_SEPARATOR . 'select-images-legend.php' );
	?>
<?php elseif ( isset ( $smartgeogmapLegendLabel2 ) ): ?>
    <input type="text" id="smartgeogmap_legend_label_2" name="smartgeogmap_legend_label_2" value="<?php echo esc_attr( $smartgeogmapLegendLabel2 ); ?>" />
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendImage3 ) ): ?>
	<?php
	$id = 'smartgeogmap_legend_image_3';
	$name = 'smartgeogmap_legend_image_3';
	$target = $smartgeogmapLegendImage3;

	include( 'include' . DIRECTORY_SEPARATOR . 'select-images-legend.php' );
	?>
<?php elseif ( isset ( $smartgeogmapLegendLabel3 ) ): ?>
    <input type="text" id="smartgeogmap_legend_label_3" name="smartgeogmap_legend_label_3" value="<?php echo esc_attr( $smartgeogmapLegendLabel3 ); ?>" />
<?php endif; ?>
