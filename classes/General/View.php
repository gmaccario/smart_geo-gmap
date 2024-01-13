<?php

namespace SGGM\General\Classes;

use ReflectionClass;
use SGGM\Controller\Classes\iController;

if(!interface_exists('SGGM\General\Classes\iView'))
{
    interface iView
    {
        public function getNameClass(Basic $object) : string;
        public function renderView(iController $controller, string $view, array $params) : string;
    }
}

if(!class_exists('\General\Classes\Common')) {
    /**
     * @name View
     * @description View behaviour
     *
     * @return
     */
    class View implements iView
    {
        /**
         * @name renderView
         *
         * @param iController $controller
         * @param string $view
         * @param array $params
         *
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
         * @return string
         */
        public function getNameClass(Basic $object) : string
        {
            $reflect = new ReflectionClass($object);

            return $reflect->getShortName();
        }
    }
}
