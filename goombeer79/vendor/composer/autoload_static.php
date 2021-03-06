<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8b22a7c8a78cc03febe9235efc862ee2
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LINE\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LINE\\' => 
        array (
            0 => __DIR__ . '/..' . '/linecorp/line-bot-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8b22a7c8a78cc03febe9235efc862ee2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8b22a7c8a78cc03febe9235efc862ee2::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
