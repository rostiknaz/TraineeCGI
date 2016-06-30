<?php
namespace Orm\Helper;

use Orm\Core\OrmInterface;

/**
 * Abstract class OrmAbstract.
 * It contains an implementations main method of orm system
 */
abstract class OrmAbstract implements OrmInterface
{

    /**
     * Create new record in database.
     *
     * @return bool
     */
    abstract protected function _create();

    /**
     * Update existing record in database.
     *
     * @return bool
     */
    abstract protected function _update();

    /**
     * Fetch record by id
     * 
     * @param int|string $id Record Id.
     *
     * @return mixed
     */
    abstract protected function _getById($id);

    /**
     * Is new record or existing.
     *
     * @return bool
     */
    abstract protected function _isNewRecord();

    /**
     * Load record by id
     *
     * @param int|string $id Record Id.
     *
     * @return object
     */
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

    /**
     * Save record to database. If the record doesn't exist yet — add it.
     *
     * @return bool
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