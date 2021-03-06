<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4b5380382b21860535096b8462564fbe
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Snow_Monkey\\Plugin\\Blocks\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Snow_Monkey\\Plugin\\Blocks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4b5380382b21860535096b8462564fbe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4b5380382b21860535096b8462564fbe::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4b5380382b21860535096b8462564fbe::$classMap;

        }, null, ClassLoader::class);
    }
}
