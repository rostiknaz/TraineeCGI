<?php

namespace DB;

/**
 * Connection to database
 */
class Connect
{
    /**
     * @var null|object The single instance.
     */
    private static $_instance;
    /**
     * @var null|string Database config.
     */
    private $_dsn;
    /**
     * @var null|string Username database.
     */
    private $_username;
    /**
     * @var null|string Database password.
     */
    private $_password;
    /**
     * @var null|object Connection to db.
     */
    private $_dbh = null;

    /**
     * Set properties
     */
    private function __construct()
    {
        $config = $this->_getConfigData();
        $this->_dsn = $config['dsn'];
        $this->_username = $config['username'];
        $this->_password = $config['password'];
    }

    /**
     * Close connection.
     */
    public function __destruct()
    {
        $this->_dbh = null;
    }

    /**
	 * Get an instance of the Database
     *
	 * @return object
	*/
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
	 * Get config database data
     *
     * @return array
	 */
    private function _getConfigData()
    {
        return parse_ini_file('Config/config.ini');
    }

    /**
     * Connection to database
     *
     * @return object
     */
    public function connect()
    {
        return $this->_dbh = new \PDO($this->_dsn, $this->_username, $this->_password);
    }
    
    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
}