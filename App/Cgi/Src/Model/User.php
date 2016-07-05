<?php
namespace Cgi\Model;

use Orm\Model;

/**
 * Class User.
 * This class represent separate entity class of user table in database.
 */
class User extends Model
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
        parent::__construct($connect_db, $this->_getTableName());
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
     * Get all data
     *
     * @return array|null
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
        return  !isset($this->_user['id']) ? null : $this->_user['id'];
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
     * Unset data array
     */
    protected function _unsetData()
    {
        $this->_user = null;
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