<?php

interface LoggerInterface
{
    const TYPE_WARNING = 'warning';
    const TYPE_NOTICE = 'notice';
    const TYPE_ERROR = 'error';

    public function warning($message);
    
    public function error($message);
    
    public function notice($message);
}


?>