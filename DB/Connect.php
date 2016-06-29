<?php

namespace DB;
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 28.06.16
 * Time: 13:50
 */
class Connect
{

    private $_dsn;
    private $_username;
    private $_password;
    private $_dbh = null;

    public function __construct()
    {
        $config = $this->_getConfigData();
        $this->_dsn = $config['dsn'];
        $this->_username = $config['username'];
        $this->_password = $config['password'];
    }

    public function __destruct()
    {
        $this->_dbh = null;
    }

    private function _getConfigData()
    {
        return parse_ini_file('Config/config.ini');
    }

    public function connect()
    {
        return $this->_dbh = new \PDO($this->_dsn, $this->_username, $this->_password);
    }
}