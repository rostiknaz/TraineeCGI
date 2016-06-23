<?php
require_once ('FileSystem.php');
require_once ('DataBase.php');

$file = new FileSystem();
$db_log = new DataBase();
$file->warning('Warning somewhere');
$db_log->error('Something wrong');