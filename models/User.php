<?php

class User
{
    public static function checkUserData($login, $password)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT pic, type, name, surname, patronymic FROM users WHERE login = :login AND pswd = :password';
        
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

    public static function addUser($login, $pswd, $type, $position, $name)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO users (login, pswd, pic, type, position, name, surname, patronymic) VALUES (:login, :pswd, "temp.png", :type, :position, :name, :surname, :patronymic)';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_INT);
        $result->bindParam(':pswd', $pswd, PDO::PARAM_STR);
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->bindParam(':position', $position, PDO::PARAM_STR);
        $result->bindParam(':name', $name[1], PDO::PARAM_STR);
        $result->bindParam(':surname', $name[0], PDO::PARAM_STR);
        $result->bindParam(':patronymic', $name[2], PDO::PARAM_STR);
        $result->execute();
    }

    public static function setLeaderType($id, $project_type)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE users SET project_type = :project_type WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':project_type', $project_type, PDO::PARAM_STR);
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