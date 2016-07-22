<?php

namespace Core;

use Cgi\Model\User;
use Core\View;

class Controller
{

    protected $_dbConn;
    protected $_view;

    public function __construct($conn_db = null)
    {
        session_start();
        $this->_view = new View();
        $this->_dbConn = $conn_db;
    }

    public function actionIndex()
    {

    }
    protected function _trimInjection($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}