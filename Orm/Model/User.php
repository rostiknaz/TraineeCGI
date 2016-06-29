<?php
namespace Orm\Model;

use Orm\Core\Model;
//use Orm\Helper\QueryBuilder;

class User extends Model
{

    protected $_tableName = 'user';
    
    public $first_name;
    public $last_name;

}