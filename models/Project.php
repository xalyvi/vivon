<?php

class Project
{
    
    const SHOW_BY_DEFAULT = 3;

    public static function getProjects($page = 1, $category = false, $search = false, $sort = false)
    {
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
        $db = Db::getConnection();
        
        $projectList = array();
        
        if ($category)
            $sql = "SELECT id, title, image, head, capacity, description " . "FROM projects " . "WHERE fac = '".$category."' ";
        else if ($search)
            $sql = 'SELECT id, title, image, head, capacity, description ' . 'FROM projects WHERE title REGEXP "' . $search . '" OR head REGEXP "' . $search . '" ';
        else
            $sql = 'SELECT id, title, image, head, capacity, description ' . 'FROM projects ';
            
        if ($sort != false)
        {
            switch($sort) {
                case 'aa':
                    $sql .= 'ORDER BY timeCreated DESC ';
                    break;
                case 'ab':
                    $sql .= 'ORDER BY timeCreated ASC ';
                    break;
            }
        }
        else
            $sql .= 'ORDER BY timeCreated DESC ';
        $sql .= 'LIMIT ' .self::SHOW_BY_DEFAULT. ' OFFSET ' . $offset;
        $result = $db->query($sql);
        $i = 0;
        while($row = $result->fetch()) {
            $projectList[$i]['id'] = $row['id'];
            $projectList[$i]['title'] = $row['title'];
            $projectList[$i]['image'] = $row['image'];
            $projectList[$i]['head'] = $row['head'];
            $projectList[$i]['capacity'] = $row['capacity'];
            $projectList[$i]['description'] = $row['description'];
            $i++;
        }
        
        return $projectList;
    }
    
    public static function getTotalProjects($category = false, $search = false)
    {
        $db = Db::getConnection();
        
        if ($category)
            $result = $db->query("SELECT count(id) AS count FROM projects WHERE fac = '" . $category ."'");
        else if ($search)
            $result = $db->query('SELECT count(id) AS count FROM projects WHERE title REGEXP "' . $search . '" OR head REGEXP "' . $search . '"');
        else
            $result = $db->query('SELECT count(id) AS count FROM projects');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        
        return $row['count'];
    }

    public static function getProjectById($id)
    {
        $id = intval($id);
        
        if ($id) {
            
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM projects WHERE id=' . $id);
            
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            $catalogItem = $result->fetch();
            
            return $catalogItem;
        }
    }

    public static function getApprovedTeams($projectId)
    {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT count(id) AS count FROM approved WHERE project_id=' . $projectId);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        
        return $row['count'];
    }

    public static function makeRequest($userId, $userName, $userSurname, $userCourse, $role, $projectId)
    {
        
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO requests (user_id, name, surname, course, role, project_id)' . 'VALUES (:user_id, :name, :surname, :course, :role, :project_id)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':name', $userName, PDO::PARAM_INT);
        $result->bindParam(':surname', $userSurname, PDO::PARAM_INT);
        $result->bindParam(':course', $userCourse, PDO::PARAM_INT);
        $result->bindParam(':role', $role, PDO::PARAM_STR);
        $result->bindParam(':project_id', $projectId, PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        
        return 0;
    }

    public static function getRequestByUserAndId($userId, $projectId)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM requests WHERE user_id = :user_id AND project_id = :projectId';

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':project_id', $projectId, PDO::PARAM_STR);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
            
        $requestItem = $result->fetch();

        return $requestItem;
    }

    public static function cancelRequest($userId, $projectId)
    {
        $db = Db::getConnection();
        
        $sql = 'DELETE FROM requests WHERE user_id = :id AND project_id = :project_id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        $result->bindParam(':project_id', $projectId, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function cancelApproved($userId, $projectId)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM approved WHERE user_id = :user_id AND project_id = :project_id';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':project_id', $projectId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $student = $result->fetch();

        $sql = 'INSERT INTO requests (user_id, name, surname, course, role, project_id)' . ' VALUES (:user_id, :name, :surname, :course, :role, :project_id)';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':name', $student['name'], PDO::PARAM_STR);
        $result->bindParam(':surname', $student['surname'], PDO::PARAM_STR);
        $result->bindParam(':course', $student['course'], PDO::PARAM_INT);
        $result->bindParam(':role', $student['role'], PDO::PARAM_STR);
        $result->bindParam(':project_id', $projectId, PDO::PARAM_STR);
        $result->execute();

        $sql = 'DELETE FROM approved WHERE user_id = :id AND project_id = :project_id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        $result->bindParam(':project_id', $projectId, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function makeApproved($userId, $projectId)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM requests WHERE user_id = :user_id AND project_id = :project_id';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':project_id', $projectId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $student = $result->fetch();

        $sql = 'INSERT INTO approved (user_id, name, surname, course, role, project_id)' . ' VALUES (:user_id, :name, :surname, :course, :role, :project_id)';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':name', $student['name'], PDO::PARAM_STR);
        $result->bindParam(':surname', $student['surname'], PDO::PARAM_STR);
        $result->bindParam(':course', $student['course'], PDO::PARAM_INT);
        $result->bindParam(':role', $student['role'], PDO::PARAM_STR);
        $result->bindParam(':project_id', $projectId, PDO::PARAM_STR);
        $result->execute();

        $sql = 'DELETE FROM requests WHERE user_id = :id AND project_id = :project_id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        $result->bindParam(':project_id', $projectId, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function getRequests($projectId)
    {
        $projectId = intval($projectId);
   
        $db = Db::getConnection();
        
        $requests = array();
            
        $result = $db->query("SELECT user_id, name, surname, course, role FROM requests WHERE project_id = ".$projectId);
        $i = 0;
        while($row = $result->fetch()) {
            $requests[$i]['user_id'] = $row['user_id'];
            $requests[$i]['name'] = $row['name'];
            $requests[$i]['surname'] = $row['surname'];
            $requests[$i]['course'] = $row['course'];
            $requests[$i]['role'] = $row['role'];
            $i++;
        }
        
        return $requests;
    }

    public static function getOrderById($project_id)
    {
        $project_id = intval($project_id);
        
        $db = Db::getConnection();
        
        $sql = 'SELECT * FROM requests WHERE project_id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $project_id, PDO::PARAM_INT);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $result->execute();
        
        return $result->fetch();
    }

    public static function getApproved($project_id)
    {
        $db = Db::getConnection();
        
        $requests = array();
            
        $result = $db->query("SELECT user_id, name, surname, course, role FROM approved WHERE project_id = ".$project_id);
        $i = 0;
        while($row = $result->fetch()) {
            $requests[$i]['user_id'] = $row['user_id'];
            $requests[$i]['name'] = $row['name'];
            $requests[$i]['surname'] = $row['surname'];
            $requests[$i]['course'] = $row['course'];
            $requests[$i]['role'] = $row['role'];
            $i++;
        }
        
        return $requests;
    }
}