<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if ( isset ( $smartgeogmapLegendToggle ) ): ?>
    <input type="checkbox" id="smartgeogmap_legend_toggle" name="smartgeogmap_legend_toggle" <?php ($smartgeogmapLegendToggle) ? esc_html_e('checked') : null; ?> />
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendPosition ) ): ?>
    <select id="smartgeogmap_legend_position" name="smartgeogmap_legend_position">
        <option value="" <?php ($smartgeogmapLegendPosition === "") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Choose a position' ); ?></option>
        <option value="TOP_CENTER" <?php ($smartgeogmapLegendPosition === "TOP_CENTER") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Top Center' ); ?></option>
        <option value="TOP_LEFT" <?php ($smartgeogmapLegendPosition === "TOP_LEFT") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Top Left' ); ?></option>
        <option value="TOP_RIGHT" <?php ($smartgeogmapLegendPosition === "TOP_RIGHT") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Top Right' ); ?></option>
        <option value="LEFT_TOP" <?php ($smartgeogmapLegendPosition === "LEFT_TOP") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Left Top' ); ?></option>
        <option value="RIGHT_TOP" <?php ($smartgeogmapLegendPosition === "RIGHT_TOP") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Right Top' ); ?></option>
        <option value="LEFT_CENTER" <?php ($smartgeogmapLegendPosition === "LEFT_CENTER") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Left Center' ); ?></option>
        <option value="RIGHT_CENTER" <?php ($smartgeogmapLegendPosition === "RIGHT_CENTER") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Right Center' ); ?></option>
        <option value="LEFT_BOTTOM" <?php ($smartgeogmapLegendPosition === "LEFT_BOTTOM") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Left Bottom' ); ?></option>
        <option value="RIGHT_BOTTOM" <?php ($smartgeogmapLegendPosition === "RIGHT_BOTTOM") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Right Bottom' ); ?></option>
        <option value="BOTTOM_CENTER" <?php ($smartgeogmapLegendPosition === "BOTTOM_CENTER") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Bottom Center' ); ?></option>
        <option value="BOTTOM_LEFT" <?php ($smartgeogmapLegendPosition === "BOTTOM_LEFT") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Bottom Left' ); ?></option>
        <option value="BOTTOM_RIGHT" <?php ($smartgeogmapLegendPosition === "BOTTOM_RIGHT") ? esc_attr_e('selected') : esc_attr_e(''); ?>><?php esc_html_e( 'Bottom Right' ); ?></option>
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
	<input type="text" id="smartgeogmap_legend_label_1" name="smartgeogmap_legend_label_1" value="<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e($smartgeogmapLegendLabel1); ?>" />
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendImage2 ) ): ?>
	<?php
	$id = 'smartgeogmap_legend_image_2';
	$name = 'smartgeogmap_legend_image_2';
	$target = $smartgeogmapLegendImage2;

	include( 'include' . DIRECTORY_SEPARATOR . 'select-images-legend.php' );
	?>
<?php elseif ( isset ( $smartgeogmapLegendLabel2 ) ): ?>
    <input type="text" id="smartgeogmap_legend_label_2" name="smartgeogmap_legend_label_2" value="<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e($smartgeogmapLegendLabel2); ?>" />
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendImage3 ) ): ?>
	<?php
	$id = 'smartgeogmap_legend_image_3';
	$name = 'smartgeogmap_legend_image_3';
	$target = $smartgeogmapLegendImage3;

	include( 'include' . DIRECTORY_SEPARATOR . 'select-images-legend.php' );
	?>
<?php elseif ( isset ( $smartgeogmapLegendLabel3 ) ): ?>
    <input type="text" id="smartgeogmap_legend_label_3" name="smartgeogmap_legend_label_3" value="<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e($smartgeogmapLegendLabel3); ?>" />
<?php endif; ?>
