<?php

class User
{
    public static function checkUserData($login, $password)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT id, type, course, name, surname FROM users WHERE login = :login AND password = :password';
        
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        
        $user = $result->fetch();
        if ($user) {
            return $user;
        }
        
        return false;
    }

    public static function auth($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        
        header("Location: /login");
    }
}