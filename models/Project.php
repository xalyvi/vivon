<?php

class Project
{
    
    const SHOW_BY_DEFAULT = 6;

    public static function getProjects($status, $page = 1, $category = false, $search = false, $sort = false)
    {
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
        $db = Db::getConnection();
        
        $projectList = array();

        $sql = 'SELECT * FROM `projects` WHERE `status`>'.$status.' ';
        if ($category)
            $sql .= " AND type = '".$category."' ";
        else if ($search || $search != '')
            $sql .= 'AND (`projects`.`title` REGEXP "' . $search . '" OR `projects`.`curator` REGEXP "' . $search . '") ';
            
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
            $projectList[$i]['type'] = $row['type'];
            $projectList[$i]['curator'] = $row['curator'];
            $projectList[$i]['team/students'] = $row['team/students'];
            $projectList[$i]['description'] = $row['description'];
            $projectList[$i]['mes'] = $row['mes'];
            $i++;
        }
        
        return $projectList;
    }

    public static function getProjectsByLEC($id, $type)
    {
        $db = Db::getConnection();

        $projectList = array();
        $sql = 'SELECT `id`, `title`, `curator`, `type`, `status`, `criteria_sum`, `team/students`, `mes`, `timeCreated` FROM `projects` WHERE `curator_id` = :id';
        if ($type != NULL)
            $sql .= ' OR type = :type';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        if ($type != NULL)
            $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch())
        {
            $projectList[$i]['id'] = $row['id'];
            $projectList[$i]['title'] = $row['title'];
            $projectList[$i]['type'] = $row['type'];
            $projectList[$i]['curator'] = $row['curator'];
            $projectList[$i]['team/students'] = $row['team/students'];
            $projectList[$i]['mes'] = $row['mes'];
            $projectList[$i]['timeCreated'] = $row['timeCreated'];
            $projectList[$i]['status'] = $row['status'];
            $projectList[$i]['criteria_sum'] = $row['criteria_sum'];
            $i++;
        }
        return $projectList;
    }

    public static function addProject($title, $curator, $type, $des, $cap)
    {
        $db = Db::getConnection();
        $curator_id = (explode('/', $curator))[0];

        $sql = 'INSERT INTO projects (`image`, `curator`, `curator_id`, `title`, `description`, `type`, `team/students`) SELECT `users`.`pic`, :curator, `users`.`id`, :title, :descrip, :type, :cap FROM `users` WHERE `users`.`id` = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $curator_id, PDO::PARAM_INT);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':curator', $title, PDO::PARAM_STR);
        $result->bindParam(':descrip', $des, PDO::PARAM_STR);
        $result->bindParam(':cap', $cap, PDO::PARAM_STR);
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->execute();
    }

    public static function apdateProject($title, $curator, $type, $des, $cap)
    {
        $db = Db::getConnection();
        $curator_id = (explode('/', $curator))[0];

        $sql = 'UPDATE projects SET `image`=`users`.`pic`, `curator`=:curator, `curator_id`=`users`.`id`, `title`=:title, `description`=:descrip, `type`=:type, `team/students`=:cap FROM `users` WHERE `users`.`id` = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $curator_id, PDO::PARAM_INT);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':curator', $title, PDO::PARAM_STR);
        $result->bindParam(':descrip', $des, PDO::PARAM_STR);
        $result->bindParam(':cap', $cap, PDO::PARAM_STR);
        $result->bindParam(':type', $type, PDO::PARAM_STR);
        $result->execute();
    }

    public static function getProjectTypes()
    {
        $db = Db::getConnection();
        $types = array();
        $sql = 'SELECT project_type FROM users WHERE type="leader" AND NOT project_type IS NULL';
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch())
        {
            $types[$i] = $row['project_type'];
            $i++;
        }
        return $types;
    }
    
    public static function getTotalProjects($category = false, $search = false)
    {
        $db = Db::getConnection();
        
        if ($category)
            $result = $db->query("SELECT count(id) AS count FROM `projects` WHERE type = '" . $category ."'");
        else if ($search)
            $result = $db->query('SELECT count(id) AS count FROM `projects` WHERE `projects`.`title` REGEXP "' . $search . '" OR `projects`.`curator` REGEXP "' . $search . '"');
        else
            $result = $db->query('SELECT count(id) AS count FROM `projects`');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        
        return $row['count'];
    }

    public static function getProjectById($id)
    {
        $id = intval($id);
        
        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM projects WHERE id=' . $id); 
        $result->setFetchMode(PDO::FETCH_ASSOC);  
        $project = $result->fetch();
            
        return $project;
    }

    public static function getCriteriasById($id)
    {
        $db = Db::getConnection();

        $users = array();
        $sql = 'SELECT `criterias`.`code`, `criterias`.`name`, `criterias`.`evalday`, `criterias`.`produ`, `criterias`.`points`, `criterias`.`deadline`, `criterias`.`penalty`, `users`.`surname` AS exsurname, `users`.`name` AS exname, `users`.`patronymic` AS expatronymic, `users`.`pic` FROM `criterias`, `users` WHERE `criterias`.`project_id`=:id AND `criterias`.`expert_id`=`users`.`id`';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch())
        {
            $users[$i]['code'] = $row['code'];
            $users[$i]['name'] = $row['name'];
            $users[$i]['evalday'] = $row['evalday'];
            $users[$i]['produ'] = $row['produ'];
            $users[$i]['points'] = $row['points'];
            $users[$i]['deadline'] = $row['deadline'];
            $users[$i]['penalty'] = $row['penalty'];
            $users[$i]['exsurname'] = $row['exsurname'];
            $users[$i]['exname'] = $row['exname'];
            $users[$i]['expatronymic'] = $row['expatronymic'];
            $users[$i]['pic'] = $row['pic'];
            $i++;
        }
        return $users;
    }
    
    public static function getCriteriasPoints($id)
    {
        $id = intval($id);
        
        $db = Db::getConnection();
        $result = $db->query('SELECT `type`, `curator_id`, `criteria_sum` FROM projects WHERE id=' . $id); 
        $result->setFetchMode(PDO::FETCH_ASSOC);  
        $project = $result->fetch();
            
        return $project;
    }

    public static function addCriteria($id, $code, $name, $evalDay, $deadline, $procedure, $points, $expert, $penalty)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO `criterias` (`code`, `name`, `produ`, `points`, `expert_id`, `penalty`, `project_id`';
        if ($evalDay && $deadline)
            $sql .= ', `evalday`, `deadline`';
        $sql .= ') VALUES (:code, :name, :produ, :points, :expert_id, :penalty, :project_id';
        if ($evalDay && $deadline)
            $sql .= ', :evalday, :deadline';
        $sql .= ')';
        $result = $db->prepare($sql);
        $result->bindParam(':code', $code, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':produ', $procedure, PDO::PARAM_STR);
        $result->bindParam(':points', $points, PDO::PARAM_INT);
        $result->bindParam(':expert_id', $expert, PDO::PARAM_INT);
        $result->bindParam(':penalty', $penalty, PDO::PARAM_INT);
        $result->bindParam(':project_id', $id, PDO::PARAM_INT);
        if ($evalDay && $deadline) {
            $result->bindParam(':evalday', $evalDay, PDO::PARAM_STR);
            $result->bindParam(':deadline', $deadline, PDO::PARAM_STR);
        }
        $result->execute();
    }

    public static function getRequests($id)
    {
        $db = Db::getConnection();

        $users = array();
        $sql = 'SELECT `requests`.`user_id`, `users`.`pic`, `users`.`surname`, `users`.`name`, `users`.`patronymic`, `users`.`position`, `requests`.`team`, `requests`.`app` FROM `requests`, `users` WHERE `requests`.`project_id` = :id AND `requests`.`user_id` = `users`.`id`';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch())
        {
            $users[$i]['id'] = $row['user_id'];
            $users[$i]['pic'] = $row['pic'];
            $users[$i]['surname'] = $row['surname'];
            $users[$i]['name'] = $row['name'];
            $users[$i]['patronymic'] = $row['patronymic'];
            $users[$i]['position'] = $row['position'];
            $users[$i]['team'] = $row['team'];
            $users[$i]['app'] = $row['app'];
            $i++;
        }
        return $users;
    }

    public static function getRtoTeam($userid, $team, $project)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE `requests` SET `requests`.`app`=1, `requests`.`team`=:team WHERE `requests`.`project_id`=:project_id AND `requests`.`user_id`=:user_id';
        $result = $db->prepare($sql);
        $result->bindParam(':team', $team, PDO::PARAM_INT);
        $result->bindParam(':project_id', $project, PDO::PARAM_INT);
        $result->bindParam(':user_id', $userid, PDO::PARAM_INT);
        $result->execute();
    }

    public static function getFRout($userid, $project)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE `requests` SET `requests`.`app`=0, `requests`.`team`=NULL WHERE `requests`.`project_id`=:project_id AND `requests`.`user_id`=:user_id';
        $result = $db->prepare($sql);
        $result->bindParam(':project_id', $project, PDO::PARAM_INT);
        $result->bindParam(':user_id', $userid, PDO::PARAM_INT);
        $result->execute();
    }

    public static function setWorkStatus($id)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE `requests` SET `requests`.`app`=2 WHERE `requests`.`app`=1 AND `requests`.`project_id`=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $sql = 'DELETE FROM `requests` WHERE `requests`.`app`=0 AND `requests`.`project_id`=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $sql = 'UPDATE `projects` SET `status`=2 WHERE `projects`.`id`=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
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
}