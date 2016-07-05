<?php
namespace Vendor\Logger;

use Vendor\Logger\Abstr\LoggerAbstract;
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
     *
     * @param object $connect_db
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
     * @param string $message Log message.
     * @param string $type Log type.
     */
    protected function _write($message, $type){
        try {
            $statement = $this->_conn->prepare("INSERT INTO `log` (`message`, `type`, `creation_date`) VALUES (?, ?, ?)");
            $statement->execute([$message, $type, date('Y-m-d H:i:s')]);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}