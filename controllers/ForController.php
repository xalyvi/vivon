<?php

class ForController
{
    public function actionIndex()
    {
        User::checkLogged();
        require_once(ROOT.'/views/404.php');
        return true;
    }
}