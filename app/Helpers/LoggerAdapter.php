<?php

namespace SmartGeoGMap\Helpers;

use InvalidArgumentException;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use DateTimeZone;

// Adapter pattern (wrap Logger)

class LoggerAdapter {
	private string $_action = '';

	private Logger $logger;

	const DEBUG = 100;
	const INFO = 200;
	const NOTICE = 250;
	const WARNING = 300;
	const ERROR = 400;
	const CRITICAL = 500;
	const ALERT = 550;
	const EMERGENCY = 600;

	public array $levels = [
		self::DEBUG     => 'DEBUG',
		self::INFO      => 'INFO',
		self::NOTICE    => 'NOTICE',
		self::WARNING   => 'WARNING',
		self::ERROR     => 'ERROR',
		self::CRITICAL  => 'CRITICAL',
		self::ALERT     => 'ALERT',
		self::EMERGENCY => 'EMERGENCY',
	];

	/**
	 * @param string $name
	 * @param array $handlers
	 * @param array $processors
	 * @param DateTimeZone|null $timezone
	 */
	public function __construct(
		string $name = 'default',
		array $handlers = [],
		array $processors = [],
		?DateTimeZone $timezone = null
	) {
		if ( WP_DEBUG ) {
			$this->_action = $name;

			$this->logger = new Logger( $name, $handlers, $processors, $timezone );
			$this->addRotatingHandlers();
		}
	}

	private function addRotatingHandlers(): void {
		$logFileName = sprintf( '%swp-content%splugins%s%s%sstorage%slogs%s%s%sapp.log',
			ABSPATH,
			DIRECTORY_SEPARATOR,
			DIRECTORY_SEPARATOR,
			SMARTGEOGMAP_SLUG,
			DIRECTORY_SEPARATOR,
			DIRECTORY_SEPARATOR,
			DIRECTORY_SEPARATOR,
			$this->_action,
			DIRECTORY_SEPARATOR );

		$logRotate = new RotatingFileHandler( $logFileName );

		$this->logger->pushHandler( $logRotate );
	}

	/**
	 * Returns the INT value of a level
	 *
	 * @param string $name
	 *
	 * @return integer level int val
	 * @throws InvalidArgumentException
	 */
	private function getLevelValue( string $name ): int {
		$levelsReverse = array_flip( $this->levels );
		if ( ! array_key_exists( $name, $levelsReverse ) ) {
			throw new InvalidArgumentException( sprintf( 'Level "%s" is not defined, use one of: %s',
					$name,
					implode( ', ', array_keys( $levelsReverse ) ) )
			);
		}

		return $levelsReverse[ $name ];
	}

	/**
	 * Add a log record
	 *
	 * @param integer|string $level
	 * @param string $message
	 * @param array $context
	 *
	 * @return bool
	 */
	public function addLog( int|string $level = 'INFO', string $message = '-', array $context = [] ): bool {
		$level = $this->getLevelValue( $level );

		return $this->logger->addRecord( $level, $message, $context );
	}
}
