<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5cc1f7fc17abed86a4a4933dc9c5d258
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DgoraWcas\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DgoraWcas\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5cc1f7fc17abed86a4a4933dc9c5d258::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5cc1f7fc17abed86a4a4933dc9c5d258::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5cc1f7fc17abed86a4a4933dc9c5d258::$classMap;

        }, null, ClassLoader::class);
    }
}
