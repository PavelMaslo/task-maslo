<?php

namespace app\controllers;

class LoginController
{
    function login()
    {
         session_start();
        $_SESSION["session_start"] = 'start';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["logout"])) {
                unset($_SESSION["authenticated"]);
                header('Location: /');
            } elseif (!empty($_POST["username"]) && !empty($_POST["password"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];

                if ($username == 'admin' && $password == '123') {
                    $_SESSION["authenticated"] = 'true';
                    header('Location: /');
                } else {
                    $msg = 'Invalid login or password. <br/> Please try again';
                }
            }
        }
        include('web/view/login.php');
    }
}