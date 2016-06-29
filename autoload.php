<?php

spl_autoload_register(function ($classname)
{
    $path = str_replace('\\', '/', $classname);
    require_once $path . '.php';
});