<?php
require_once 'Vendor/autoload.php';

// instantiate the loader
$loader = new \Autoload\Psr4AutoloaderClass;
// register the autoloader
$loader->register();
// register the base directories for the namespace prefix
$loader->addNamespace('Cgi', __DIR__ . '/App/Cgi/Src');
$loader->addNamespace('Orm', __DIR__ . '/Vendor/Orm/Src/Model');
$loader->addNamespace('Logger', __DIR__ . '/Vendor/Logger/Src');
$loader->addNamespace('DB', __DIR__ . '/DB');

use Cgi\Model\User;
use DB\Connect;
use Logger\LoggerAdapter;


$db = Connect::getInstance();
$connect_db = $db->connect();

$logger = new LoggerAdapter();
$log = $logger->getLoggerInstance();
//
//$file = new FileSystemLog();
//$db_log = new DataBaseLog($connect_db);

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
$user2->load(34);

$user2->setFirstName('Robert');
$user2->save(); // row updated in db.

echo $user2->getId() . '<br>'; // 4
echo $user2->getFirstName() . '<br>'; // Bob

// 3. Deleting a record

$user3 = new User($connect_db);
$user3->load(17);

$user3->setLastName('User134');
$user3->setFirstName('User54');
//$user3->delete(); // row deleted in db.$user3->delete();
echo $user3->getFirstName() . '<br>';
$user3->save();
print_r($user3->getFirstName()); // John
var_dump($user3);

$log->error('Mysql Exeption!!!!');


unset($connect_db);