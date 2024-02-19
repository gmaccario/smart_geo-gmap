<?php

namespace SmartGeoGMap\Helpers;

class Intl
{
    public static function esc_html_e( string $string ): void
    {
        printf(
            esc_html__(  '%s' ),
            esc_html( $string )
        );
    }

    public static function esc_attr_e( string $string ): void
    {
        printf(
            esc_html__(  '%s' ),
            esc_attr_e( $string )
        );
    }
}
