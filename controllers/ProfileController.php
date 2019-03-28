<?php

class ProfileController
{
    public function actionAdd()
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['type'] == 'leader')
            header("Location: /");

        // Доделаю

        require(ROOT.'/views/project/add.phtml');
        return true;
    }
}