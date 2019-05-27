<?php

class ProfileController
{
    public function actionIndex() 
    {
        if(!isset($_SESSION['user']) || ($_SESSION['user']['type'] != 'admin' && $_SESSION['user']['type'] != 'leader'))
            header("Location: /");
        $types = Project::getProjectTypes();
        
        if ($_SESSION['user']['type'] == 'admin')
            require(ROOT.'/views/profile/profile-admin.phtml');
        else if ($_SESSION['user']['type'] == 'leader')
            require(ROOT.'/views/profile/profile-leader.phtml');
        return true;
    }

    public function actionNewType() 
    {
        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'admin')
            header("Location: /");
        $leaders = User::getTypeUsers("leader", true);
        $types = Project::getProjectTypes();
        if (isset($_POST['title']) && isset($_POST['leader']))
        {
            echo $_POST['leader'];
            User::setLeaderType($_POST['leader'], $_POST['title']);
            header("Location: /profile");
        }
        require(ROOT.'/views/profile/profile-newtype.phtml');
        return true;
    }

    public function actionShowAccs() 
    {
        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'admin')
            header("Location: /");
            
        $accs = User::getAllAccs();
        require(ROOT.'/views/profile/profile-showaccs.phtml');
        return true;
    }

    public function actionNewAccount() 
    {
        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'admin')
            header("Location: /");
        $types = Project::getProjectTypes();
        $errors = array();
        if (isset($_POST['name']))
        {
            $str_arr = preg_split("/[ ]+/", $_POST['name']);
            if (sizeof($str_arr) != 3)
                $errors[0] = 'Неправильно введено ФИО.';
            switch($_POST['type']) {
                case 0:
                    $_POST['type'] = 'student';
                    break;
                case 1:
                    $_POST['type'] = 'leader';
                    break;
                case 2:
                    $_POST['type'] = 'expert';
                    break;
            }
            if ($_POST['pswd'] != $_POST['accept'])
                $errors[1] = 'Неправильно введен пароль';
            if (sizeof($errors) < 1)
            {
                $hashed = hash('sha512', $_POST['pswd']);
                User::addUser($_POST['login'], $hashed, $_POST['type'], $_POST['position'], $str_arr);
                header("Location: /profile");
            }
        }
        require(ROOT.'/views/profile/profile-newacc.phtml');
        return true;
    }

    public function actionAdd()
    {

        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'leader')
            header("Location: /");

        $types = Project::getProjectTypes();
        $curators = User::getTypeUsers("curator");

        if (isset($_POST['title']))
        {
            Project::addProject($_POST['title'], $_POST['curator'], $_SESSION['user']['project_type'], $_POST['description'], $_POST['teams'].'/'.$_POST['size']);
            header("Location: /profile");
        }
        require(ROOT.'/views/project/add.phtml');
        return true;
    }
}