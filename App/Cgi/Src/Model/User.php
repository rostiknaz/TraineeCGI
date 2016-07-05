<?php
namespace App\Model;

use Vendor\Orm\Model;

/**
 * Class User.
 * This class represent separate entity class of user table in database.
 */
class User extends Model
{

    /**
     * @var array|null User data.
     */
    protected $_data;

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
     * @return int|null
     */
    protected function _getData()
    {
        return  $this->_data;
    }
    
    /**
     * Get record id
     *
     * @return int|null
     */
    public function getId()
    {
        return  !isset($this->_data['id']) ? null : $this->_data['id'];
    }

    /**
     * Get first name
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return !isset($this->_data['first_name']) ? null : $this->_data['first_name'];
    }
    
    /**
     * Get last name
     *
     * @return string|null
     */
    public function getLastName()
    {
        return !isset($this->_data['last_name']) ? null : $this->_data['last_name'];
    }

    /**
     * Get user email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return !isset($this->_data['email']) ? null : $this->_data['email'];
    }

    /**
     * Set first name
     *
     * @param string $first_name First name.
     */
    public function setFirstName($first_name)
    {
        $this->_data['first_name'] = $first_name;
    }

    /**
     * Set last name
     *
     * @param string $last_name Last name.
     */
    public function setLastName($last_name)
    {
        $this->_data['last_name'] = $last_name;
    }
    /**
     * Set user email
     *
     * @param string $email User email.
     */
    public function setEmail($email)
    {
        $this->_data['email'] = $email;
    }

    /**
     * Unset data array
     */
    protected function _unsetData()
    {
        $this->_data = null;
    }

    /**
     * Set data record.
     *
     * @param array $data
     */
    protected function _setData($data)
    {
        $this->_data = $data;
    }

}