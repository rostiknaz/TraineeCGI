<?php

namespace Core;


class App
{
    private static $_controllerName = 'Index';

    private static $_actionName = 'Index';

    public static function run()
    {

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if ( !empty($routes[1]) ) {
            self::$_controllerName = ucfirst($routes[1]);
        }

        // получаем имя экшена
        if ( !empty($routes[2]) ) {
            self::$_actionName = ucfirst($routes[2]);
        }

        // добавляем префиксы
        $controller_name = self::$_controllerName . 'Controller';
        $action_name = 'action' . self::$_actionName;


        // подцепляем файл с классом контроллера
        $controller_file = $controller_name . '.php';
        $controller_path = "App/Cgi/Src/Controllers/".$controller_file;
        if(file_exists($controller_path)) {
            $controllerName = "Cgi\\Controllers\\" . $controller_name;
            $controller = new $controllerName;
        } else {
            App::_ErrorPage404();
        }

        // создаем контроллер
        $action = $action_name;
        if(method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action();
        } else {
            App::_ErrorPage404();
        }

    }

    protected static function _ErrorPage404()
    {
        $controllerName = "Cgi\\Controllers\\IndexController";
        $controller = new $controllerName;
        $controller->actionError404();
        exit();
    }
}