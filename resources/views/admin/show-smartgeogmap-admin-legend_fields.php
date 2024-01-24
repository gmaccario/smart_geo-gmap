<?php if ( isset ( $smartgeogmapLegendToggle ) ): ?>
    <input type="checkbox" id="smartgeogmap_legend_toggle" name="smartgeogmap_legend_toggle" <?php echo ($smartgeogmapLegendToggle) ? 'checked' : null; ?> />
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendPosition ) ): ?>
    <select id="smartgeogmap_legend_position" name="smartgeogmap_legend_position">
        <option value="" <?php echo ($smartgeogmapLegendPosition === "") ? 'selected' : ''; ?>><?php echo __( 'Choose a position' ); ?></option>
        <option value="TOP_CENTER" <?php echo ($smartgeogmapLegendPosition === "TOP_CENTER") ? 'selected' : ''; ?>><?php echo __( 'Top Center' ); ?></option>
        <option value="TOP_LEFT" <?php echo ($smartgeogmapLegendPosition === "TOP_LEFT") ? 'selected' : ''; ?>><?php echo __( 'Top Left' ); ?></option>
        <option value="TOP_RIGHT" <?php echo ($smartgeogmapLegendPosition === "TOP_RIGHT") ? 'selected' : ''; ?>><?php echo __( 'Top Right' ); ?></option>
        <option value="LEFT_TOP" <?php echo ($smartgeogmapLegendPosition === "LEFT_TOP") ? 'selected' : ''; ?>><?php echo __( 'Left Top' ); ?></option>
        <option value="RIGHT_TOP" <?php echo ($smartgeogmapLegendPosition === "RIGHT_TOP") ? 'selected' : ''; ?>><?php echo __( 'Right Top' ); ?></option>
        <option value="LEFT_CENTER" <?php echo ($smartgeogmapLegendPosition === "LEFT_CENTER") ? 'selected' : ''; ?>><?php echo __( 'Left Center' ); ?></option>
        <option value="RIGHT_CENTER" <?php echo ($smartgeogmapLegendPosition === "RIGHT_CENTER") ? 'selected' : ''; ?>><?php echo __( 'Right Center' ); ?></option>
        <option value="LEFT_BOTTOM" <?php echo ($smartgeogmapLegendPosition === "LEFT_BOTTOM") ? 'selected' : ''; ?>><?php echo __( 'Left Bottom' ); ?></option>
        <option value="RIGHT_BOTTOM" <?php echo ($smartgeogmapLegendPosition === "RIGHT_BOTTOM") ? 'selected' : ''; ?>><?php echo __( 'Right Bottom' ); ?></option>
        <option value="BOTTOM_CENTER" <?php echo ($smartgeogmapLegendPosition === "BOTTOM_CENTER") ? 'selected' : ''; ?>><?php echo __( 'Bottom Center' ); ?></option>
        <option value="BOTTOM_LEFT" <?php echo ($smartgeogmapLegendPosition === "BOTTOM_LEFT") ? 'selected' : ''; ?>><?php echo __( 'Bottom Left' ); ?></option>
        <option value="BOTTOM_RIGHT" <?php echo ($smartgeogmapLegendPosition === "BOTTOM_RIGHT") ? 'selected' : ''; ?>><?php echo __( 'Bottom Right' ); ?></option>
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
	<input type="text" id="smartgeogmap_legend_label_1" name="smartgeogmap_legend_label_1" value="<?php echo $smartgeogmapLegendLabel1; ?>" />
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendImage2 ) ): ?>
	<?php
	$id = 'smartgeogmap_legend_image_2';
	$name = 'smartgeogmap_legend_image_2';
	$target = $smartgeogmapLegendImage2;

	include( 'include' . DIRECTORY_SEPARATOR . 'select-images-legend.php' );
	?>
<?php elseif ( isset ( $smartgeogmapLegendLabel2 ) ): ?>
    <input type="text" id="smartgeogmap_legend_label_2" name="smartgeogmap_legend_label_2" value="<?php echo $smartgeogmapLegendLabel2; ?>" />
<?php endif; ?>

<?php if ( isset ( $smartgeogmapLegendImage3 ) ): ?>
	<?php
	$id = 'smartgeogmap_legend_image_3';
	$name = 'smartgeogmap_legend_image_3';
	$target = $smartgeogmapLegendImage3;

	include( 'include' . DIRECTORY_SEPARATOR . 'select-images-legend.php' );
	?>
<?php elseif ( isset ( $smartgeogmapLegendLabel3 ) ): ?>
    <input type="text" id="smartgeogmap_legend_label_3" name="smartgeogmap_legend_label_3" value="<?php echo $smartgeogmapLegendLabel3; ?>" />
<?php endif; ?>
