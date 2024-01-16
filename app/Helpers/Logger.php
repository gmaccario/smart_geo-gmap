<?php

namespace SmartGeoGMap\Helpers;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as MonologLogger;

class Logger
{
    private string $_action = '';

    public function setAction(string $action)
    {
        $this->_action = $action;
    }

    /**
     * @return MonologLogger|null
     */
    public function getInstance(): ?MonologLogger
    {
        $logger = null;

        if (WP_DEBUG) {
            // create a log channel
            $logger = new MonologLogger('default');

            // Add rotating handlers
            $logFileName = sprintf('%swp-content%splugins%s%s%sstorage%slogs%s%s%sapp.log',
                ABSPATH,
                DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR,
                SMARTGEOGMAP_SLUG,
                DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR,
                $this->_action,
                DIRECTORY_SEPARATOR); // ABSPATH . 'wp-content' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . SMARTGEOGMAP_SLUG . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $this->_action . DIRECTORY_SEPARATOR . 'process.log';

            $logRotate = new RotatingFileHandler($logFileName);

            $logger->pushHandler($logRotate);
        }

        return $logger;
    }
}
