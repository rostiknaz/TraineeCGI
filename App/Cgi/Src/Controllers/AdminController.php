<?php

namespace Cgi\Controllers;

use Core\Controller;

class AdminController extends Controller
{

    public function actionIndex()
    {
        $this->_view->render('Layouts/main.php','admin.php');
    }
}