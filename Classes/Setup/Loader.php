<?php

namespace SGGM\Setup\Classes;

use SGGM\Controller\Classes\Controller;
use SGGM\General\Classes\View;

if(!interface_exists('SGGM\Setup\Classes\iLoader'))
{
    interface iLoader
    {
        public function setController(Controller $controller);
        public function setControllerManager(Manager $manager);
        public function loadFeatures();
    }
}

if(!class_exists('\SGGM\Setup\Classes\Loader'))
{
    /**
     * @name Loader
     * @description Generic loader
     *
     * @return
     */
    class Loader implements iLoader
	{
        protected $controller;
        protected $controllerManager;
        private View $_view;

        /**
         * @param View $view
         *
         */
        public function __construct(View $view)
        {
            $this->_view = $view;
        }
		
		/**
		 * @name setController
		 *
		 * @param Controller $controller
		 *
		 * @return void
		 */
		public function setController(Controller $controller)
		{
		    $this->controller = $controller;
		}

        /**
         * @param Manager $manager
         * @return void
         */
		public function setControllerManager(Manager $manager)
		{
		    $this->controllerManager = $manager;
		}
		
		/**
		 * @name publicInit (Frontend)
		 *
		 * @return
		 */
		public function publicInit()
		{
		    
		}
		
		/**
		 * @name adminInit (Backend)
		 *
		 * @return
		 */
		public function adminInit()
		{
		    $this->controllerManager->whenSmartGEOGoogleMapStart();
		}
		
		/**
		 * @name loadFeatures
		 *
		 * @return void
		 */
		public function loadFeatures()
		{
		    if(strtolower($this->_view->getNameClass($this->controller)) != 'backend') {
		        $this->loadFrontendFeatures();
		    } else {
		        $this->loadBackendFeatures();
		    }
		}
		
		/**
		 * @name loadBackendFeatures
		 *
		 * @return void
		 */
		protected function loadBackendFeatures()
		{
		    add_action( 'admin_init', array($this, 'adminInit'));
		    
		    add_action( 'admin_menu', array($this->controllerManager, 'backendMenu'));
		    add_action( 'admin_enqueue_scripts', array($this->controllerManager, 'backendEnqueue'));
		    
		    add_filter( 'plugin_action_links_' . SMART_GEO_GMAP_BASENAME, array($this->controllerManager, 'customActionLinks' ));
		    
		    $this->automaticLoadingOfHooksFiltersAndShortcodes();
		}
		
		/**
		 * @name loadFrontendFeatures
		 *
		 * @return void
		 */
		protected function loadFrontendFeatures()
		{
		    add_action( 'init', array($this, 'publicInit' ));
		    
		    add_action( 'wp_head', array($this->controllerManager, 'setAjaxurl' ));
		    add_action( 'wp_enqueue_scripts', array($this->controllerManager, 'frontendEnqueue' ));
		    
		    $this->automaticLoadingOfHooksFiltersAndShortcodes();
		}
		
		/**
		 * @name automaticLoadingOfHooksFiltersAndShortcodes
		 *
		 * @return void
		 */
		protected function automaticLoadingOfHooksFiltersAndShortcodes()
		{
		    $common = $this->controller->getCommon();
		    $config = $common->getConfig();
		    
		    $side = strtolower($this->_view->getNameClass($this->controller));
			
			$hooks 		= $config[ 'features' ][ $side ][ 'hooks' ];
			$filters 	= $config[ 'features' ][ $side ][ 'filters' ];
			$shortcodes = $config[ 'features' ][ $side ][ 'shortcodes' ];

			if( count( $hooks ) > 0 ) 		$this->loadingHooks( $hooks[0] );
			if( count( $filters ) > 0 ) 	$this->loadingFilters( $filters[0] );
			if( count( $shortcodes ) > 0 ) 	$this->loadingShortcodes( $shortcodes[0] );
		}
		
		/**
		 * @name loading_hooks
		 *
		 * @param array $hooks
		 *
		 * @return void
		 */
		protected function loadingHooks(array $hooks)
		{
		    foreach( $hooks as $hook => $function ) {
			    add_action( $hook, array( $this->controller, $function ));
			}
		}
		
		/**
		 * @name loadingFilters
		 * 
		 * @param array $filters
		 *
		 * @return void
		 */
		protected function loadingFilters(array $filters)
		{
			foreach( $filters as $filter => $function ) {
			    add_filter( $filter, array( $this->controller, $function ));
			}
		}
		
		/**
		 * @name loadingShortcodes
		 *
		 * @param array $shortcodes
		 *
		 * @return void
		 */
		protected function loadingShortcodes(array $shortcodes)
		{
			foreach( $shortcodes as $shortcode => $function ) {
			    add_shortcode( $shortcode, array( $this->controller, $function ));
			}
		}
	}
}