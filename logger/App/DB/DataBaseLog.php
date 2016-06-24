<?php
namespace App\DB;

use App\Abstr\LoggerAbstract;
/**
 * Class for writing log messages to database
 */
class DataBaseLog extends LoggerAbstract
{
    /**
     * Connection to DB
     */
    private $_conn = NULL;

    /**
     * Connection process to DB
     */
    private function _connect(){
        $config = parse_ini_file('Config/config.ini');
        $dsn = $config['dsn'];
        $user = $config['username'];
        $password = $config['password'];
        $this->_conn = new \PDO($dsn, $user, $password);
    }

    /**
     * Writes a log message to database
     * 
     * @param $message
     * @param $type
     */
    protected function _write($message,$type){
        try {
            $this->_connect();
            $statement = $this->_conn->prepare("INSERT INTO `log` (`message`, `type`, `creation_date`) values (?, ?, ?)");
            $statement->execute([$message, $type, date('Y-m-d H:i:s')]);
            $this->_conn = null;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}