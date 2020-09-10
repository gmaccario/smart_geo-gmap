<?php
/**
 * @name Dispatcher
 * @description The dispatcer is in charge of taking the right decision about what side of the plugin to set up and launch (frontend or backend).
 *
 * @author G.Maccario <g_maccario@hotmail.com>
 */

use SGGM\General\Classes\Common;
use SGGM\Controller\Classes\Backend;
use SGGM\Controller\Classes\Frontend;
use SGGM\Setup\Classes\FrontendManager;
use SGGM\Setup\Classes\BackendManager;
use SGGM\Setup\Classes\AjaxLoader;
use SGGM\Setup\Classes\Loader;

$common = new Common();

if($common->checkDependencies())
{
    $common->prepareFolders();
    $common->prepare();

    /* In case of ajax call I need to load both Frontend and Backend to match the right method inside the right class */
    if (defined('DOING_AJAX') && DOING_AJAX)
    {
        /* Both side */
        $controllers = [
            new Backend($common),
            new Frontend($common)
        ];

        /* WARNING: WordPress must register AJAX CALLS and new ROUTES before add any action or filters! */
        $ajaxLoader = new AjaxLoader();

        array_map(function ($controller) use($ajaxLoader){

            /* AJAX LOADER */
            $ajaxLoader->setController($controller);
            $ajaxLoader->registerAjaxCalls();

        }, $controllers);
    }
    else {

        /* Request frontend or backend */
        $controller = null;
        $manager = null;

        if(is_admin())
        {
            /* BACKEND SIDE */
            $controller = new Backend($common);

            /* BACKEND MANAGER */
            $manager = new BackendManager($controller);

        } else {

            /* FRONTEND SIDE */
            $controller = new Frontend($common);

            /* FRONTEND MANAGER */
            $manager = new FrontendManager($controller);
        }

        if( $controller && $manager )
        {
          /* HOOKS AND FILTERS HERE */
          $loader = new Loader();

          $loader->setController($controller);
          $loader->setControllerManager($manager);

          $loader->loadFeatures();
        }
    }
}
