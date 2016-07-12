<?php
require_once 'Vendor/autoload.php';
ini_set('display_errors', 1);
// instantiate the loader
$loader = new \Autoload\Psr4AutoloaderClass;
// register the autoloader
$loader->register();
// register the base directories for the namespace prefix
$loader->addNamespace('Cgi', __DIR__ . '/App/Cgi/Src');
$loader->addNamespace('Orm', __DIR__ . '/Vendor/Orm/Src/Model');
$loader->addNamespace('Logger', __DIR__ . '/Vendor/Logger/Src');
$loader->addNamespace('Core', __DIR__ . '/Vendor/Core/Src');
$loader->addNamespace('DB', __DIR__ . '/DB');

use DB\Connect;
use Core\App;


$db = Connect::getInstance();
$connect_db = $db->connect();

App::run(); // запускаем приложение


unset($connect_db);