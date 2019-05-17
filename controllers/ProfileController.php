<?php

class ProfileController
{
    public function actionIndex() 
    {
        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'admin')
            header("Location: /");

        require(ROOT.'/views/profile/profile.phtml');
        return true;
    }

    public function actionNewType() 
    {
        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'admin')
            header("Location: /");
        $leaders = User::getLeaders();

        if (isset($_POST['title']) && isset($_POST['leader']))
        {
            echo $_POST['leader'];
            User::setLeaderType($_POST['leader'], $_POST['title']);
            header("Location: /profile");
        }
        require(ROOT.'/views/profile/profile-newtype.phtml');
        return true;
    }

    public function actionNewAccount() 
    {
        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'admin')
            header("Location: /");

        require(ROOT.'/views/profile/profile-newacc.phtml');
        return true;
    }

    public function actionAdd()
    {

        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'leader')
            header("Location: /");

        require(ROOT.'/views/project/add.phtml');
        return true;
    }
}