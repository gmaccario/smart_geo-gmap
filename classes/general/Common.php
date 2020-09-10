<?php

namespace SGGM\General\Classes;

use SGGM\Controller\Classes\iController;

if(!interface_exists('SGGM\General\Classes\iCommon'))
{
    interface iCommon
    {
        public function getConfig() : array;
        public function printMyLastQuery() : string;
        public function checkDependencies() : bool;
        public function getNameClass(Basic $object) : string;
        public function renderView(iController $controller, string $view, array $params) : string;
        public function getConstant(string $sz_supposed_constant = '') : string;
        public function uploadFile(string $dir = '', array $f = []) : bool;
        public function uploadFiles(string $dir = '', array $f = []) : bool;
        public function deleteFile( string $path = '', string $fileName = '', array $restrictions = array( 'geojson', 'json' ) ) : bool;
        public function errorNoticeDependency();
    }
}

if(!class_exists('\General\Classes\Common'))
{
    /**
     * @name Common
     * @description Common Controllers behaviour
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
	class Common implements iCommon
	{
		protected $debug = false;
		protected $missing_dependency = '';

		private $config = null;

		/**
		 * __construct
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return
		 */
		public function __construct()
		{

		}

		/**
		 * prepare
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return bool
		 */
		public function prepare() : bool
		{
		    return $this->setDebug() && $this->setConfig();
		}

    /**
		 * prepareFolders
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return bool
		 */
		public function prepareFolders() : bool
		{
      $folders = array(
        SMART_GEO_GMAP_PATH_DATA,
        SMART_GEO_GMAP_PATH_SNAZZY_STYLE
      );
      
      foreach($folders as $folder)
      {
        if( !file_exists( $folder ))
        {
          wp_mkdir_p( $folder );
        }
      }

      return true;
    }

		/**
		 * setDebug
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return bool
		 */
		protected function setDebug() : bool
		{
		    if( empty($this->debug) && function_exists( 'get_option' ))
		    {
		        $this->debug = ( get_option( SMART_GEO_GMAP_OPT_DEBUG ) ) ? get_option( SMART_GEO_GMAP_OPT_DEBUG ) : false;

		        return true;
		    }

		    return false;
		}

		/**
		 * setConfig
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return bool
		 */
		protected function setConfig() : bool
		{
		    $path = SMART_GEO_GMAP_DIR_PATH . 'config' . DIRECTORY_SEPARATOR . 'config.php';

		    if( empty( $this->config ) && file_exists( $path ))
		    {
		        $this->config = include( $path );

		        return true;
		    }

		    return false;
		}

		/**
		 * @name getConfig
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return array
		 */
		public function getConfig() : array
		{
		    return $this->config;
		}

		/**
		 * @name printMyLastQuery
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function printMyLastQuery() : string
		{
			global $wpdb;

			return $wpdb->last_query;
		}

		/**
		 * @name checkDependencies
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return bool
		 */
		public function checkDependencies() : bool
		{
		    // @todo
		    //register_activation_hook( __FILE__, array( 'testPlugin', 'activate' ));
		    //add_action( 'activate_plugin', '_20170113_superess_activate', 10, 2 );

		    /*
		     * @note Check dependencies from the config
		     */
		    if ($this->isValidDependency())
		    {
		        return true;
		    }

		    try {
		        if(!function_exists('deactivate_plugins'))
		        {
		            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		        }

		        deactivate_plugins( SMART_GEO_GMAP_BASENAME );
		    }
		    catch ( \Error $e ) {
		        echo $e->getMessage();
		    }

		    \add_action('admin_notices', array($this, 'errorNoticeDependency'));

		    return false;
		}

		/**
		 * @name renderView
		 *
		 * @param iController $controller
		 * @param string $view
		 * @param array $params
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function renderView(iController $controller, string $view, array $params) : string
		{
			/* Extract attributes/values of the object to convert them into single variables */
			extract($params);

			switch( $this->getNameClass( $controller ))
			{
				case 'Backend':
				    $filename =  SMART_GEO_GMAP_DIR_PATH . 'templates' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . $view . '.php';
				    if( file_exists( $filename ))
				    {
				        include( $filename );
				    }
					break;
				case 'Frontend':
				    $filename =  SMART_GEO_GMAP_DIR_PATH . 'templates' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . $view . '.php';
					if( file_exists( $filename ))
					{
					    ob_start();
					    include( $filename );
					    return ob_get_clean();
					}
					break;
				default:
					break;
			}

			return '';
		}

		/**
		 * @name getNameClass
		 *
		 * @param Basic $object
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function getNameClass(Basic $object) : string
		{
		    $reflect = new \ReflectionClass($object);

		    return $reflect->getShortName();
		}

		/**
		 * getConstant
		 *
		 * @param string $sz_supposed_constant
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function getConstant(string $sz_supposed_constant = '') : string
		{
		    if(strlen($sz_supposed_constant) == 0) return '';

			return ( defined( $sz_supposed_constant ) ? constant ( $sz_supposed_constant ) : $sz_supposed_constant );
		}

		/**
		 * uploadFile
		 *
		 * @param string $path
		 * @param array $files
		 * @param array $restrictions
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return bool
		 */
		public function uploadFile( string $path = '', array $files = [], array $restrictions = array( 'json' ) ) : bool
		{
		    if( !empty( $files[ 'name' ] ))
			{
			    $tmpFilePath = $files[ 'tmp_name' ];

				if( $tmpFilePath != "" )
				{
				    /**
				     * Sanitize file name to avoid directory traversal
				     */
				    $cleanFileName = sanitize_file_name( $files[ 'name' ] );

				    $filePath = $path . $cleanFileName;

				    /**
				     * Check file extension
				     */
				    $extension = pathinfo( $filePath, PATHINFO_EXTENSION );

				    if( count( $restrictions ) > 0 )
				    {
				        if( empty( $extension ) || !in_array( $extension, $restrictions ))
				        {
				            return false;
				        }
				    }

				    /*
				     * Ok move the file
				     */
					if( move_uploaded_file( $tmpFilePath, $filePath ))
					{
					    /**
					     * Check Json file content
					     */
					    $jsonString = file_get_contents( $filePath );

					    $jsonData = json_decode( $jsonString );

					    $isValid = (  json_last_error() == JSON_ERROR_NONE ) ? true : false;

					    if( $isValid )
					    {
					        return true;
					    }
					    else {
					        $this->deleteFile( SMART_GEO_GMAP_PATH_DATA, $filePath );
					    }
					}
				}
			}

			return false;
		}

		/**
		 * uploadFiles
		 *
		 * @todo Need to return an array of results
		 *
		 * @param string $path
		 * @param array $files
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return bool
		 */
		public function uploadFiles( string $path = '', array $files = [], array $restrictions = array( 'geojson', 'json' ) ) : bool
		{
		    if( count( $files[ 'name' ] ) > 0 )
			{
				for( $i=0; $i < count( $files[ 'name' ] ); $i++ )
				{
				    $result = true;

				    if( !isset( $files[ 'tmp_name' ][ $i ] ))
				    {
				        $result = false;
				    }
				    else {
    				    $tmpFilePath = $files[ 'tmp_name' ][ $i ];

    					if( !empty( $tmpFilePath ))
    					{
    					    /**
    					     * Sanitize file name to avoid directory traversal
    					     */
    					    $filePath = $path . sanitize_file_name( $files[ 'name' ][ $i ] );

    					    /**
    					     * Check file extension
    					     */
    					    $extension = pathinfo( $filePath, PATHINFO_EXTENSION );

    					    if( count( $restrictions ) > 0 )
    					    {
    					        if( empty( $extension ) || !in_array( $extension, $restrictions ))
    					        {
    					            $result = false;
    					        }
    					    }

    					    if( $result )
    					    {
    					        /*
    					         * If upload goes wrong
    					         */
    					        if( !move_uploaded_file( $tmpFilePath, $filePath ))
    					        {
    					            $result = false;
    					        }
    					        else {

    					            /**
    					             * Otherwise check Json file content
    					             */
    					            $jsonString = file_get_contents( $filePath );

    					            $jsonData = json_decode( $jsonString );

    					            $isValid = (  json_last_error() == JSON_ERROR_NONE ) ? true : false;

    					            if( $isValid )
    					            {
    					                $result = true;
    					            }
    					            else {
    					                $this->deleteFile( SMART_GEO_GMAP_PATH_DATA, $filePath );

    					                $result = false;
    					            }
    					        } // end check json content
    					    } // end try to move file
    					} // not empty tmp file name
				    } // valid tmp file name
				} // end for

				return $result;

		    } // end count files[name]

		    return false;
		}

		/**
		 * deleteFile
		 *
		 * @param string $path
		 * @param string $fileName
		 * @param array $restrictions
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return bool
		 */
		public function deleteFile( string $path = '', string $fileName = '', array $restrictions = array( 'geojson', 'json' ) ) : bool
		{
		    $extension = pathinfo( $fileName, PATHINFO_EXTENSION );

		    if( count( $restrictions ) > 0 )
		    {
		        if( empty( $extension ) || !in_array( $extension, $restrictions ))
		        {
		            return false;
		        }
		    }

		    /**
		     * Sanitize file name to avoid directory traversal
		     */
		    $filePath = $path . sanitize_file_name( $fileName );

		    if( file_exists( $filePath ))
		    {
		        unlink( $filePath );

		        return true;
		    }

		    return false;
		}

		/**
		 * @name errorNoticeDependency
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function errorNoticeDependency()
		{
		    $error = sprintf("Missing Dependency! %s needs %s in order to work correctly.", SMART_GEO_GMAP_BASENAME, $this->missing_dependency);

		    ?>
    		    <div class="error notice">
                    <p><?php echo __( $error, SMART_GEO_GMAP_L10N ); ?></p>
                </div>
		    <?php
		}

		/**
		 * @name isValidDependency
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return bool
		 */
		protected function isValidDependency() : bool
		{
		    if( isset( $this->config['settings']['dependencies'] ) )
		    {
    		    $dependencies = $this->config['settings']['dependencies'];

    		    if( count( $dependencies ) == 0 )
    		    {
    		        return true;
    		    }

    	        $active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ));

    	        foreach( $dependencies as $dependency )
    	        {
    	            if( !in_array( $dependency, $active_plugins ))
    	            {
    	                $this->missing_dependency = $dependency;

    	                return false;
    	            }
    	        }
		    }

		    /**
		     * @note During the installation
		     * */
		    return true;
		}
	}
}
