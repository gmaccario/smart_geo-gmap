<?php

namespace SmartGeoGMap\Helpers;

use Exception;

class View {
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
	 *
	 * @throws Exception
	 */
	public function __construct( string $view = '', array $params = [] ) {
		if ( $view == '' ) {
			throw new Exception( 'View name is mandatory!' );
		}

		$trace = debug_backtrace();

		$this->prepare( $view, $params, $trace );

		// If to-string exists, use the public toString() method to render the content of the view
		if ( ! key_exists( 'to-string', $params ) ) {
			$this->make();
		}
	}


	/**
	 * @param string $view
	 * @param array $params
	 * @param array $trace
	 */
	private function prepare( string $view, array $params, array $trace ): void {
		$this->view   = $view;
		$this->params = $params;
// echo "<pre>";print_r($trace);wp_die();
		foreach ( $trace as $t ) {
//echo "<pre>";print_r($t);
			if ( isset( $t['object']->side ) ) {
				if ( $t['object']->side !== '' ) {
					$this->side = $t['object']->side;
					break;
				}
			}
		}
//die();
	}

	/**
	 * @return void
	 */
	private function make(): void {
		foreach ( $this->params as $index => $value ) {
			$$index = $value;
		}

		$viewPath = $this->getViewPath();

		include( $viewPath );
	}

	/**
	 * @return string
	 */
	public function toString(): string {
		foreach ( $this->params as $index => $value ) {
			$$index = $value;
		}

		$viewPath = $this->getViewPath();

		ob_start();
		include( $viewPath );
		$result = ob_get_contents();
		ob_end_clean();

		return $result;
	}

	/**
	 * @return string
	 */
	private function getViewPath(): string {
		$appPath = plugin_dir_path( dirname( __FILE__ ) ) . '..' . DIRECTORY_SEPARATOR;

		$viewsPath = $appPath . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

		return $viewsPath . $this->side . DIRECTORY_SEPARATOR . $this->view . '.php';
	}
}
