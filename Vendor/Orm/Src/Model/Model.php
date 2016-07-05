<?php
namespace Vendor\Orm;


use Vendor\Orm\Interf\OrmInterface;
/**
 * Class Model.
 * It contains methods and properties who help to work with database and are common for all of model.
 */
abstract class Model implements OrmInterface
{

    /**
     * @var null|string Table name.
     */
    protected $_tableName;
    
    /**
     * @var null|object Connection to db.
     */
    protected $_conn = NULL;

    /**
     * Set connection property.
     *
     * @param object $connect_db
     * @param string $tableName Table name.
     */
    public function __construct($connect_db, $tableName)
    {
        $this->_conn = $connect_db;
        $this->_tableName = $tableName;
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
    protected function _getTableName()
    {
        return $this->_tableName;
    }

    /**
     * Get record data.
     *
     * @return array|null
     */
    protected function _getData()
    {
        return $this->_getData();
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
        $sql = 'SELECT * FROM' . ' ' . $this->_getTableName() . ' '
             . 'WHERE id = ?';
        $result = null;
        try {
            $sth = $this->_execute($sql,array($id));
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    /**
     * Update existing record in database.
     *
     * @return void
     */
    protected function _update()
    {
        $update_array = [];
        $data = $this->_getData();
        foreach ($data as $key => $prop) {
            $update_array[] = $key . ' = ?';
        }
        try {
            $sql = 'UPDATE ' . $this->_getTableName() . ' '
                 . 'SET ' . implode(', ',$update_array) . ' '
                 . 'WHERE id = ?';
            $params = array_values($data);
            array_push($params, $this->getId());
            if($this->_execute($sql,$params)) {
                $this->load($this->getId());
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Create new record in database.
     *
     * @return void
     */
    protected function _create()
    {
        $data = $this->_getData();
        if(!empty($data)) {
            try {
                $sql = 'INSERT INTO' . ' ' . $this->_getTableName() . '(' . implode(', ', array_keys($data)) . ') '
                     . 'VALUES(' . implode(',', array_fill(0, count($data), '?')) . ')';

                if($this->_execute($sql, array_values($data))) {
                    $this->load($this->_conn->lastInsertId());
                }
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * Delete record in database.
     *
     * @return void
     */
    public function delete()
    {
        if (!$this->_isNewRecord()) {
            try {
                $sql = 'DELETE FROM' . ' ' . $this->_getTableName() . ' '
                    . 'WHERE id = ?';
                $this->_execute($sql, array($this->getId()));
                $this->_unsetData();
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * Unset object data record.
     *
     * @return void
     */
    abstract protected function _unsetData();

    /**
     * Set data record.
     *
     * @param array $data
     *
     * @return void
     */
    abstract protected function _setData($data);

    /**
     * Is new record or existing ?.
     *
     * @return bool
     */
    protected function _isNewRecord()
    {
        return (bool) $this->getId() == null;
    }

    /**
     * Get record id.
     *
     * @return int|string|null
     */
    abstract public function getId();

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
        $sth->execute($params);
        return $sth;
    }

    /**
     * Load record by id
     *
     * @param int|string $id Record Id.
     *
     * @return void
     */
    public function load($id)
    {
        $data = $this->_getById($id);
        if(!empty($data)) {
            $this->_setData($data);
        }
    }

    /**
     * Save record to database. If the record doesn't exist yet — add it.
     *
     * @return void
     */
    public function save()
    {
        if($this->_isNewRecord()) {
            $this->_create();
        } else {
            $this->_update();
        }
    }
}