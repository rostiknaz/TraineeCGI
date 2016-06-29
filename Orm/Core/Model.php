<?php
namespace Orm\Core;

use Orm\Helper\OrmAbstract;
use DB\Connect;

class Model extends OrmAbstract
{
    /**
     * Connection to DB
     */
    protected $_conn = NULL;

    /**
     * Connection process to DB
     */
    public function __construct()
    {
        $db = new Connect();
        $this->_conn = $db->connect();
    }

    public function __destruct()
    {
        $this->_conn = null;
    }

    protected function _getTableName()
    {
        return $this->_tableName;
    }

    protected function _getPropetries()
    {
        $properties = get_object_vars($this);
        $public_prop = [];
        foreach ($properties as $key => $prop) {
            if ($prop != NULL && !is_object($prop) && $key != '_tableName') {
                $public_prop[substr($key, 1)] = '"'.$prop.'"';
            }
        }
        return $public_prop;
    }

    protected function _getById($id)
    {
        $sql = 'SELECT * FROM ' . $this->_getTableName() . ' WHERE id=' . $id;
        try {
            $sth = $this->_conn->prepare($sql);
            $sth->execute();
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    
    protected function _isNewRecord()
    {
        return $this->getId() == NULL ? true : false;
    }

    public function getId()
    {
        return $this->getId();
    }
}