<?php

namespace SGGM\Controller\Classes;

use Exception;
use SGGM\General\Classes\Basic;
use SGGM\General\Classes\Common;
use SGGM\General\Classes\View;

if(!interface_exists('SGGM\Controller\Classes\iController'))
{
    interface iController
    {
        public function getCommon() : Common;
        public function renderTemplate(string $template = '') : string;
    }
}

if(!class_exists('\SGGM\Controllers\Classes\Controller'))
{
    /**
     * @name Controller
     * @description Generic class for the Controller
     *
     * @return
     */
    class Controller extends Basic implements iController
	{		
		protected Common $common;
		protected View $view;

        /**
         * @param Common $common
         * @param View $view
         */
		public function __construct(Common $common, View $view)
		{
			$this->common = $common;
            $this->view = $view;
		}
		
		/**
		 * @name getCommon
		 *
		 * @return Common
		 */
		public function getCommon() : Common
		{   
		    return $this->common;
		}

        /**
         * @name renderTemplate
         *
         * @param string $template
         *
         * @return string
         * @throws Exception
         */
		public function renderTemplate(string $template = '') : string
		{
		    if($template == '')
		    {
		        throw new Exception('Please, set a new template inside the config file and use it.');
		    } else {
		        
		        return $this->view->renderView($this, $template, $this->params);
		    }
		}
    }
}