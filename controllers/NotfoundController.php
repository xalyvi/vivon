<?php

class NotfoundController
{
    public function actionIndex()
    {
        require_once(ROOT.'/views/404.phtml');
        return true;
    }
}