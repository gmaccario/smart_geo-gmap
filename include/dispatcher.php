<?php
/**
 * @name Dispatcher
 * @description The dispatcher is in charge of taking the right decision about what side of the plugin to set up and launch (frontend or backend).
 *
 */

use SGGM\General\Classes\Config;
use SGGM\General\Classes\View;
use SGGM\General\Classes\Common;
use SGGM\General\Classes\Files;
use SGGM\Controller\Classes\Backend;
use SGGM\Controller\Classes\Frontend;
use SGGM\Setup\Classes\FrontendManager;
use SGGM\Setup\Classes\BackendManager;
use SGGM\Setup\Classes\AjaxLoader;
use SGGM\Setup\Classes\Loader;

$config = new Config();

if($config->checkDependencies())
{
    $config->prepareFolders();

    /* In case of ajax call I need to load both Frontend and Backend to match the right method inside the right class */
    if (defined('DOING_AJAX') && DOING_AJAX)
    {
        /* Both side */
        $controllers = [
            new Backend(new Common($config), new View(), new Files()),
            new Frontend(new Common($config), new View())
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
            $controller = new Backend(new Common($config), new View(), new Files());

            /* BACKEND MANAGER */
            $manager = new BackendManager($controller);

        } else {

            /* FRONTEND SIDE */
            $controller = new Frontend(new Common($config), new View());

            /* FRONTEND MANAGER */
            $manager = new FrontendManager($controller);
        }

        /* HOOKS AND FILTERS HERE */
        $loader = new Loader(new View());

        $loader->setController($controller);
        $loader->setControllerManager($manager);

        $loader->loadFeatures();
    }
}
