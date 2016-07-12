<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 12.07.16
 * Time: 12:15
 */

namespace Cgi\Controllers;


use Core\Controller;

class LoginController extends Controller
{
    protected $_email;
    
    protected $_password;
    
    public function actionIndex()
    {
        $this->_view->render('Layouts/main', 'login_form');
    }

}