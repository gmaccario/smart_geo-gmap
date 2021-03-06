<?php

namespace SGGM\Setup\Classes;

use SGGM\General\Classes\Basic;
use SGGM\Controller\Classes\iController;

if(!interface_exists('SGGM\Setup\Classes\iManager'))
{
    interface iManager
    {
        public function setConfig();
    }
}

if(!class_exists('\SGGM\Setup\Classes\Controller'))
{
    /**
     * @name Manager
     * @description Generic class for the Controller
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class Manager extends Basic implements iManager
    {
        protected $config;
        protected $controller;

        /**
         * @name __construct
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct(iController $controller)
        {
            parent::__construct();

            $this->controller = $controller;
        }

        /**
         * @name setConfig
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function setConfig()
        {
            $this->config = $this->controller->getCommon()->getConfig();
        }

        /**
         * @name enqueueAdditionalStaticFiles
         *
         * @param array $additionals
         * @param string $enqueueType
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        protected function enqueueAdditionalStaticFiles(array $additionals, string $enqueueType)
        {
            foreach($additionals as $additional)
            {
              $basename = explode('/', $additional);

              if($enqueueType != 'js')
              {
                wp_enqueue_style( 'smart_geo_gmap-admin-frontend-css-' . $basename[count($basename) - 1], $additional);
              }
              else {
                  if(strpos($additional, 'maps.googleapis.com') === false)
                  {
                    wp_enqueue_script( 'smart_geo_gmap-frontend-js-' . $basename[count($basename) - 1], $additional, array( 'jquery', 'smart_geo_gmap-frontend-js' ), null, true );
                  }
                  else {
                      $googleApiKey = get_option( SMART_GEO_GMAP_OPT_GOOGLE_API_KEY );

                      if( !empty( $googleApiKey ))
                      {
                          $additional = sprintf( $additional, $googleApiKey );

                          wp_enqueue_script( 'smart_geo_gmap-frontend-js-' . $basename[count($basename) - 1], $additional, array( 'jquery', 'smart_geo_gmap-frontend-js' ), null, true );
                      }
                  }
              }
            }
        }
    }
}
