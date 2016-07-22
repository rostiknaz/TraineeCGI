<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 12.07.16
 * Time: 12:15
 */

namespace Cgi\Controllers;


use Cgi\Model\User;
use Core\Controller;

class LoginController extends Controller
{

    public function actionIndex()
    {
        $data = [
            'title' => 'Login'
        ];
        $user = new User($this->_dbConn);
        if (isset($_POST) && !empty($_POST)) {
            $email = isset($_POST['email']) ? $this->_trimInjection($_POST['email']) : null;
            $password = isset($_POST['email']) ? $this->_trimInjection($_POST['password']) : null;
            if ($user->validate($email, $password)) {
                $_SESSION['first_name'] = $user->getFirstName();
                $_SESSION['last_name'] = $user->getLastName();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['access_token'] = $user->getAccessToken();
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/');
            } else {
                $data = [
                    'title' => 'Login',
                    'errors' => $user->errors
                ];
            }
        }
        if($user->isAuthenticated()) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/');
        }
        $this->_view->render('login_form',$data);
    }

    public function actionLogout()
    {
        session_destroy();
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/');
    }


}