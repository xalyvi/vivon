<?php

class HomeController
{
    public function actionIndex($page = 1, $search = false)
    {
        $projects = Project::getProjects($page, false, $search);

        $total = Project::getTotalProjects(false, $search);
        
        $pagination = new Pagination($total, $page, Project::SHOW_BY_DEFAULT, 'page-');

        require(ROOT.'/views/home-page.php');

        return true;
    }

    public function actionCategory($category, $page = 1)
    {
        $projects = Project::getProjects($page, $category, false);

        $total = Project::getTotalProjects($category);

        $pagination = new Pagination($total, $page, Project::SHOW_BY_DEFAULT, 'page-');

        require(ROOT.'/views/home-page.php');

        return true;
    }
}