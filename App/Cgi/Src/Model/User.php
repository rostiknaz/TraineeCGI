<?php
namespace Cgi\Model;

use Orm\Interf\OrmInterface;
use Core\Model;

/**
 * Class User.
 * This class represent separate entity class of user table in database.
 */
class User extends Model implements OrmInterface
{
    public $errors;

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
     * Get access token
     *
     * @return string|null
     */
    public function getAccessToken()
    {
        return !isset($this->_user['access_token']) ? null : $this->_user['access_token'];
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
    public function setData($data)
    {
        $this->_user = $data;
    }

    public function validate($email, $password)
    {
        $result = false;
        if(empty($email)) {
            $this->errors[] = 'Email field is required!!';
        } else {
            $user = $this->_getUserByEmail($email);
            if(!empty($user)) {
                if(password_verify($password,$user['password'])){
                    $this->load($user[$this->_fieldIdName]);
                    $result = true;
                } else {
                    $this->errors[] = 'Password does not match!!!';
                }
            } else {
                $this->errors[] = 'Email is wrong!!';
            }
        }
        return $result;
    }

    private function _getUserByEmail($email)
    {
        $sql = 'SELECT * FROM' . ' ' . $this->_getTableName() . ' ' . 'WHERE  email = ?';
        $result = null;
        try {
            $sth = $this->_execute($sql,array($email));
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function setPasswordHash($password)
    {
        $this->_user['password'] = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setAccessToken()
    {
        $this->_user['access_token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['access_token']) && !empty($_SESSION['access_token']);
    }



}