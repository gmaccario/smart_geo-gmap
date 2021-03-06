<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit22ccd38f91863fff5ca90c0499c90acd
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SGGM\\Setup\\Classes\\' => 19,
            'SGGM\\General\\Classes\\' => 21,
            'SGGM\\Controller\\Classes\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SGGM\\Setup\\Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes/setup',
        ),
        'SGGM\\General\\Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes/general',
        ),
        'SGGM\\Controller\\Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes/controllers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit22ccd38f91863fff5ca90c0499c90acd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit22ccd38f91863fff5ca90c0499c90acd::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
