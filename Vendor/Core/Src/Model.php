<?php
namespace Core;

use Orm\Interf\OrmInterface;
/**
 * Class Model.
 * It contains methods and properties who help to work with database and are common for all of model.
 */
abstract class Model implements OrmInterface
{
    /**
     * @var string Name of field "id".
     */
    protected $_fieldIdName;
    /**
     * @var null|string Table name.
     */
    protected $_tableName;
    
    /**
     * @var null|object Connection to db.
     */
    protected $_conn = NULL;

    /**
     * Set connection property and table name.
     *
     * @param object $connect_db
     * @param string $tableName Table name.
     * @param string|int $fieldIdName Id field name.
     */
    public function __construct($connect_db, $tableName, $fieldIdName)
    {
        $this->_conn = $connect_db;
        $this->_tableName = $tableName;
        $this->_fieldIdName = $fieldIdName;
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
     * @return array
     */
    abstract protected function _getData();

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
             . 'WHERE ' . $this->_fieldIdName . ' = ?';
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
                 . 'WHERE ' . $this->_fieldIdName . ' = ?';
            $params = array_values($data);
            array_push($params, $this->getId());
            $this->_execute($sql,$params);
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
                    $this->_setId($this->_conn->lastInsertId());
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
                     . 'WHERE ' . $this->_fieldIdName . ' = ?';
                $this->_execute($sql, array($this->getId()));
                $this->_setData(null);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


    /**
     * Set data record.
     *
     * @param array $data
     *
     * @return void
     */
    abstract protected function _setData($data);

    /**
     * Set record id.
     *
     * @param int|string $id
     */
    abstract protected function _setId($id);

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