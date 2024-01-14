<?php

namespace SGGM\General\Classes;

if(!interface_exists('SGGM\General\Classes\iConfig'))
{
    interface iConfig
    {
        public function getConfig() : array;
        public function checkDependencies() : bool;
        public function getMissingDependencies(): array;
    }
}

if(!class_exists('\SGGM\General\Classes\Config'))
{
    /**
     * @name Config
     * @description Common behaviour
     *
     * @return
     */
    class Config implements iConfig
    {
        protected string $missing_dependency = '';

        /**
         * setConfig
         *
         * @return array
         */
        public function getConfig() : array
        {
            $path = SMART_GEO_GMAP_DIR_PATH . 'config' . DIRECTORY_SEPARATOR . 'config.php';

            if( empty( $this->config ) && file_exists( $path ))
            {
                return include( $path );
            }

            return [];
        }

        /**
         * getMissingDependencies
         *
         * @return array
         */
        public function getMissingDependencies(): array
        {
            return $this->missing_dependency;
        }

        /**
         * prepareFolders
         *
         * @return bool
         */
        public function prepareFolders() : bool
        {
            $folders = [
                SMART_GEO_GMAP_PATH_DATA,
                SMART_GEO_GMAP_PATH_SNAZZY_STYLE
            ];

            foreach($folders as $folder) {
                if( !file_exists( $folder )) {
                    wp_mkdir_p( $folder );
                }
            }

            return true;
        }

        /**
         * @name checkDependencies
         *
         * @return bool
         */
        public function checkDependencies() : bool
        {
            // @todo
            //register_activation_hook( __FILE__, array( 'testPlugin', 'activate' ));
            //add_action( 'activate_plugin', '_20170113_superess_activate', 10, 2 );

            if ($this->isValidDependency()) {
                return true;
            }

            try {
                if(!function_exists('deactivate_plugins')) {
                    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                }

                deactivate_plugins( SMART_GEO_GMAP_BASENAME );
            } catch ( \Error $e ) {
                echo $e->getMessage();
            }

            \add_action('admin_notices', [$this, 'errorNoticeDependency']);

            return false;
        }

        /**
         * @name isValidDependency
         *
         * @return bool
         */
        protected function isValidDependency() : bool
        {
            if( isset( $this->_config['settings']['dependencies'] ) ) {
                $dependencies = $this->_config['settings']['dependencies'];

                if( count( $dependencies ) == 0 ) {
                    return true;
                }

                $active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ));

                foreach( $dependencies as $dependency ) {
                    if( !in_array( $dependency, $active_plugins )) {
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
