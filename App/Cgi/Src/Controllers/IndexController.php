<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 11.07.16
 * Time: 19:01
 */

namespace Cgi\Controllers;


use Core\Controller;
use Cgi\Model\User;

class IndexController extends Controller
{

    public function actionIndex()
    {
//        header('Location: http://www.example.com/');
    }

    public function actionError404()
    {
        $this->_view->render('Layouts/main','error404');
    }
}