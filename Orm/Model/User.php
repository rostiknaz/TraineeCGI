<?php
namespace Orm\Model;

use Orm\Core\Model;
//use Orm\Helper\QueryBuilder;

class User extends Model
{

    protected $_tableName = 'user';

    protected $_id;
    protected $_first_name;
    protected $_last_name;
    protected $_email;
    
    public function __construct($connect_db)
    {
        parent::__construct($connect_db);
    }

//    public function __call($name, $arguments)
//    {
//        $strim = mb_strimwidth($name, 0, 3);
//        print_r($strim);
//    }

    public function getFirstName(){
        return $this->_first_name;
    }

    public function getLastName(){
        return $this->_last_name;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function getId(){
        return $this->_id;
    }

    public function getTableName()
    {
        return $this->_tableName;
    }

    public function setFirstName($first_name){

        $this->_first_name = $first_name;
    }

    public function setLastName($last_name){

        $this->_last_name = $last_name;
    }
    public function setEmail($email){

        $this->_email = $email;
    }

}