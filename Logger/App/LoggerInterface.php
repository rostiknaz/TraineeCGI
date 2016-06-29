<?php
namespace Logger\App;

/**
 * Declares methods and constants of app
 */
interface LoggerInterface
{
    const TYPE_WARNING = 'warning';
    const TYPE_NOTICE  = 'notice';
    const TYPE_ERROR   = 'error';

    /**
     * Declare warning method
     * @param $message
     */
    public function warning($message);

    /**
     * Declare error method
     * @param $message
     */
    public function error($message);

    /**
     * Declare notice method
     * @param $message
     */
    public function notice($message);
}


?>