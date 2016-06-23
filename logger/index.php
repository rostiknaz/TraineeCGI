<?php
use App\File\FileSystem;
use App\DB\DataBase;

function __autoload($classname){
    $path = str_replace('\\','/',$classname);
    require_once $path . '.php';
}

$file = new FileSystem();
$db_log = new DataBase();

$file->error('Mysql Exeption!!!!');
$db_log->error('Fatal error? unexpected ";"!!!');