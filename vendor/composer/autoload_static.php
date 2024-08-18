<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc46d17d6b23177cc666875a388cc3561
{
    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zgeniuscoders\\Zenderer\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zgeniuscoders\\Zenderer\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc46d17d6b23177cc666875a388cc3561::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc46d17d6b23177cc666875a388cc3561::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc46d17d6b23177cc666875a388cc3561::$classMap;

        }, null, ClassLoader::class);
    }
}
