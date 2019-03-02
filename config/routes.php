<?php
return array (
    'projects/([a-z]+)/page-([0-9]+)' => 'home/category/$1/$2',
    'projects/page-([0-9]+)' => 'home/index/$1',
    'page-([0-9]+)' => 'home/index/$1',
    'projects/([a-z]+)' => 'home/category/$1',
    'projects' => 'home/index',
    'project/id-([0-9]+)' => 'project/index/$1',
    'profile/addproject' => 'profile/add',
    'login' => 'login/index',
    'logout' => 'login/logout',
    'notfound' => 'notfound/index',
    '' => 'home/index',
    );