<?php

class User
{
    public static function checkUserData($login, $password)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT pic, type, name, surname, patronymic FROM users WHERE login = :login AND password = :password';
        
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

    public static function getLeaders()
    {
        $db = Db::getConnection();
        $leaders = array();
        $sql = 'SELECT id, name, surname, patronymic FROM users WHERE type="leader" AND project_type IS NULL';
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch())
        {
            $leaders[$i]['id'] = $row['id'];
            $leaders[$i]['name'] = $row['name'];
            $leaders[$i]['surname'] = $row['surname'];
            $leaders[$i]['patronymic'] = $row['patronymic'];
            $i++;
        }
        return $leaders;
    }

    public static function setLeaderType($id, $type)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE users SET type = :type WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->execute();
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