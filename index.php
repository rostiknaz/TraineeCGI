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

// 1. Creating a record

$user1 = new User($connect_db);
$user1->setFirstName('John');
$user1->setEmail('john.doe@test.com');

$user1->save(); // new row added in db.

echo $user1->getId() . '<br>'; // 1
echo $user1->getFirstName() . '<br>'; // John

// 2. Loading / updating a record

$user2 = new User($connect_db);
$user2->load(12);

echo $user2->getId() . '<br>'; // 4
echo $user2->getFirstName() . '<br>'; // Bob

$user2->setFirstName('Robert');
$user2->save(); // row updated in db.

// 3. Deleting a record

$user3 = new User($connect_db);
$user3->load(38);
$user3->delete(); // row deleted in db.$user3->delete();
//var_dump( $user3);
//print_r($user1);



//$file->error('Mysql Exeption!!!!');
//$db_log->error('Fatal error? unexpected ";"!!!');

unset($connect_db);