<?php

namespace SGGM\General\Classes;

if(!interface_exists('SGGM\General\Classes\iCommon'))
{
    interface iCommon
    {
        public function printMyLastQuery() : string;
        public function getConstant(string $sz_supposed_constant = '') : string;
        public function errorNoticeDependency();
    }
}

if(!class_exists('\General\Classes\Common'))
{
    /**
     * @name Common
     * @description Common behaviour
     *
     * @return
     */
	class Common implements iCommon
	{
		protected bool $debug = false;
		private array $config = [];

        private Config $_objConfig;

		public function __construct(Config $config)
        {
            $this->_objConfig = $config;
        }

		/**
		 * @name getConfig
		 *
		 * @return array
		 */
		public function getConfig() : array
		{
		    return $this->cionfig = $this->_objConfig->getConfig();
		}

		/**
		 * @name printMyLastQuery
		 *
		 * @return string
		 */
		public function printMyLastQuery() : string
		{
			global $wpdb;

			return $wpdb->last_query;
		}

		/**
		 * getConstant
		 *
		 * @param string $sz_supposed_constant
		 *
		 * @return string
		 */
		public function getConstant(string $sz_supposed_constant = '') : string
		{
		    if(strlen($sz_supposed_constant) == 0) return '';

			return ( defined( $sz_supposed_constant ) ? constant ( $sz_supposed_constant ) : $sz_supposed_constant );
		}

		/**
		 * @name errorNoticeDependency
		 *
		 * @return void
		 */
		public function errorNoticeDependency()
		{
		    $error = sprintf("Missing Dependency! %s needs %s in order to work correctly.", SMART_GEO_GMAP_BASENAME, $this->_objConfig->getMissingDependencies());

		    ?>
    		    <div class="error notice">
                    <p><?php echo __( $error, SMART_GEO_GMAP_L10N ); ?></p>
                </div>
		    <?php
		}
	}
}
