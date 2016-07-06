<?php
namespace Logger;

/**
 * Class LoggerAdapter.
 *
 * Choose one of the method to write log messages.
 */
class LoggerAdapter
{

    /**
     * @var string|null Name of the logger class.
     */
    private $_loggerClassName;

    /**
     * Set class name of logger.
     */
    public function __construct()
    {
        $this->_loggerClassName = $this->_getLoggerClassName();
    }

    /**
     * Get logger class name.
     *
     * @return string
     */
    private function _getLoggerClassName()
    {
        $config = parse_ini_file('Config/configLog.ini');
        return (string) 'Logger\\' . $config['logger'] . 'Log';
    }

    /**
     * Get the logger class object  that is declared in the system.
     *
     * @param object $dbh Connect to db.
     *
     * @return object
     */
    public function getLoggerInstance($dbh = null) {
        return (object) new $this->_loggerClassName($dbh);
    }
}