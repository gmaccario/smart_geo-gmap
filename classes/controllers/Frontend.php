<?php

namespace SGGM\Controller\Classes;

use SGGM\General\Classes\Common;

if(!interface_exists('SGGM\Controllers\Classes\iFrontend'))
{
    interface iFrontend
    {
        public function showSmartGEOGoogleMap() : string;
        public function echo_foo();
    }
}

if(!class_exists('\SGGM\Controllers\Classes\Frontend'))
{
    /**
     * @name Frontend
     * @description Generic class for the Frontend controller
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class Frontend extends Controller implements iFrontend
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
		 * showSmartGEOGoogleMap
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 *
		 * Show Smart GEO GMap
		 *
		 * The return value of a shortcode handler function is inserted into the post content output in place of the shortcode macro.
		 * Remember to use return and not echo - anything that is echoed will be output to the browser, but it won't appear
		 * in the correct place on the page.
		 *
		 * @return string
		 *
		 */
		public function showSmartGEOGoogleMap() : string
		{
		    $this->params['snazzyStyleJson'] = '';
		    
		    $this->params['data_urls'] = array_diff( scandir(SMART_GEO_GMAP_PATH_DATA, 1 ), array( '..', '.', '.gitignore' ));
		    $this->params['data_snazzy'] = array_diff( scandir(SMART_GEO_GMAP_PATH_SNAZZY_STYLE, 1 ), array( '..', '.', '.gitignore' ));
		    
		    $this->params['google_api_key'] = get_option( SMART_GEO_GMAP_OPT_GOOGLE_API_KEY );
		    $this->params['default_zoom'] = get_option( SMART_GEO_GMAP_OPT_DEFAULT_ZOOM );
		    $this->params['coord_center_1'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_1 );
		    $this->params['coord_center_2'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_2 );
		    $this->params['coord_center_3'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_3 );
		    $this->params['coord_center_1_name'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_1_NAME ) ? get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_1_NAME ) : 'Rome';
		    $this->params['coord_center_2_name'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_2_NAME );
		    $this->params['coord_center_3_name'] = get_option( SMART_GEO_GMAP_OPT_COORD_CENTER_3_NAME );
		    $this->params['javascript_event_info_windows'] = get_option( SMART_GEO_GMAP_OPT_JAVASCRIPT_EVENT_INFO_WINDOWS );
		    
		    $this->params['coordinates'] = array();
		    
		    /* Rome as default first center */
		    $this->params['coordinates'][ 'coord_center_1'] = array(
		        'lat' => ($this->params['coord_center_1']) ? explode(',', $this->params['coord_center_1'])[0] : '41.890251',
		        'lng' => ($this->params['coord_center_1']) ? explode(',', $this->params['coord_center_1'])[1] : '12.492373'
		    );
		    
		    $this->params['coordinates'][ 'coord_center_2'] = array(
		        'lat' => ($this->params['coord_center_2']) ? explode(',', $this->params['coord_center_2'])[0] : '0,0',
		        'lng' => ($this->params['coord_center_2']) ? explode(',', $this->params['coord_center_2'])[1] : '0,0'
		    );
		    
		    $this->params['coordinates'][ 'coord_center_3'] = array(
		        'lat' => ($this->params['coord_center_3']) ? explode(',', $this->params['coord_center_3'])[0] : '0,0',
		        'lng' => ($this->params['coord_center_3']) ? explode(',', $this->params['coord_center_3'])[1] : '0,0'
		    );
		    
		    if(count($this->params['data_snazzy']) > 0)
		    {
		        $snazzy = $this->params['data_snazzy'][0];
		        
		        if( is_file( SMART_GEO_GMAP_PATH_SNAZZY_STYLE . $snazzy ))
		        {
		            $this->params['snazzyStyleJson'] = file_get_contents( SMART_GEO_GMAP_PATH_SNAZZY_STYLE . $snazzy );
		        }
		    }
		    
		    /* @note Use "return" if this is the result of a shortcode */
		    return $this->common->renderView($this, 'map', $this->params);
		}
		
		/**
		 * echo_foo
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 *
		 * @return void
		 *
		 */
		public function echo_foo()
		{
		    wp_send_json( array( 'results' => array( 'success' => 'Congratulations! It\'s working!' ) ));
		    
		    wp_die();
		}
	}
}