<?php
/**
 * @name FrontendManager
 * @description The FrontendManager is a wrapper for all frontend WordPress related activities for example add the backend js/css and check the ajaxurl.
 *
 */

namespace SGGM\Setup\Classes;

use SGGM\Controller\Classes\Controller;

if(!interface_exists('SGGM\Setup\Classes\iFrontendManager'))
{
    interface iFrontendManager
    {
        public function frontendEnqueue();
        public function setAjaxurl();
    }
}

if(!class_exists('\SGGM\Setup\Classes\FrontendManager'))
{
    class FrontendManager extends Manager implements iFrontendManager
	{
        /**
         * __construct
         *
         * @param Controller $frontend

         */
		public function __construct(Controller $frontend)
		{
		    parent::__construct($frontend);
		    
		    $this->setConfig();
		}
		
		/**
		 * @name frontendEnqueue
		 *
		 * @return void
		 */
		public function frontendEnqueue()
		{
			global $post;

			/*
			 * Add additional frontend css/js
			 */
			$shortcodes = $this->config['features']['frontend']['shortcodes'];

			$include = false;
			foreach($shortcodes as $shortcode)
			{
				$keys = \array_keys($shortcode);

				foreach($keys as $key)
				{
					if(isset($post->post_content))
					{
						if(has_shortcode($post->post_content, $key))
						{
							$include = true;
							
							break 2;
						}
					}
				}
			}

			if($include)
			{
				$additional_js = $this->config['features']['frontend']['additional_js'];
				$additional_css = $this->config['features']['frontend']['additional_css'];
	
				$this->enqueueAdditionalStaticFiles($additional_js, 'js');
				$this->enqueueAdditionalStaticFiles($additional_css, 'css');
	
				/*
				 * Add basic static files
				 */
				wp_enqueue_style( 'smart_geo_gmap-frontend-css', sprintf( '%s%s', SMART_GEO_GMAP_URL, '/assets/css/frontend.css' ), [], '1.0' );
				wp_enqueue_script( 'smart_geo_gmap-frontend-js', sprintf( '%s%s', SMART_GEO_GMAP_URL, '/assets/js/frontend.js' ), ['jquery'], '1.0', true );
			}
		}
		
		/**
		 * @name setAjaxurl
		 *
		 * @return void
		 */
		public function setAjaxurl()
		{
			?>
			<script>
				var ajaxurl = "";
				try{ ajaxurl = my_ajax_object.ajax_url; }
				catch( e ) { ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>"; }
			</script>
			<?php 
		}
	}
}