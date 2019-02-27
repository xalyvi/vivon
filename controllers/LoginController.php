<?php

class LoginController
{
    public function actionIndex()
    {
        if (isset($_SESSION['user']))
            header("Location: /");

        $errors = false;
        if (isset($_POST['password']) && isset($_POST['login'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            
            
            $user = User::checkUserData($login, $password);
            
            if ($user == false) {
                $errors = true;
            } else {
                User::auth($user);
                header("Location: /projects");
            }
        }

        require(ROOT.'/views/login-page.php');
        return true;
    }

    public function actionLogout()
    {
        session_unset();
        header("Location: /login");
    }
}