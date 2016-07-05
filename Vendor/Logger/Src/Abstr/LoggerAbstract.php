<?php
namespace Logger\Abstr;

use Logger\Interf\LoggerInterface;

/**
 * Abstract class LoggerAbstract
 * Implements LoggerInterface
 */
abstract class LoggerAbstract implements LoggerInterface
{
    /**
     * Declares method _write
     * @param $message
     * @param $type
     */
    protected  abstract function _write($message,$type);

    /**
     * Write a warning message
     * @param $message
     */
    public function warning($message){
        $this->_write($message,LoggerInterface::TYPE_WARNING);
    }

    /**
     * Write an error message
     * @param $message
     */
    public function error($message){
        $this->_write($message,LoggerInterface::TYPE_ERROR);
    }

    /**
     * Write a notice message
     * @param $message
     */
    public function notice($message){
        $this->_write($message,LoggerInterface::TYPE_NOTICE);
    }

}