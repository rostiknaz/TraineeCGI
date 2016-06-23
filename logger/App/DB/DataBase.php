<?php
namespace App\DB;

use App\Abstr\Logger;
/**
 * Class for writing log messages to database
 */
class DataBase extends Logger
{
    /**
     * Connection to DB
     */
    protected $_connect = NULL;

    /**
     * Connection process to DB
     */
    public function __construct(){
        $config = parse_ini_file('Config/config.ini');
        $dsn = $config['dsn'];
        $user = $config['username'];
        $password = $config['password'];
        $this->_connect = new \PDO($dsn, $user, $password);
    }

    /**
     * Writes a log message to database
     * 
     * @param $message
     * @param $type
     */
    protected function _write($message,$type){
        try {
            $statement = $this->_connect->prepare("INSERT INTO `log` (`message`, `type`, `creation_date`) values (?, ?, ?)");
            $statement->execute([$message, $type, date('Y-m-d H:i:s')]);
            $this->_connect = null;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}