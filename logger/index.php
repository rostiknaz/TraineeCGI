<?php
require_once ('FileSystem.php');
require_once ('DataBase.php');

$file = new FileSystem();
$db_log = new DataBase();
$file->error('PDO Exeption!!!!');
//$db_log->error('Something wrong');