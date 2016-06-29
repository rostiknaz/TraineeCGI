<?php
namespace Orm\Core;

use Orm\Helper\QueryBuilder;
use DB\Connect;

class Model extends QueryBuilder
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

    protected function _getTableName()
    {
        return $this->_tableName;
    }

    protected function _getPropetries()
    {
        $properties = get_object_vars($this);
        $public_prop = [];
        foreach ($properties as $key => $prop) {
            if ($key[0] != '_') {
                $public_prop[$key] = '"'.$prop.'"';
            }
        }
        return $public_prop;
    }
}