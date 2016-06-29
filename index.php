<?php
require_once 'autoload.php';

use Logger\App\File\FileSystemLog;
use Logger\App\DB\DataBaseLog;
use Orm\Model\User;
use DB\Connect;


//$file = new FileSystemLog();
//$db_log = new DataBaseLog();

$user = new User();
$user->first_name = 'Richard1';
$user->last_name = 'Castle1';
$user->create();
//$user1 = $user->find()->where('first_name LIKE "%a%"')->fetch('all');
//print_r($user1);
//$user->delete('id = 9');
//$user->update('id = 10');


//$file->error('Mysql Exeption!!!!');
//$db_log->error('Fatal error? unexpected ";"!!!');