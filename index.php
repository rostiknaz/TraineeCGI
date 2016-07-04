<?php
require_once 'Vendor/autoload.php';

use Vendor\Logger\Src\FileSystemLog;
use Logger\App\DB\DataBaseLog;
use App\Cgi\Src\Model\User;
use DB\Connect;

$db = Connect::getInstance();
$connect_db = $db->connect();

$file = new FileSystemLog();
$db_log = new DataBaseLog($connect_db);

// 1. Creating a record

$user1 = new User($connect_db);
$user1->setFirstName('John12');
$user1->setEmail('john.doe@test.com');

$user1->save(); // new row added in db.

echo $user1->getId() . '<br>'; // 1
echo $user1->getFirstName() . '<br>'; // John

// 2. Loading / updating a record
//
$user2 = new User($connect_db);
$user2->load(53);

$user2->setFirstName('Robert34645');
$user2->save(); // row updated in db.

echo $user2->getId() . '<br>'; // 4
echo $user2->getFirstName() . '<br>'; // Bob

// 3. Deleting a record

$user3 = new User($connect_db);
$user3->load(6);

$user3->setLastName('User13');
$user3->setFirstName('User547');
$user3->delete(); // row deleted in db.$user3->delete();
echo $user3->getFirstName() . '<br>';
$user3->save();
echo $user3->getFirstName() . '<br>'; // John
var_dump($user3);

$file->error('Mysql Exeption!!!!');
$db_log->error('Fatal error? unexpected ";"!!!');

unset($connect_db);