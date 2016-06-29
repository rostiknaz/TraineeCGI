<?php
namespace Orm\Helper;

use Orm\Core\OrmInterface;

abstract class OrmAbstract implements OrmInterface
{

    private $_sql;

    protected function _create()
    {
        try {
            $sql = 'INSERT INTO ' . $this->_getTableName()
                . '(' . implode(', ',array_keys($this->_getPropetries())) . ') VALUES('
                . implode(', ',array_values($this->_getPropetries())) . ')';
            return $this->_execute($sql);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function find()
    {
        $this->_sql = 'SELECT * FROM ' . $this->_getTableName();
        return $this;
    }

//    public function where($statement)
//    {
//        $this->_sql .= ' WHERE ' . $statement;
//        return $this;
//    }

//    public function fetch($count = 'all')
//    {
//        try {
//            $sth = $this->_conn->prepare($this->_sql);
//            $sth->execute();
//            switch ($count) {
//                case 'all':
//                    $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
//                    break;
//                case 'one':
//                    $result = $sth->fetch(\PDO::FETCH_ASSOC);
//                    break;
//                default:
//                    $result = false;
//            }
////            $this->_conn = null;
//            return $result;
//        } catch (\PDOException $e) {
//            die($e->getMessage());
//        }
//    }

    public function delete()
    {
        try {
            $sql='DELETE FROM ' . $this->_getTableName() . ' WHERE id=' . $this->getId();
            return $this->_execute($sql);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    protected function _update()
    {
        $update_array = [];
        foreach ($this->_getPropetries() as $key => $prop) {
            $update_array[] = $key . '=' . $prop . ' ';
        }
        try {
            $sql='UPDATE ' . $this->_getTableName() . ' SET ' . implode(', ',$update_array) . ' WHERE id=' . $this->getId();
            return $this->_execute($sql);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    abstract protected function _getPropetries();

    protected function _execute($sql,$params = array())
    {
        $sth = $this->_conn->prepare($sql);
        $result = $sth->execute($params);
//        $this->_conn = null;
        return $result;
    }
    
    abstract protected function _getTableName();
    
    abstract protected function _getById($id);
    
    abstract protected function _isNewRecord();

    public function load($id)
    {
        $data = $this->_getById($id);
        if(!empty($data)) {
            foreach ($data as $key => $value) {
                $key = '_'.$key;
                $this->$key = $value;
            }
        }
        return $this;
    }
    
    
    public function save()
    {
        if($this->_isNewRecord()){
            $this->_create();
        } else {
            $this->_update();
        }
    }



}