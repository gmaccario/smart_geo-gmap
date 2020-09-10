<div class="smart_geo_gmap wrap">

	<div class="intro">
		<h1><?php echo __( SMART_GEO_GMAP_NAME, SMART_GEO_GMAP_L10N); ?></h1>
		
		<hr />
		
		<hr class="wp-header-end">
	</div>
	
	<!-- wordpress provides the styling for tabs. -->
	<h2 class="nav-tab-wrapper">
		<?php echo $tabs; ?>
	</h2>
	
	<?php if( 'update' == $action ): ?>
		<div id="message" class="updated">
			<p><?php echo __( "Settings saved", SMART_GEO_GMAP_L10N ); ?></p>
		</div>
	<?php endif; ?>
	
	<form name="form" class="form" method="post" action="" enctype="multipart/form-data"> <?php /* WARNING: using options.php in action attribute causes a problem with passing values parameters */ ?>
		
		<?php settings_fields( SMART_GEO_GMAP_OPT_SETTINGS_FIELDS ); ?>
		
		<?php 
			switch( $active_tab )
			{
			    case 'settings':
			        do_settings_sections( 'settings' );
			        
			        submit_button();
			        
			        break;
			    case 'files':
			        do_settings_sections( 'files' );
			        
			        submit_button();
			        
			        break;
			    /**
			     *  @todo add here more cases
			     *  
			     *  */

				default:
				    do_settings_sections( 'welcome' );
				    
				    break;
			}
		?>
	</form>
</div>

<hr />

<p>
	<span class="dashicons dashicons-wordpress"> </span>
	<span><?php echo __( "Author", 'smart_geo_gmap' ); ?>:</span>
	<a href="https://www.giuseppemaccario.com/" target="_blank">Giuseppe Maccario</a>
</p>