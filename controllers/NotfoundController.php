<?php

class NotfoundController
{
    public function actionIndex()
    {
        $types = Project::getProjectTypes();
        require_once(ROOT.'/views/404.phtml');
        return true;
    }
}