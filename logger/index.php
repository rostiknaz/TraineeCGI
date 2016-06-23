<?php

function __autoload($classname){
    $path = str_replace('\\','/',$classname);
    require_once $path . '.php';
}

$file = new \App\File\FileSystem();
$db_log = new \App\DB\DataBase();

$file->error('PDO Exeption!!!!');
$db_log->error('Syntax error? unexpected ";"!!!');