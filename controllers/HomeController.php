<?php

class HomeController
{
    public function actionIndex($page = 1, $sort = false, $search = false)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'student')
            User::getReqs($_SESSION['user']['id']);
        $search = urldecode($search);
        $types = Project::getProjectTypes();
        $projects = Project::getProjects(0, $page, false, $search, $sort);

        $total = Project::getTotalProjects(false, $search);
        
        $pagination = new Pagination($total, $page, Project::SHOW_BY_DEFAULT, 'page-');

        require(ROOT.'/views/home-page.phtml');

        return true;
    }

    public function actionCategory($category, $page = 1, $sort = false)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'student')
            User::getReqs($_SESSION['user']['id']);
        $projects = Project::getProjects(0, $page, $category, false, $sort);
        $leader = User::getLeaderByCat($category);
        $types = Project::getProjectTypes();
        $total = Project::getTotalProjects($category);

        $pagination = new Pagination($total, $page, Project::SHOW_BY_DEFAULT, 'page-');

        require(ROOT.'/views/home-page.phtml');

        return true;
    }
}