<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit3ec1fe93b58dd7b75d361080b41e8501
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit3ec1fe93b58dd7b75d361080b41e8501', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit3ec1fe93b58dd7b75d361080b41e8501', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit3ec1fe93b58dd7b75d361080b41e8501::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
