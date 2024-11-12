<?php
/**
 * @author Puji Ermanto <pujiermanto@gmail.com>
 * @return FILE
 * */
spl_autoload_register(function ($class) {
    $prefix = 'Controllers\\';
    $baseDir = __DIR__ . '/../controllers/';

    $prefixModel = 'Models\\';
    $baseDirModel = __DIR__ . '/../models/';

    if (strncmp($prefix, $class, strlen($prefix)) === 0) {
        $relativeClass = substr($class, strlen($prefix));
        $file = $baseDir . $relativeClass . '.php';
        if (file_exists($file)) {
            require $file;
        }
    } elseif (strncmp($prefixModel, $class, strlen($prefixModel)) === 0) {
        $relativeClass = substr($class, strlen($prefixModel));
        $file = $baseDirModel . $relativeClass . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});
