<?php
namespace App\Abstr;

use App\LoggerInterface;

abstract class Logger implements LoggerInterface
{
    protected  abstract function _write($message,$type);

    public function warning($message){
        $this->_write($message,LoggerInterface::TYPE_WARNING);
    }

    public function error($message){
        $this->_write($message,LoggerInterface::TYPE_ERROR);
    }

    public function notice($message){
        $this->_write($message,LoggerInterface::TYPE_NOTICE);
    }

}