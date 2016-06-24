<?php
namespace App\File;

use App\Abstr\LoggerAbstract;

/**
 * Writes a log data to file
 */
class FileSystemLog extends LoggerAbstract
{
    /**
     * Writes a log message to file
     *
     * @param $message
     * @param $type
     */
    protected function _write($message,$type){
        $config = parse_ini_file('Config/config.ini');
        if(is_writable($config['file_path'])) {
            $fp = fopen($config['file_path'], "a");
            fwrite($fp, 'Log ' . $type . ' message : ' . $message . ' || ' . date('Y-m-d H:i:s') . "\r\n");
            fclose($fp);
        } else {
            die('File have no permissions!!');
        }
    }
}