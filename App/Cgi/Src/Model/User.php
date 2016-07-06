<?php
namespace Cgi\Model;

use Orm\Interf\OrmInterface;
use Orm\Model;

/**
 * Class User.
 * This class represent separate entity class of user table in database.
 */
class User extends Model implements OrmInterface
{

    /**
     * @var array|null User data.
     */
    protected $_user;

    /**
     * Call parent construct for connection to db.
     * 
     * @param object $connect_db
     */
    public function __construct($connect_db)
    {
        parent::__construct($connect_db, $this->_getTableName(), $this->_getIdFieldName());
    }

    /**
     * Get table name
     *
     * @return string
     */
    protected function _getTableName()
    {
        return 'user';
    }

    /**
     * Get name of 'id' field
     *
     * @return string
     */
    protected function _getIdFieldName()
    {
        return 'user_id';
    }


    /**
     * Get all data
     *
     * @return array
     */
    protected function _getData()
    {
        return (array) $this->_user;
    }
    
    /**
     * Get record id
     *
     * @return int|null
     */
    public function getId()
    {
        return  !isset($this->_user['user_id']) ? null : $this->_user['user_id'];
    }

    /**
     * Get first name
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return !isset($this->_user['first_name']) ? null : $this->_user['first_name'];
    }
    
    /**
     * Get last name
     *
     * @return string|null
     */
    public function getLastName()
    {
        return !isset($this->_user['last_name']) ? null : $this->_user['last_name'];
    }

    /**
     * Get user email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return !isset($this->_user['email']) ? null : $this->_user['email'];
    }

    /**
     * Set first name
     *
     * @param string $first_name First name.
     */
    public function setFirstName($first_name)
    {
        $this->_user['first_name'] = $first_name;
    }

    /**
     * Set user id
     *
     * @param int|string $id User id.
     */
    protected function _setId($id)
    {
        $this->_user[$this->_getIdFieldName()] = $id;
    }
    /**
     * Set last name
     *
     * @param string $last_name Last name.
     */
    public function setLastName($last_name)
    {
        $this->_user['last_name'] = $last_name;
    }
    /**
     * Set user email
     *
     * @param string $email User email.
     */
    public function setEmail($email)
    {
        $this->_user['email'] = $email;
    }


    /**
     * Set data record.
     *
     * @param array $data
     */
    protected function _setData($data)
    {
        $this->_user = $data;
    }

}