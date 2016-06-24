<?php
use App\File\FileSystemLog;
use App\DB\DataBaseLog;

spl_autoload_register(function ($classname){
    $path = str_replace('\\','/',$classname);
    require_once $path . '.php';
});

$file = new FileSystemLog();
$db_log = new DataBaseLog();

$file->error('Mysql Exeption!!!!');
$db_log->error('Fatal error? unexpected ";"!!!');