<?php declare(strict_types=1);

use SnapWizard\Helpers\Constants;
use SnapWizard\Helpers\Logger as SnapWizardLogger;
use PHPUnit\Framework\TestCase;

final class LoggerTest extends TestCase
{
    public function testGetInstanceIsNull(): void
    {
        if ( !defined('WP_DEBUG') ) define( 'WP_DEBUG', false );

        $logger = new SnapWizardLogger();
        $logInstance = $logger->getInstance();

        $this->assertNull($logInstance);
    }
}
