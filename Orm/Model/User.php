<?php
namespace Orm\Model;

use Orm\Core\Model;

/**
 * Class User.
 * This class represent separate entity class of user table in database.
 */
class User extends Model
{
    /**
     * @var string Table name.
     */
    protected $_tableName = 'user';

    /**
     * @var string|null User id.
     */
    protected $_id;
    /**
     * @var string|null User first name.
     */
    protected $_first_name;
    /**
     * @var string|null User last name.
     */
    protected $_last_name;
    /**
     * @var string|null User email.
     */
    protected $_email;

    /**
     * Call parent construct for connection to db.
     * 
     * @param object| $connect_db 
     */
    public function __construct($connect_db)
    {
        parent::__construct($connect_db);
    }
    

    /**
     * Get first name
     *
     * @return string|null
     */
    public function getFirstName(){
        return $this->_first_name;
    }
    
    /**
     * Get last name
     *
     * @return string|null
     */
    public function getLastName(){
        return $this->_last_name;
    }

    /**
     * Get user email
     *
     * @return string|null
     */
    public function getEmail(){
        return $this->_email;
    }
    
    /**
     * Get user id
     *
     * @return string|int|null
     */
    public function getId(){
        return $this->_id;
    }

    /**
     * Get table name
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->_tableName;
    }

    /**
     * Set first name
     *
     * @param string $first_name First name.
     */
    public function setFirstName($first_name){

        $this->_first_name = $first_name;
    }

    /**
     * Set last name
     *
     * @param string $last_name Last name.
     */
    public function setLastName($last_name){

        $this->_last_name = $last_name;
    }
    /**
     * Set user email
     *
     * @param string $email User email.
     */
    public function setEmail($email){

        $this->_email = $email;
    }

}