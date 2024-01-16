<?php

namespace SmartGeoGMap\Helpers;

use Exception;

class View
{
    /**
     * @var string
     */
    private string $view = '';

    /**
     * @var array
     */
    private array $params = [];

    /**
     * @var string
     */
    private string $side = '';

    /**
     * @param string $view
     * @param array $params
     * @throws Exception
     */
    public function __construct(string $view = '', array $params = [])
    {
        if ( $view == '' ) {
            throw new Exception('View name is mandatory!');
        }

        $trace = debug_backtrace();

        $this->prepare($view, $params, $trace);
        $this->make();
    }


    /**
     * @param string $view
     * @param array $params
     * @param array $trace
     */
    private function prepare(string $view, array $params, array $trace): void
    {
        $this->view = $view;
        $this->params = $params;
//echo "<pre>";print_r($trace);
//die();
        foreach ($trace as $t) {
            if (isset($t['object']->side)) {
                if ($t['object']->side !== '') {
                    $this->side = $t['object']->side;
                    break;
                }
            }
        }
    }

    /**
     * @return void
     */
    private function make(): void
    {
        foreach ( $this->params as $index => $value ) {
            $$index = $value;
        }

        $viewPath = $this->getViewPath();

        include ( $viewPath );
    }

    /**
     * @return string
     */
    private function getViewPath(): string
    {
        $appPath = plugin_dir_path(dirname(__FILE__)) . '..' . DIRECTORY_SEPARATOR;

        $viewsPath = $appPath . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

        return $viewsPath . $this->side . DIRECTORY_SEPARATOR . $this->view . '.php';
    }
}
