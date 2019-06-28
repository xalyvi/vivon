<?php

class ProjectController
{
    public function actionIndex($projectId)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'student')
            User::getReqs($_SESSION['user']['id']);
        $project = Project::getProjectById($projectId);
        if ($project['criteria_sum'] != 100)
            header('Location: /');
        $types = Project::getProjectTypes();
        $teams = explode ('/', $project['team/students']);
        $capacity = $teams[0]*$teams[1];
        $reqs = Project::getRequests($projectId);
        
        $app = 0;
        $have = 0;
        foreach($reqs as $req)
        {
            if (isset($_SESSION['user']) && $req['id'] == $_SESSION['user']['id'])
                $have = 1;
            if ($req['app'] == 1)
                $app++;
        }

        if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'student' && !isset($_SESSION['user']['team']) && isset($_POST['req']))
        {
            User::addReq($_SESSION['user']['id'], $projectId);
            User::getReqs($_SESSION['user']['id']);
        }

        $app .= '/'.$teams[0]*$teams[1];

        if ($project['status'] > 1) {
            $shit = array();
            for($i = 0; $i < 3; $i++)
                $shit[$i] = 0;
            foreach($reqs as $req) {
                if ($req['app'] == 2 && isset($req['team'])) {
                    $shit[$req['team'] - 1]++;
                }
            }
        }
        

        require(ROOT.'/views/project/index.phtml');
        return true;

    }

    public function actionMyProjects()
    {
        if (isset($_SESSION['user']))
        {
            if ($_SESSION['user']['type'] != 'leader' && $_SESSION['user']['type'] != 'curator')
                header('Location: /');
        }
        else
            header('Location: /');
        $types = Project::getProjectTypes();
        $projects = Project::getProjectsByLEC($_SESSION['user']['id'], $_SESSION['user']['project_type']);
        require(ROOT.'/views/project/my-projects.phtml');
        return true;
    }

    public function actionProjectTeam($id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'student') {
            $reqs = Project::getRequests($id);
            $team = 0;
            foreach($reqs as $req)
                if ($req['user_id'] = $_SESSION['user']['id'])
                    $team = $req['team'];
            if ($team == 0)
                header('Location: /');
            $project = Project::getProjectById($id);
            $types = Project::getProjectTypes();
            require(ROOT.'/views/project/project_team.phtml');
            return true;
        }
        header('Location: /');
    }

    public function actionTeamMaking($id)
    {
        if (isset($_SESSION['user']))
        {
            if ($_SESSION['user']['type'] != 'leader' && $_SESSION['user']['type'] != 'curator')
                header('Location: /');
            $project = Project::getCriteriasPoints($id);
            if ($_SESSION['user']['project_type'] != $project['type'] && $_SESSION['user']['id'] != $project['curator_id'])
                header('Location: /myprojectlist');
        }
        else
            header('Location: /');
        $projectData = Project::getProjectById($id);
        $types = Project::getProjectTypes();
        $reqs = Project::getRequests($id);
        $temp = explode('/', $projectData['team/students']);
        $teams = $temp[0];
        $cap = $temp[1];
        $shit = array();
        $no = 0;
        $setup = 0;
        for($i = 0; $i < $teams; $i++)
            $shit[$i] = 0;
        foreach($reqs as $req) {
            if ($req['app'] == 1 && isset($req['team'])) {
                $setup = 1;
                $shit[$req['team'] - 1]++;
            }
        }
        foreach($shit as $blu) {
            if ($blu == $cap)
                $no = 1;
            else {
                $no = 0;
                break;
            }
        }
        if (isset($_POST['addToTeam']))
            Project::getRtoTeam($_POST['addToTeam'], $_POST['team'], $id);
        if (isset($_POST['delDom']))
            Project::getFRout($_POST['delDom'], $id);
        if (isset($_POST['welcome'])) {
            Project::setWorkStatus($id);
            header('Location: /myprojectlist');
        }

        require(ROOT.'/views/trash/project_edit.phtml');
        return true;
    }

    public function actionCreateCriteria($id)
    {
        if (isset($_SESSION['user']))
        {
            if ($_SESSION['user']['type'] != 'leader' && $_SESSION['user']['type'] != 'curator')
                header('Location: /');
            $project = Project::getProjectById($id);
            if ($_SESSION['user']['project_type'] != $project['type'] && $_SESSION['user']['id'] != $project['curator_id'])
                header('Location: /myprojectlist');
        }
        else
            header('Location: /');
        $criterias = Project::getCriteriasById($id);
        $types = Project::getProjectTypes();
        $experts = User::getTypeUsers('expert');
        $projectData = Project::getProjectById($id);
        $reqs = Project::getRequests($id);
        $temp = explode('/', $projectData['team/students']);
        $teams = $temp[0];
        $cap = $temp[1];
        $shit = array();
        $no = 0;
        $setup = 0;
        for($i = 0; $i < $teams; $i++)
            $shit[$i] = 0;
        foreach($reqs as $req) {
            if ($req['app'] == 1 && isset($req['team'])) {
                $setup = 1;
                break;
            }
        }
        if (isset($_POST['points']) && $_POST['points'] > 0 && $_POST['points'] <= 10 && $_POST['points'] + $project['criteria_sum'] <= 100) {
            $evalDay;
            $deadline;
            if (isset($_POST['anyDay'])) {
                $evalDay = null;
                $deadline = null;
            } else {
                $evalDay = $_POST['evalday']. ' 09:00:00';
                $deadline = $_POST['deadline']. ' 21:00:00';
            }
            Project::addCriteria($id, $_POST['code'], $_POST['name'], $evalDay, $deadline, $_POST['procedure'], $_POST['points'], $_POST['expert'], $_POST['penalty']);
            header('Location: /addCriteria-id'.$id);
        }
        if (isset($_POST['welcome'])) {
            Project::setWorkStatus($id);
            header('Location: /myprojectlist');
        }
        require(ROOT.'/views/trash/criteria.phtml');
        return true;
    }
}