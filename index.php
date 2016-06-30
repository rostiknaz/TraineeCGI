<?php
require_once 'autoload.php';

use Logger\App\File\FileSystemLog;
use Logger\App\DB\DataBaseLog;
use Orm\Model\User;
use DB\Connect;

$db = Connect::getInstance();
$connect_db = $db->connect();
//$file = new FileSystemLog();
//$db_log = new DataBaseLog();

$user1 = new User($connect_db);
$user1->load(23);
//echo $user1->getId();
$user1->setFirstName('Jack');
$user1->setLastName('London');
$user1->setEmail('london@gmail.com');
$user1->save();

//echo $user1->getFirstName() ."<br>";

$user2 = new User($connect_db);
$user2->setFirstName('User1');
$user2->setLastName('User1');
$user2->save();

$user3 = new User($connect_db);
$user3->load(32);
//$user3->delete();
echo $user3->getEmail();
//print_r($user1);

unset($connect_db);


//$file->error('Mysql Exeption!!!!');
//$db_log->error('Fatal error? unexpected ";"!!!');