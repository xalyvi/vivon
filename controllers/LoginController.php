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
            $password = hash('sha512', $_POST['password']);
            
            
            $user = User::checkUserData($login, $password);
            
            if ($user == false) {
                $errors = true;
            } else {
                User::auth($user);
                if ($user['type'] == 'student' && !$user['team'])
                    User::getReqs($user['id']);
                header("Location: /projects");
            }
        }

        require(ROOT.'/views/login-page.phtml');
        return true;
    }

    public function actionLogout()
    {
        session_destroy();
        header("Location: /");
        return true;
    }
}