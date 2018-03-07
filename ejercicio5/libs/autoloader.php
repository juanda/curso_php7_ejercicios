<?php
spl_autoload_register(function ($class) {
            
    $sep = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')? '\\' : '/';

    $base_dir = __DIR__ . $sep;

    $file = $base_dir . str_replace('\\', $sep, $class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});
