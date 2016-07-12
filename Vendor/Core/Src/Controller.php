<?php

namespace Core;

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
}