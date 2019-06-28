<?php

class ProfileController
{
    public function actionIndex() 
    {
        if(!isset($_SESSION['user']))
            header("Location: /");
        
        $types = Project::getProjectTypes();
        
        switch($_SESSION['user']['type'])
        {
            case 'admin':
                require(ROOT.'/views/admin/profile.phtml');
                break;
            case 'curator':
                require(ROOT.'/views/profile/profile-curator.phtml');
                break;
            case 'leader':
                require(ROOT.'/views/profile/profile-leader.phtml');
                break;
            case 'expert':
                require(ROOT.'/views/profile/profile-expert.phtml');
                break;
            default:
                header("Location: /");
        }

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
            User::setLeaderType($_POST['leader'], $_POST['title']);
            header("Location: /profile");
        }
        require(ROOT.'/views/admin/newtype.phtml');
        return true;
    }

    public function actionShowAccs() 
    {
        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'admin')
            header("Location: /");
            
        $accs = User::getAllAccs();
        require(ROOT.'/views/admin/showaccs.phtml');
        return true;
    }

    public function actionAccountEdit($status, $id = false) 
    {
        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'admin')
            header("Location: /");
	if ($status != 1 && $id != false)
		$user = User::getUserById($id);
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
            case 3:
                 $_POST['type'] = 'curator';
        }
        if ($status == 1 && $_POST['pswd'] != $_POST['accept'])
            $errors[1] = 'Неправильно введен пароль';
        if (sizeof($errors) < 1)
        {
			if ($status == 1)
			{
				$hashed = hash('sha512', $_POST['pswd']);
                User::addUser($_POST['login'], $hashed, $_POST['type'], $_POST['position'], $str_arr);
			}
			else
				User::updateUserById($id, $_POST['login'], $_POST['type'], $_POST['position'], $str_arr);
                header("Location: /profile");
            }
        }
        require(ROOT.'/views/admin/newacc.phtml');
        return true;
    }

    public function actionAdd()
    {

        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'leader')
            header("Location: /");

        $edit = 0;
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

    public function actionEdit($id)
    {

        if(!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'leader')
            header("Location: /");

        $types = Project::getProjectTypes();
        $curators = User::getTypeUsers("curator");
        $project = Project::getProjectById($id);
        if ($project['type'] != $_SESSION['user']['project_type'])
            header('Location: /');
        $edit = 1;
        if (isset($_POST['title']))
        {
            Project::updateProject($_POST['title'], $_POST['curator'], $_SESSION['user']['project_type'], $_POST['description'], $_POST['teams'].'/'.$_POST['size']);
            header("Location: /profile");
        }
        require(ROOT.'/views/project/add.phtml');
        return true;
    }
}
