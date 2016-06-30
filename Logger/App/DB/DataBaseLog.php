<?php
namespace Logger\App\DB;

use Logger\App\Abstr\LoggerAbstract;
use DB\Connect;
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
    public function __construct($connect_db){
        $this->_conn = $connect_db;
    }

    /**
     * Close DB connection
     */
    public function __destruct()
    {
        $this->_conn = null;
    }

    /**
     * Writes a log message to database
     * 
     * @param $message
     * @param $type
     */
    protected function _write($message,$type){
        try {
            $statement = $this->_conn->prepare("INSERT INTO `log` (`message`, `type`, `creation_date`) values (?, ?, ?)");
            $statement->execute([$message, $type, date('Y-m-d H:i:s')]);
            $this->_conn = null;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}