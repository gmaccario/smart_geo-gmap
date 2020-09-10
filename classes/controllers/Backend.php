<?php

namespace SGGM\Controller\Classes;

use SGGM\General\Classes\Common;

if(!interface_exists('SGGM\Controllers\Classes\iBackend'))
{
    interface iBackend
    {
        public function configuration();
        public function displayTabWelcome();
        public function displayTabSettings();
        public function displayTabFiles();
    }
}

if(!class_exists('\SGGM\Controllers\Classes\Backend'))
{
    /**
     * @name Backend
     * @description Generic class for the Frontend Backend
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class Backend extends Controller implements iBackend
	{
	    /**
		 * @name __construct
		 *
		 * @param Common $common
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return
		 */
	    public function __construct(Common $common)
	    {
	        parent::__construct($common);
	    }

	    /**
	     * @name getHTMLTabs
	     *
	     * @author G.Maccario <g_maccario@hotmail.com>
	     * @return string
	     */
	    protected function getHTMLTabs() : string
	    {
	        $links = '';

	        if( $this->params['pages'] )
	        {
	            foreach( $this->params['pages'] as $page )
	            {
	                if( $page[ 'slug' ] == $this->params['active_page'] )
	                {
	                    $tabs = $page[ 'attributes' ][ 'tabs' ];
	                    foreach( $tabs as $tab )
	                    {
	                        if(empty($links))
	                        {
	                            $active = ( $this->params['active_tab'] == $tab[ 'slug' ] || !$this->params['active_tab'] ) ? 'nav-tab-active' : '';
	                        } else {
	                            $active = ( $this->params['active_tab'] == $tab[ 'slug' ] ) ? 'nav-tab-active' : '';
	                        }

	                        /**
	                         * @todo might be better!
	                         */
	                        $links .= '<a href="?page=' . $page[ "slug" ] . '&tab=' . $tab[ "slug" ] . '" class="nav-tab ' . $active . '">';
	                        $links .= '<span>' . __( $tab[ "name" ], SMART_GEO_GMAP_L10N) . '</span>';
                    		$links .= '</a>';
	                    }
		            }
		        }
		    }

		    return $links;
	    }

		/**
		 * @name configuration
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function configuration()
		{
		    /*
		     * GET VALUES FROM POST
		     * *********************************************
		     */
		    $common = $this->getCommon();

			/*
			 * GET VALUES FROM POST
			 * *********************************************
			 */
			$this->params['action'] = filter_input( INPUT_POST, 'action', FILTER_SANITIZE_STRING );
			$this->params['active_page'] = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
			$this->params['active_tab'] = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );

			$this->params['pages'] = $this->common->getConfig()[ 'features' ][ 'backend' ][ 'pages' ];
			$this->params['tabs'] = $this->getHTMLTabs();

			$delete_geo_json = filter_input( INPUT_POST, 'delete_geo_json', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
			$delete_snazzy_json = filter_input( INPUT_POST, 'delete_snazzy_json', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );

			/*
			 * UPDATE OPTIONS
			 * *********************************************
			 */
			if ( $this->params['action'] != 'update')
			{
			    /*
			     * GET FRESH VALUES FROM DB
			     * *********************************************
			     */
			    if( $this->params['active_tab'] == 'settings' )
			    {
    			    $this->params['value_debug'] = get_option( SMART_GEO_GMAP_OPT_DEBUG );
    			    $this->params['google_api_key'] = get_option( SMART_GEO_GMAP_OPT_GOOGLE_API_KEY );
    			    $this->params['default_zoom'] = get_option( SMART_GEO_GMAP_OPT_DEFAULT_ZOOM );
    			    $this->params['coord_center_1'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_1 );
    			    $this->params['coord_center_2'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_2 );
    			    $this->params['coord_center_3'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_3 );
    			    $this->params['coord_center_1_name'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_1_NAME );
    			    $this->params['coord_center_2_name'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_2_NAME );
    			    $this->params['coord_center_3_name'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_3_NAME );
    			    $this->params['javascript_event_info_windows'] = get_option( SMART_GEO_GMAP_OPT_JAVASCRIPT_EVENT_INFO_WINDOWS );
			    }

			} else {

			    if( $this->params['active_tab'] == 'files' )
			    {
    			    /*
    			     * UPLOAD FILES
    			     * *********************************************
    			     */
    			    if( count( $_FILES ) > 0 )
    			    {
    			        /* UPLOAD MULTIPLE GEO JSON */
    			        if( isset( $_FILES[ 'geojson_file' ] ))
    			        {
    			            $this->params['upload_result_multiple_geojson'] = $common->uploadFiles( SMART_GEO_GMAP_PATH_DATA, $_FILES[ 'geojson_file' ] );
    			        }

    			        /* UPLOAD SINGLE SNAZZY STYLE JSON */
    			        if( isset( $_FILES[ 'snazzymap' ] ))
    			        {
    			            $this->params['upload_result_single_snazzy'] = $common->uploadFile( SMART_GEO_GMAP_PATH_SNAZZY_STYLE, $_FILES[ 'snazzymap' ] );
    			        }
    			    }

    			    /*
    			     * DELETE FILES
    			     * *********************************************
    			     */
    			    if( isset( $delete_geo_json ))
    			    {
    			        foreach( $delete_geo_json as $file_to_delete )
    			        {
    			            $common->deleteFile( SMART_GEO_GMAP_PATH_DATA, $file_to_delete );
    			        }
    			    }

    			    if( isset( $delete_snazzy_json ))
    			    {
    			        foreach( $delete_snazzy_json as $file_to_delete )
    			        {
    			            $common->deleteFile( SMART_GEO_GMAP_PATH_SNAZZY_STYLE, $file_to_delete );
    			        }
    			    }
			    }
			    else {
    				/*
    				 * GET VALUES FROM POST
    				 * *********************************************
    				 */
    			    $this->params['value_debug'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_DEBUG, FILTER_SANITIZE_NUMBER_INT );
    			    $this->params['google_api_key'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_GOOGLE_API_KEY, FILTER_SANITIZE_STRING );
    			    $this->params['default_zoom'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_DEFAULT_ZOOM, FILTER_SANITIZE_STRING );
    			    $this->params['coord_center_1'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_COORD_CENTER_1, FILTER_SANITIZE_STRING );
    			    $this->params['coord_center_2'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_COORD_CENTER_2, FILTER_SANITIZE_STRING );
    			    $this->params['coord_center_3'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_COORD_CENTER_3, FILTER_SANITIZE_STRING );
    			    $this->params['coord_center_1_name'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_COORD_CENTER_1_NAME, FILTER_SANITIZE_STRING );
    			    $this->params['coord_center_2_name'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_COORD_CENTER_2_NAME, FILTER_SANITIZE_STRING );
    			    $this->params['coord_center_3_name'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_COORD_CENTER_3_NAME, FILTER_SANITIZE_STRING );
    			    $this->params['javascript_event_info_windows'] = filter_input( INPUT_POST, SMART_GEO_GMAP_OPT_JAVASCRIPT_EVENT_INFO_WINDOWS, FILTER_SANITIZE_STRING );

    				/*
    				 * UPDATE NEW VALUES
    				 * *********************************************
    				 */
    				update_option( SMART_GEO_GMAP_OPT_DEBUG, $this->params['value_debug'] );
    				update_option( SMART_GEO_GMAP_OPT_GOOGLE_API_KEY, $this->params['google_api_key'] );
    				update_option( SMART_GEO_GMAP_OPT_DEFAULT_ZOOM, $this->params['default_zoom'] );
    				update_option( SMART_GEO_GMAP_OPT_COORD_CENTER_1, $this->params['coord_center_1'] );
    				update_option( SMART_GEO_GMAP_OPT_COORD_CENTER_2, $this->params['coord_center_2'] );
    				update_option( SMART_GEO_GMAP_OPT_COORD_CENTER_3, $this->params['coord_center_3'] );
    				update_option( SMART_GEO_GMAP_OPT_COORD_CENTER_1_NAME, $this->params['coord_center_1_name'] );
    				update_option( SMART_GEO_GMAP_OPT_COORD_CENTER_2_NAME, $this->params['coord_center_2_name'] );
    				update_option( SMART_GEO_GMAP_OPT_COORD_CENTER_3_NAME, $this->params['coord_center_3_name'] );
    				update_option( SMART_GEO_GMAP_OPT_JAVASCRIPT_EVENT_INFO_WINDOWS, $this->params['javascript_event_info_windows'] );
			    }
			}

			/*
			 * GET REFRESHED FILES LIST
			 * *********************************************
			 */
			$this->params['data_urls'] = array_diff( scandir( SMART_GEO_GMAP_PATH_DATA, 1 ), array( '..', '.', '.gitignore' ));
			$this->params['data_snazzy'] = array_diff( scandir( SMART_GEO_GMAP_PATH_SNAZZY_STYLE, 1 ), array( '..', '.', '.gitignore' ));

			$this->params['available_shortcodes'] = $this->common->getConfig()['features']['frontend']['shortcodes'];

			/*
			 * Include Template
			 */
			$this->renderTemplate('configuration');
		}

		/**
		 * @name displayTabWelcome
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function displayTabWelcome()
		{
		    ?>
		    <p><?php echo __( "Smart GEO GMap provides an easy way to integrate a GMap over WordPress Page/Post using an easy Shortcode.", SMART_GEO_GMAP_L10N ); ?></p>
	        <p><?php echo __( "How to", SMART_GEO_GMAP_L10N ); ?>:</p>
        	<ul>
        		<li>
            		<span><?php echo __( "Get your Google API Key here", SMART_GEO_GMAP_L10N ); ?>:</span>
            		<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">
            			<?php echo __( "Google Documentation", SMART_GEO_GMAP_L10N ); ?>
            		</a>
            	</li>
            	<li>
	            	<span><?php echo __( "Open the Settings tab and save the configuration for the map", SMART_GEO_GMAP_L10N ); ?></span>
            	</li>
            	<li>
	            	<span><?php echo __( "Optional: Get a new skin for your map here", SMART_GEO_GMAP_L10N ); ?>:</span>
	            	<a href="https://snazzymaps.com/" target="_blank">
            			<?php echo __( "Snazzy Maps - Free Styles for GMaps", SMART_GEO_GMAP_L10N ); ?>
            		</a>
            	</li>
            	<li>
	            	<span><?php echo __( "Use the Files tab to upload the skin and the GEO files to show on the map.", SMART_GEO_GMAP_L10N ); ?></span>
                <span><?php echo __( "Files will be stored in uploads folder.", SMART_GEO_GMAP_L10N ); ?></span>
            	</li>
        	</ul>

        	<?php if( count( $this->params['available_shortcodes'] ) > 0 ): ?>
            	<div class="shortcodes">
            		<table>
                		<thead>
                    		<tr>
                    			<th colspan="2">
                    				<h3 class=""><?php echo __( "Available Shortcodes", SMART_GEO_GMAP_L10N ); ?></h3>
                    			</th>
                            </tr>
                            <tr>
                                <th><?php echo __( "Shortcode", SMART_GEO_GMAP_L10N ); ?></th>
                                <!-- <th><?php // echo __( "Frontend Method", SMART_GEO_GMAP_L10N ); ?></th> -->
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach($this->params['available_shortcodes'] as $available_shortcode): ?>
                        		<tr>
                        			<?php foreach($available_shortcode as $shortcode => $method): ?>
                                    	<td>[<?php echo $shortcode; ?>]</td>
                                    	<!-- <td><?php //echo $method; ?></td> -->
                                    <?php endforeach; ?>
                                </tr>
            				<?php endforeach; ?>
                        </tbody>
                     </table>
            	</div>
        	<?php
        	endif;
		}

		/**
		 * @name displayTabSettings
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function displayTabSettings()
		{
		    ?>
		    <p><?php echo __( "Prepare your Smart GEO GMap: save your Google API Key, setup your coordinates controls, the starting zoom and the Javascript event to open the infoWindows (tooltips).", SMART_GEO_GMAP_L10N ); ?></p>

        	<div class="api_key">
            	<h3><?php echo __( 'Google API Key', SMART_GEO_GMAP_L10N ); ?></h3>
            	<div>
            		<span><?php echo __( 'API KEY:', SMART_GEO_GMAP_L10N ); ?></span>
            		<input type="text" name="<?php echo SMART_GEO_GMAP_OPT_GOOGLE_API_KEY; ?>" value="<?php echo $this->params['google_api_key']; ?>" size="75">
            	</div>
            </div>

            <div class="coordinates">
            	<h3><?php echo __( 'Coordinates', SMART_GEO_GMAP_L10N ); ?></h3>

            	<span><?php echo __( 'Coordinates center #1', SMART_GEO_GMAP_L10N ); ?></span>
            	<input type="text" name="<?php echo SMART_GEO_GMAP_OPT_COORD_CENTER_1_NAME; ?>" value="<?php echo $this->params['coord_center_1_name']; ?>" size="75" placeholder="Rome" />
            	<input type="text" name="<?php echo SMART_GEO_GMAP_OPT_COORD_CENTER_1; ?>" value="<?php echo $this->params['coord_center_1']; ?>" size="75" placeholder="41.890251, 12.492373" />

            	<div class="clearfix"></div>

            	<span><?php echo __( 'Coordinates center #2', SMART_GEO_GMAP_L10N ); ?></span>
            	<input type="text" name="<?php echo SMART_GEO_GMAP_OPT_COORD_CENTER_2_NAME; ?>" value="<?php echo $this->params['coord_center_2_name']; ?>" size="75" placeholder="Amsterdam" />
            	<input type="text" name="<?php echo SMART_GEO_GMAP_OPT_COORD_CENTER_2; ?>" value="<?php echo $this->params['coord_center_2']; ?>" size="75" placeholder="52.370216, 4.895168" />

            	<div class="clearfix"></div>

            	<span><?php echo __( 'Coordinates center #3', SMART_GEO_GMAP_L10N ); ?></span>
            	<input type="text" name="<?php echo SMART_GEO_GMAP_OPT_COORD_CENTER_3_NAME; ?>" value="<?php echo $this->params['coord_center_3_name']; ?>" size="75" placeholder="New York" />
            	<input type="text" name="<?php echo SMART_GEO_GMAP_OPT_COORD_CENTER_3; ?>" value="<?php echo $this->params['coord_center_3']; ?>" size="75" placeholder="40.730610, -73.935242" />

            	<div class="clearfix"></div>
            </div>

            <div class="zoom">
            	<h3><?php echo __( 'Zoom', SMART_GEO_GMAP_L10N ); ?></h3>
            	<div>
            		<span><?php echo __( 'Default zoom', SMART_GEO_GMAP_L10N ); ?></span>
            		<select id="default_zoom" name="<?php echo SMART_GEO_GMAP_OPT_DEFAULT_ZOOM; ?>">
            			<option value="1" <?php echo ((string)$this->params['default_zoom'] == "1" ) ? 'selected' : ''; ?>><?php echo __('World', SMART_GEO_GMAP_L10N); ?></option>
            			<option value="5" <?php echo ((string)$this->params['default_zoom'] == "5" ) ? 'selected' : ''; ?>><?php echo __('Landmass/continent', SMART_GEO_GMAP_L10N); ?></option>
            			<option value="10" <?php echo ((string)$this->params['default_zoom'] == "10" ) ? 'selected' : ''; ?>><?php echo __('City', SMART_GEO_GMAP_L10N); ?></option>
            			<option value="15" <?php echo ((string)$this->params['default_zoom'] == "15" ) ? 'selected' : ''; ?>><?php echo __('Streets', SMART_GEO_GMAP_L10N); ?></option>
            			<option value="20" <?php echo ((string)$this->params['default_zoom'] == "20" ) ? 'selected' : ''; ?>><?php echo __('Buildings', SMART_GEO_GMAP_L10N); ?></option>
            		</select>
            	</div>
            </div>

            <div class="js_event">
            	<h3><?php echo __( 'Javascript event for Info Windows (tooltip)', SMART_GEO_GMAP_L10N ); ?></h3>
            	<div>
            		<input type="radio" class="javascript_event" value="mouseover" name="<?php echo SMART_GEO_GMAP_OPT_JAVASCRIPT_EVENT_INFO_WINDOWS; ?>" id="javascript_event_mouseover" <?php echo ( $this->params['javascript_event_info_windows'] == 'mouseover' ) ? 'checked="checked"' : ''; ?> />
            		<label for="javascript_event_mouseover" class="radio"><?php echo __( 'Mouseover', SMART_GEO_GMAP_L10N ); ?></label>
            	</div>
            	<div>
            		<input type="radio" class="javascript_event" value="click" name="<?php echo SMART_GEO_GMAP_OPT_JAVASCRIPT_EVENT_INFO_WINDOWS; ?>" id="javascript_event_click" <?php echo ( $this->params['javascript_event_info_windows'] == 'click' || empty( $this->params['javascript_event_info_windows'] ) ) ? 'checked="checked"' : ''; ?> />
            		<label for="javascript_event_click" class="radio"><?php echo __( 'Click', SMART_GEO_GMAP_L10N ); ?></label>
            	</div>
            </div>
		    <?php
		}

		/**
		 * @name displayTabFiles
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function displayTabFiles()
		{
		    ?>
		    	<p><?php echo __( "Upload one Snazzy file in order to apply a new skin to your map. Uploads your GEO JSON files in order to draw your custom shapes on the map. ", SMART_GEO_GMAP_L10N ); ?></p>
		    	<p><span><?php echo __( "Make sure your GEO JSON files are correct otherwise you'll get a Javascript error in your browser console", SMART_GEO_GMAP_L10N ); ?>.</span></p>
        		<p>
        			<span><b><?php echo __( "To delete files", SMART_GEO_GMAP_L10N ); ?>:</b></span>
					<span><b><?php echo __( "Select the files you want to delete, then click Save Changes", SMART_GEO_GMAP_L10N ); ?>.</b></span>
        		</p>

        		<hr />

    		    <div class="snazzy_file">
                	<h3><?php echo __( 'Snazzy Maps', SMART_GEO_GMAP_L10N ); ?></h3>
                	<h4><?php echo __( 'Only json extensions allowed', SMART_GEO_GMAP_L10N ); ?>.</h4>

                	<?php if( count( $this->params['data_snazzy'] ) == 0 ): ?>
                		<div>
                    		<span><?php echo __( "Upload a Snazzy File", SMART_GEO_GMAP_L10N ); ?></span>
                    		<input type="file" id="snazzymap" name="snazzymap" />
                    	</div>

                		<p><?php echo __( "No files uploaded yet.", SMART_GEO_GMAP_L10N ); ?></p>
                	<?php else: ?>
                    	<table>
                    		<thead>
                        		<tr>
                        			<th colspan="3">
                        				<h3 class=""><?php echo __( "Available Snazzy Files", SMART_GEO_GMAP_L10N ); ?></h3>
                        			</th>
                                </tr>
                                <tr>
                                	<th><?php echo __( "#", SMART_GEO_GMAP_L10N ); ?></th>
                                    <th><?php echo __( "Delete", SMART_GEO_GMAP_L10N ); ?></th>
                                    <th><?php echo __( "Filename", SMART_GEO_GMAP_L10N ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $c = 1; ?>
                    			<?php foreach( $this->params['data_snazzy'] as $url ): ?>
                    				<?php if( is_file( SMART_GEO_GMAP_PATH_SNAZZY_STYLE . $url )): ?>
                    					<tr>
                    						<td>
                    							<span><?php echo $c; ?></span>
                    						</td>
                                			<td>
                                				<input type="checkbox" id="delete_snazzy_json" name="delete_snazzy_json[]" value="<?php echo $url; ?>" title="<?php echo __( 'Select to delete', SMART_GEO_GMAP_L10N ); ?>" />
                                			</td>
                    						<td>
                    							<a href="<?php echo SMART_GEO_GMAP_URL . '/snazzy/' . $url ?>" target="_blank">
                    								<?php echo $url; ?>
                    							</a>
                    						</td>
                                        </tr>
                    					<?php $c++; ?>
                    				<?php endif; ?>
                    			<?php endforeach; ?>
                            </tbody>
                         </table>
					<?php endif; ?>
                </div>

                <hr />

                <div class="geo_json_files">
                	<h3><?php echo __( 'Geo Json', SMART_GEO_GMAP_L10N ); ?></h3>
                	<h4><?php echo __( 'Only geojson and json extensions allowed', SMART_GEO_GMAP_L10N ); ?>.</h4>

                	<div>
                		<span><?php echo __("Upload GEOJson files", SMART_GEO_GMAP_L10N ); ?></span>
                		<input type="file" id="geojson_file[]" name="geojson_file[]" multiple="multiple" />
                	</div>

                	<?php if( count( $this->params['data_urls'] ) == 0 ): ?>
                		<p><?php echo __( "No files uploaded yet.", SMART_GEO_GMAP_L10N ); ?></p>
                	<?php else: ?>
                    	<table>
                    		<thead>
                        		<tr>
                        			<th colspan="3">
                        				<h3 class=""><?php echo __( "Available GEO JSON Files", SMART_GEO_GMAP_L10N ); ?></h3>
                        			</th>
                                </tr>
                                <tr>
                                	<th><?php echo __( "#", SMART_GEO_GMAP_L10N ); ?></th>
                                    <th><?php echo __( "Delete", SMART_GEO_GMAP_L10N ); ?></th>
                                    <th><?php echo __( "Filename", SMART_GEO_GMAP_L10N ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $c = 1; ?>
                    			<?php foreach( $this->params['data_urls'] as $url ): ?>
                    				<?php if( is_file( SMART_GEO_GMAP_PATH_DATA . $url )): ?>
                    					<tr>
                    						<td>
                    							<span><?php echo $c; ?></span>
                    						</td>
                                			<td>
                                				<input type="checkbox" id="delete_geo_json" name="delete_geo_json[]" value="<?php echo $url; ?>" title="<?php echo __( 'Select to delete', SMART_GEO_GMAP_L10N ); ?>" />
                                			</td>
                    						<td>
                    							<a href="<?php echo SMART_GEO_GMAP_URL. '/data/' . $url ?>" target="_blank">
                    								<?php echo $url; ?>
                    							</a>
                    						</td>
                                        </tr>
                    					<?php $c++; ?>
                    				<?php endif; ?>
                    			<?php endforeach; ?>
                            </tbody>
                         </table>
					<?php endif; ?>
                </div>
		    <?php
		}
	}
}
