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
    public function __construct(){
        $db = Connect::getInstance();
        $this->_conn = $db->connect();
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