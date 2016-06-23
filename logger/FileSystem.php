<?php
require_once ('Logger.php');

class FileSystem extends Logger
{

    protected function _write($message,$type){
        $config = parse_ini_file('config.ini');
        $fp = fopen($config['file_path'], "a");
        fwrite($fp,'Log ' . $type . ' message : ' . $message . ' || ' . date('Y-m-d H:i:s') . "\r\n");
        fclose($fp);
    }
}