<?php
require_once 'autoload.php';

use Logger\App\File\FileSystemLog;
use Logger\App\DB\DataBaseLog;
use Orm\Model\User;
use DB\Connect;

$db = Connect::getInstance();
$connect_db = $db->connect();
//$file = new FileSystemLog();
//$db_log = new DataBaseLog($connect_db);

$user1 = new User($connect_db);
$user1->load(23);
echo $user1->getId();
$user1->setFirstName('Jack346');
$user1->setLastName('London4565');
$user1->setEmail('london@gmail.com');
$user1->save();

echo $user1->getFirstName() ."<br>";

$user2 = new User($connect_db);
//$user2->load(41);
$user2->setFirstName('User1');
$user2->setLastName('User1');
$user2->save();

$user3 = new User($connect_db);
$user3->load(27);
$user3->delete();
//var_dump( $user3);
//print_r($user1);



//$file->error('Mysql Exeption!!!!');
//$db_log->error('Fatal error? unexpected ";"!!!');

unset($connect_db);