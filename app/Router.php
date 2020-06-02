<?php

namespace app;


class Router
{
    function start()
    {
        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $routing = [
            '/' => ['controller' => 'Tasks', 'action' => 'findTask'],
            '/login' => ['controller' => 'Login', 'action' => 'login'],
            '/task/update' => ['controller' => 'Tasks', 'action' => 'updateTask'],
            '/task/add' => ['controller' => 'Tasks', 'action' => 'addTask'],
        ];
        if (isset($routing[$route])) {
            $controller = '\\app\\controllers\\' . $routing[$route]['controller'] . 'Controller';
            if (class_exists($controller)) {
                $controller_obj = new $controller;

                $controller_obj->{$routing[$route]['action']}();
            } else {
                echo 'Нет такого класса: ' . $controller;
            }
        } else {
            if (stristr($route, '.') == '.js') {
               echo file_get_contents(ltrim($route, '/'));
            } else {
                echo 'Нет такого маршрута!';
            }
        }
    }
}