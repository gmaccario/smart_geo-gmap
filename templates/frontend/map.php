<?php if( empty( $google_api_key )): ?>

    <div class="smart-geo-gmap-wrapper">
    	<div id="smart-geo-gmap-error">
	    	<p><?php echo __( 'Google Key missing,', SMART_GEO_GMAP_L10N ); ?>.</p>
    	</div>
    </div>
    
<?php else: ?>

    <div class="smart-geo-gmap-wrapper">
    	<div id="smart-geo-gmap"></div>
    </div>

    <script type="text/javascript">
    
    	<?php 
    	   /**
    	    * 
    	    * @note
    	    * Use this part to create all the PHP-values-based needed js variables for the frontend.
    	    * 
    	    * @todo Replace this bunch of variables with an object.
    	    * 
    	    */
    	?>
    
    	var map;
    
    	var markers = [];
    	
    	var default_zoom = <?php echo (!empty( $default_zoom )) ? $default_zoom : 10; ?>;
    
    	var coord_center_1 = { 
    		lat: '<?php echo $coordinates['coord_center_1']['lat']; ?>', 
    		lng: '<?php echo $coordinates['coord_center_1']['lng']; ?>' 
    	};
    	var coord_center_2 = { 
    		lat: '<?php echo $coordinates['coord_center_2']['lat']; ?>', 
    		lng: '<?php echo $coordinates['coord_center_2']['lng']; ?>' 
    	};
    	var coord_center_3 = { 
    		lat: '<?php echo $coordinates['coord_center_3']['lat']; ?>', 
    		lng: '<?php echo $coordinates['coord_center_3']['lng']; ?>' 
    	};
    
        var custom_centers = [ 
    		{ "label": "<?php echo __( $coord_center_1_name, SMART_GEO_GMAP_L10N ); ?>", "coord_center": coord_center_1 },
    		{ "label": "<?php echo __( $coord_center_2_name, SMART_GEO_GMAP_L10N ); ?>", "coord_center": coord_center_2 },
    		{ "label": "<?php echo __( $coord_center_3_name, SMART_GEO_GMAP_L10N ); ?>", "coord_center": coord_center_3 }
    	];
    	
    	var snazzyStyleJson = <?php echo (!empty($snazzyStyleJson)) ? $snazzyStyleJson : "[]"; ?>;
    	
    	var js_evt_info_windows = "<?php echo ( $javascript_event_info_windows != '' ) ? $javascript_event_info_windows : 'mouseover'; ?>";
    	
    	var sz_recenter_control = '<?php echo __( 'Click to recenter the map', SMART_GEO_GMAP_L10N ); ?>';
    	
    	var geojson_files = [];
    	<?php foreach( $data_urls as $url ): ?>
    		<?php if( is_file( SMART_GEO_GMAP_PATH_DATA . $url )): ?>
    			geojson_files.push( <?php echo json_encode( SMART_GEO_GMAP_URL. '/data/' . $url ); ?> );
    		<?php endif; ?>
    	<?php endforeach; ?>
    </script>
<?php endif; ?>