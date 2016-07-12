<?php

namespace Core;

use Core\View;

class Controller
{

    protected $_model;
    protected $_view;

    public function __construct()
    {
        $this->_view = new View();
    }

    public function actionIndex()
    {

    }
}