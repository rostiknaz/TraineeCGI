<?php
namespace Orm\Core;

use Orm\Helper\OrmAbstract;

/**
 * Class Model.
 * It contains methods and properties who help to work with database and are common for all of model.
 */
class Model extends OrmAbstract
{
    /**
     * @param null|object Connection to db.
     */
    protected $_conn = NULL;

    /**
     * Set connection property.
     */
    public function __construct($connect_db)
    {
        $this->_conn = $connect_db;
    }

    /**
     * Close connection to db.
     */
    public function __destruct()
    {
        $this->_conn = null;
    }

    /**
     * Get table name of a model.
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->getTableName();
    }

    /**
     * Get properties of object.
     *
     * @return array|null
     */
    protected function _getPropetries()
    {
        $properties = get_object_vars($this);
        $public_prop = [];
        foreach ($properties as $key => $prop) {
            if ($prop != NULL && !is_object($prop) && $key != '_tableName') {
                $public_prop[substr($key, 1)] = '"' . $prop . '"';
            }
        }
        return $public_prop;
    }

    /**
     * Fetch record by id
     *
     * @param int|string $id Record Id.
     *
     * @return mixed
     */
    protected function _getById($id)
    {
        $sql = 'SELECT * FROM' . ' ' . $this->getTableName() . ' '
             . 'WHERE id = ' . $id;
        try {
            $sth = $this->_conn->prepare($sql);
            $sth->execute();
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Update existing record in database.
     *
     * @return bool
     */
    protected function _update()
    {
        $update_array = [];
        foreach ($this->_getPropetries() as $key => $prop) {
            $update_array[] = $key . '=' . $prop . ' ';
        }
        try {
            $sql = 'UPDATE ' . $this->getTableName() . ' '
                 . 'SET ' . implode(', ',$update_array) . ' '
                 . 'WHERE id = ' . $this->getId();
            return $this->_execute($sql);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Create new record in database.
     *
     * @return bool
     */
    protected function _create()
    {
        try {
            $sql = 'INSERT INTO' . ' ' . $this->getTableName() . '(' . implode(', ',array_keys($this->_getPropetries())) . ') ' 
                 . 'VALUES(' . implode(', ',array_values($this->_getPropetries())) . ')';
            return $this->_execute($sql);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Delete record in database.
     *
     * @return bool
     */
    public function delete()
    {
        try {
            $sql = 'DELETE FROM' . ' ' . $this->getTableName() . ' '
                 . 'WHERE id = ' . $this->getId();
            return $this->_execute($sql);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Is new record or existing ?.
     *
     * @return bool
     */
    protected function _isNewRecord()
    {
        return $this->getId() == NULL ? true : false;
    }

    /**
     * Get record id.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getId();
    }

    /**
     * Helper function who execute sql query
     *
     * @param string $sql Query into database.
     * @param array|null $params Params for execute method.
     *
     * @return bool
     */
    protected function _execute($sql, $params = array())
    {
        $sth = $this->_conn->prepare($sql);
        $result = $sth->execute($params);
        return $result;
    }
}