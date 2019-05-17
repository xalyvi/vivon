<?php

class HomeController
{
    public function actionIndex($page = 1, $sort = false, $search = false)
    {
        $search = urldecode($search);
        $types = Project::getProjectTypes();
        $projects = Project::getProjects($page, false, $search, $sort);

        $total = Project::getTotalProjects(false, $search);
        
        $pagination = new Pagination($total, $page, Project::SHOW_BY_DEFAULT, 'page-');

        require(ROOT.'/views/home-page.phtml');

        return true;
    }

    public function actionCategory($category, $page = 1, $sort = false)
    {
        $projects = Project::getProjects($page, $category, false, $sort);
        $types = Project::getProjectTypes();
        $total = Project::getTotalProjects($category);

        $pagination = new Pagination($total, $page, Project::SHOW_BY_DEFAULT, 'page-');

        require(ROOT.'/views/home-page.phtml');

        return true;
    }
}