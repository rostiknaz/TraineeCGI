<?php
namespace Orm\Helper;

use Orm\Core\OrmInterface;

abstract class QueryBuilder implements OrmInterface
{

    private $_sql;

    public function create()
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

    public function where($statement)
    {
        $this->_sql .= ' WHERE ' . $statement;
        return $this;
    }

    public function fetch($count = 'all')
    {
        try {
            $sth = $this->_conn->prepare($this->_sql);
            $sth->execute();
            switch ($count) {
                case 'all':
                    $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
                    break;
                case 'one':
                    $result = $sth->fetch(\PDO::FETCH_ASSOC);
                    break;
                default:
                    $result = false;
            }
//            $this->_conn = null;
            return $result;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function delete($where='')
    {
        try {
            $sql='DELETE FROM ' . $this->_getTableName();
            if($where != '') {
                $sql .= ' WHERE ' . $where;
            }
            return $this->_execute($sql);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    public function update($where)
    {
        $update_array = [];
        foreach ($this->_getPropetries() as $key => $prop) {
            $update_array[] = $key . '=' . $prop . ' ';
        }
        try {
            $sql='UPDATE ' . $this->_getTableName() . ' SET ' . implode(', ',$update_array) . ' WHERE '.$where;
            return $this->_execute($sql);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    
    abstract protected function _getTableName();

    abstract protected function _getPropetries();

    protected function _execute($sql,$params = array())
    {
        $sth = $this->_conn->prepare($sql);
        $result = $sth->execute($params);
//        $this->_conn = null;
        return $result;
    }

}