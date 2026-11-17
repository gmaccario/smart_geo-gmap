<?php

namespace SmartGeoGMap\Helpers;

/**
 * sanitize_callback for every setting registered with register_setting()
 */
class SettingsSanitizer {
	public const DEFAULT_WIDTHS = [ 'full_width', 'half_centered' ];
	public const MAP_TYPES = [ '', 'HYBRID', 'ROADMAP', 'SATELLITE', 'TERRAIN' ];
	public const ZOOMS = [ '1', '5', '10', '15', '20' ];
	public const TOOLTIP_EVENTS = [ 'mouseover', 'click' ];
	public const LEGEND_POSITIONS = [
		'',
		'TOP_CENTER',
		'TOP_LEFT',
		'TOP_RIGHT',
		'LEFT_TOP',
		'RIGHT_TOP',
		'LEFT_CENTER',
		'RIGHT_CENTER',
		'LEFT_BOTTOM',
		'RIGHT_BOTTOM',
		'BOTTOM_CENTER',
		'BOTTOM_LEFT',
		'BOTTOM_RIGHT',
	];

	public function text( mixed $value ): string {
		return sanitize_text_field( (string) $value );
	}

	public function defaultWidth( mixed $value ): string {
		return $this->oneOf( $value, self::DEFAULT_WIDTHS, 'half_centered' );
	}

	public function mapType( mixed $value ): string {
		return $this->oneOf( $value, self::MAP_TYPES, '' );
	}

	public function zoom( mixed $value ): string {
		return $this->oneOf( $value, self::ZOOMS, '10' );
	}

	public function tooltipEvent( mixed $value ): string {
		return $this->oneOf( $value, self::TOOLTIP_EVENTS, 'mouseover' );
	}

	public function legendToggle( mixed $value ): string {
		return empty( $value ) ? '' : 'on';
	}

	public function legendPosition( mixed $value ): string {
		return $this->oneOf( $value, self::LEGEND_POSITIONS, '' );
	}

	/**
	 * Icon name from https://maps.google.com/mapfiles/kml/shapes/, e.g. "capital_big" or "arrow-reverse"
	 */
	public function legendImage( mixed $value ): string {
		return (string) preg_replace( '/[^a-z0-9_-]/', '', strtolower( (string) $value ) );
	}

	/**
	 * "52.370216, 4.895168" => "52.370216, 4.895168". An invalid value keeps the saved one and shows an error.
	 */
	public function latLong1( mixed $value ): string {
		return $this->latLong( $value, 1 );
	}

	public function latLong2( mixed $value ): string {
		return $this->latLong( $value, 2 );
	}

	public function latLong3( mixed $value ): string {
		return $this->latLong( $value, 3 );
	}

	private function latLong( mixed $value, int $index ): string {
		$value = trim( sanitize_text_field( (string) $value ) );

		if ( $value === '' ) {
			return '';
		}

		if ( preg_match( '/^(-?\d{1,3}(?:\.\d+)?)\s*,\s*(-?\d{1,3}(?:\.\d+)?)$/', $value, $matches )
			&& abs( (float) $matches[1] ) <= 90
			&& abs( (float) $matches[2] ) <= 180 ) {
			return $matches[1] . ', ' . $matches[2];
		}

		$option = 'smartgeogmap_coordinates_lat_long_' . $index;

		add_settings_error(
			$option,
			$option . '_invalid',
			esc_html( sprintf(
				/* translators: 1: coordinate number (1-3), 2: the value entered */
				__( 'Lat/Long %1$d was not saved: "%2$s" is not a valid "latitude, longitude" pair, for example 52.370216, 4.895168.', 'smart-geo-gmap' ),
				$index,
				$value
			) )
		);

		return (string) get_option( $option, '' );
	}

	private function oneOf( mixed $value, array $allowed, string $default ): string {
		$value = (string) $value;

		return in_array( $value, $allowed, true ) ? $value : $default;
	}
}
