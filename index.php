<?php
require_once 'autoload.php';

use Logger\App\File\FileSystemLog;
use Logger\App\DB\DataBaseLog;
use Orm\Model\User;
use DB\Connect;


//$file = new FileSystemLog();
//$db_log = new DataBaseLog();

$user1 = new User();
$user1->load(10);
//echo $user1->getId();
$user1->setFirstName('Use23165');
$user1->setLastName('User1');
$user1->save();

echo $user1->getFirstName();

//print_r($user1);

unset($user1);


//$file->error('Mysql Exeption!!!!');
//$db_log->error('Fatal error? unexpected ";"!!!');