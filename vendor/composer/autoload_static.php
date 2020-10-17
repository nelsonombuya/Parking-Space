<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit407dcd74e1c6eb4a5b929bb20465f57a
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Matomo\\Ini\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Matomo\\Ini\\' => 
        array (
            0 => __DIR__ . '/..' . '/matomo/ini/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit407dcd74e1c6eb4a5b929bb20465f57a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit407dcd74e1c6eb4a5b929bb20465f57a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
