<?php

spl_autoload_register(function ($classname)
{
    $path = str_replace('\\', '/', $classname);
//    $explode = explode('/',$path);
//    switch ($explode[0]) {
//        case 'App':
//            $new_path = 'App/Cgi/Src/' . $explode[1] . '/' . $explode[2];
//            break;
//        case 'Vendor':
//            $new_path = 'Vendor/' . $explode[1] . '/Src/' . $explode[2] . '/' . $explode[3];
//            break;
//        case 'DB':
//            $new_path = $path;
//    }
//    print_r($explode);
    require_once  $path . '.php';
});
// Vendor\Logger\Src
// Vendor\Logger\Src\Abstr
// Vendor\Logger\Src\Interf

// Vendor\Orm\Src\Model
// Vendor\Orm\Src\Model\Interf

// App\Cgi\Src\Model
