<?php
return array (
    'projects/search-(.*)/([ab][ab])/page-([0-9]+)' => 'home/index/$3/$2/$1',
    'projects/search-(.*)/page-([0-9]+)' => 'home/index/$2/no/$1/',
    'projects/search-(.*)/([ab][ab])' => 'home/index/1/$2/$1',
    'projects/search-(.*)' => 'home/index/1/no/$1',
    'projects/([а-яА-ЯЁёa-zA-Z]+)/([ab][ab])/page-([0-9]+)' => 'home/category/$1/$3/$2',
    'projects/([а-яА-ЯЁёa-zA-Z]+)/([ab][ab])' => 'home/category/$1/1/$2',
    'projects/([ab][ab])/page-([0-9]+)' => 'home/index/$2/$1',
    'projects/([а-яА-ЯЁёa-zA-Z]+)/page-([0-9]+)' => 'home/category/$1/$2',
    'projects/page-([0-9]+)' => 'home/index/$1',
    'page-([0-9]+)' => 'home/index/$1',
    'projects/([ab][ab])' => 'home/index/1/$1',
    'projects/([а-яА-ЯЁёa-zA-Z]+)' => 'home/category/$1',
    'projects' => 'home/index',
    'createTeam' => 'project/createTeam',
    'projectTeam' => 'project/projectTeam',
    'createCriteria' => 'project/createCriteria',
    'project/id-([0-9]+)' => 'project/index/$1',
    'profile/addProject' => 'profile/add',
    'profile/newtype' => 'profile/newtype',
    'profile/showaccs' => 'profile/showaccs',
    'profile/editacc/id([0-9]+)' => 'profile/accountEdit/2/$1',
    'profile/newacc' => 'profile/accountEdit/1',
    'profile' => 'profile/index',
    'login' => 'login/index',
    'logout' => 'login/logout',
    'notfound' => 'notfound/index',
    '' => 'home/index',
    );
