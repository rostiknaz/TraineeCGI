<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 21.07.16
 * Time: 18:33
 */

namespace Cgi\Helper;


class Validator
{
    public $errors;

    public function validateTextInput($text)
    {
        $result = true;
        if(strlen($text) >= 65535){
            $this->errors[] = 'The maximum number of characters allowed in the text inputs 65535';
            $result = false;
        }
        return $result;
    }

    public function validateVarcharInput($text)
    {
        $result = true;
        if(strlen($text) >= 255){
            $this->errors[] = 'The maximum number of characters allowed in the varchar inputs 255';
            $result = false;
        }
        return $result;
    }

    public function validateFloatInput($int)
    {
        $result = true;
        if(!is_numeric($int) || (abs($int) != $int)){
            $this->errors[] = 'Price does not valid!!!';
            $result = false;
        }
        return $result;
    }

    public function validateBoolInput($bool)
    {
        $result = true;
        if($bool != '0' && $bool != '1'){
            $this->errors[] = 'Status field does not valid';
            $result = false;
        }
        return $result;
    }
}