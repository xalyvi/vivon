<?php

class User
{
    public static function getUserById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT surname, name, patronymic, type, position, login FROM users WHERE id=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();
        if ($user)
            return $user;
        return false;
    }

    public static function updateUserById($id, $login, $type, $position, $fullname)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE users SET login = :login, type = :type, position = :position, surname = :surname, name = :name, patronymic = :patronymic WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->bindParam(':position', $position, PDO::PARAM_STR);
        $result->bindParam(':surname', $fullname[0], PDO::PARAM_STR);
        $result->bindParam(':name', $fullname[1], PDO::PARAM_STR);
        $result->bindParam(':patronymic', $fullname[2], PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function checkUserData($login, $password)
    {
        $db = Db::getConnection();
        
        $sql = 'SELECT id, pic, type, project_type, name, surname, patronymic, team FROM users WHERE login = :login AND pswd = :password';
        
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

    public static function getReqs($id)
    {
        $db = Db::getConnection();

        $reqs = array();
        $sql = 'SELECT `project_id` FROM `requests` WHER `requests`.`user_id`=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch())
        {
            $reqs[$i]['id'] = $row['project_id'];
            $i++;
        }
        $_SESSION['user']['reqs'] = $reqs;
    }

    public static function getAllAccs($type = false)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, login, pic, type, position, project_type, name, surname, patronymic FROM users WHERE NOT type = \'admin\'';
        if ($type)
            $sql .= ' AND type="'.$type.'"';
        $accs = array();
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch())
        {
            $accs[$i]['id'] = $row['id'];
            $accs[$i]['login'] = $row['login'];
            $accs[$i]['pic'] = $row['pic'];
            $accs[$i]['type'] = $row['type'];
            $accs[$i]['position'] = $row['position'];
            $accs[$i]['project_type'] = $row['project_type'];
            $accs[$i]['name'] = $row['name'];
            $accs[$i]['surname'] = $row['surname'];
            $accs[$i]['patronymic'] = $row['patronymic'];
            $i++;
        }
        return $accs;
    }

    public static function getLeaderbyCat($cat)
    {
        $db = Db::getConnection();
        $sql = 'SELECT project_type, p_type_des, name, surname, patronymic FROM users WHERE project_type = :cat';
        $result = $db->prepare($sql);
        $result->bindParam(':cat', $cat, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();
        if ($user) {
            return $user;
        }
        return false;
    }

    public static function getTypeUsers($type, $pr_type = false)
    {
        $db = Db::getConnection();
        $users = array();
        $sql = 'SELECT id, pic, name, surname, patronymic FROM users WHERE type = :type';
        if ($pr_type)
            $sql .= ' AND project_type IS NULL';
        $result = $db->prepare($sql);
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch())
        {
            $users[$i]['id'] = $row['id'];
            $users[$i]['pic'] = $row['pic'];
            $users[$i]['name'] = $row['name'];
            $users[$i]['surname'] = $row['surname'];
            $users[$i]['patronymic'] = $row['patronymic'];
            $i++;
        }
        return $users;
    }

    public static function addUser($login, $pswd, $type, $position, $name)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO users (login, pswd, pic, type, position, name, surname, patronymic) VALUES (:login, :pswd, "temp.png", :type, :position, :name, :surname, :patronymic)';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
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
