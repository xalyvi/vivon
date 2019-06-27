<?php

class ProjectController
{
    public function actionIndex($projectId)
    {
        $already = false;
        $types = Project::getProjectTypes();
        $project = Project::getProjectById($projectId);
        $teams = explode ('/', $project['team/students']);
        $capacity = $teams[0]*$teams[1];
        $requests = Project::getRequests($projectId);
        
        $app = 0;
        foreach($requests as $req)
            if ($req['app'] == 2)
                $app++;
        if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'student' && !isset($_SESSION['user']['team']))
            User::getReqs($_SESSION['user']['id']);

        $app .= '/'.$teams[0]*$teams[1];
        

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

    public function actionCreateTeam()
    {
        $types = Project::getProjectTypes();
        require(ROOT.'/views/project/create_team.phtml');
        return true;
    }

    public function actionProjectTeam()
    {
        $types = Project::getProjectTypes();
        require(ROOT.'/views/project/project_team.phtml');
        return true;
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
        $users = Project::getRequests($id);

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
            xheader('Location: /addCriteria-id'.$id);
        }
        require(ROOT.'/views/trash/criteria.phtml');
        return true;
    }
}