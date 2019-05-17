<?php

class ProjectController
{
    public function actionIndex($projectId)
    {
        $already = false;
        $types = Project::getProjectTypes();
        $project = Project::getProjectById($projectId);
        if (isset($_POST['role']) && isset($_POST['add']) && isset($_SESSION['user']))
            Project::makeRequest($_SESSION['user']['id'], $_SESSION['user']['name'], $_SESSION['user']['surname'], $_SESSION['user']['course'], $_POST['role'], $projectId);
        else if (isset($_POST['cancel_req']) && isset($_POST['id']) && $_SESSION['user']['type'] == 'student')
            Project::cancelRequest($_SESSION['user']['id'], $projectId);
        else if (isset($_POST['cancel_req']) && isset($_POST['id']) && $_SESSION['user']['type'] == 'leader')
            Project::cancelRequest($_POST['id'], $projectId);
        else if (isset($_POST['cancel_apr']) && isset($_POST['id']))
            Project::cancelApproved($_POST['id'], $projectId);   
        else if (isset($_POST['add_req']) && isset($_POST['id']))
            Project::makeApproved($_POST['id'], $projectId);

        $requests = Project::getRequests($projectId);
        $approved = Project::getApproved($projectId);
        $approved_num = count($approved);

        if(isset($_SESSION['user']) && $_SESSION['user']['type'] == 'leader')
            $is_project_creator = ($project['creator_id'] == $_SESSION['user']['id']) ? TRUE : FALSE;

        if(isset($_SESSION['user']) && $_SESSION['user']['type'] == 'student')
            $result = Project::getRequestByUserAndId($_SESSION['user']['id'], $projectId);
        else
            $result = false;

        require(ROOT.'/views/project/index.phtml');
        return true;

    }
}