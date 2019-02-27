<?php

spl_autoload_register(function($class_name)
{
    # List all the class directories in the array
    $array_patch = array(
        '/models/',
        '/components/',
    );
    
    foreach ($array_patch as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
});