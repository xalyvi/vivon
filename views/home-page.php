<?php $site = 'Проекты'; include(ROOT.'/views/layouts/header.php'); ?>

<!-- Custom styles -->
  <link href="/template/css/main.css" rel="stylesheet">
</head>
    <body class="d-flex flex-column h-100">

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark elegant-color-dark">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
          aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
           <!-- <?php if (User::checkLogged()): ?> -->
                <div class="dropdown user-dropdown" style="align-self: flex-end;">
                    <button class="btn btn-primary dropdown-toggle btn-blue btn-rounded" type="button" id="dropdownMenu1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user']['name'].' '.$_SESSION['user']['surname']; ?></button>
        
                    <div class="dropdown-menu dropdown-primary dropdown-user">
                        <a class="dropdown-item" href="#"><i class="fal fa-user-circle fa-lg" aria-hidden="true" style="padding-right: 8px;"></i>Личный кабинет</a>
                        <a class="dropdown-item" href="#"><i class="far fa-calendar fa-lg" aria-hidden="true" style="padding-right: 8px;"></i>График</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-file-alt fa-lg" aria-hidden="true" style="padding-right: 8px;"></i>Мои проекты</a>
                        <a class="dropdown-item" href="logout"><i class="fas fa-power-off fa-lg" aria-hidden="true" style="padding-right: 8px;"></i>Выйти</a>
                    </div>
                </div>
            <!-- <?php else: ?> -->
                <a class="btn btn-primary btn-blue btn-rounded btn-login" href="/login" style="align-self: flex-end;" type="button">Войти</a>
            <!-- <?php endif; ?> -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
          <a class="navbar-brand mr-5" href="/projects">Проекты МосПолитеха</a>
          <ul class="navbar-nav mt-lg-0">
            <li class="nav-item dropdown mr-4 mega-dropdown
            <?php

                if(preg_match("~/projects",$_SERVER['REQUEST_URI']) || preg_match("~/projects/page-~",$_SERVER['REQUEST_URI']))
                    echo ' active';
            ?>
                ">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Проекты
                </a>
                <div class="dropdown-menu mega-menu v-2 z-depth-1 elegant-color px-3" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="row">
                        <a class="nav-link mx-3
            <?php

                if(preg_match("~/projects",$_SERVER['REQUEST_URI']) || preg_match("~/projects/page-~",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects">Все</a>
                <a class="nav-link mx-3';
                if(preg_match("~/projects/transport~",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/transport">Транспорт</a>
                <a class="nav-link mx-3';
                if(preg_match("~/projects/tech~",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/tech">Технология</a>
                <a class="nav-link mx-3';
                if(preg_match("~/projects/him~",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/him">Химбиотех</a>
                <a class="nav-link mx-3';
                if(preg_match("~/projects/energ~",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/energ">Энергетика</a>
                <a class="nav-link mx-3';
                if(preg_match("~/projects/design~",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/design">Дизайн</a>
                <a class="nav-link mx-3';
                if(preg_match("~/projects/social~",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/social">Социальные Технологии</a>
                <a class="nav-link mx-3';
                if(preg_match("~/projects/imitiativ~",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/initiativ">Инициативные проекты</a>
                    </div>
                    </div>
                </li>
                <li class="nav-item mr-4';
                if(preg_match("~/users",$_SERVER['REQUEST_URI']))
                    echo ' active';
                echo '">
                    <a class="nav-link" href="/users">Участники</a>
                </li>
                <li class="nav-item mr-4';
                if(preg_match("~/teams",$_SERVER['REQUEST_URI']))
                    echo ' active';
                echo '">
                    <a class="nav-link" href="/teams">Команды</a>
                </li>';
            ?>
          </ul>
        </div>
        
      </div>
    </nav>
  </header>

  <main class="flex-fill">
        <div class="container">
            <?php if ($total): ?>
                <?php foreach ($projects as $project): ?>
                <?php $approved_num = Project::getApprovedTeams($project['id']); ?>
                    <div class="card">
                    <div class="view overlay">
                    <img class="card-img-top" src="/template/img/<?php echo $project['image'] ?>" alt="Card image cap">
                    <a href="/project/id-<?php echo $project['id'] ?>">
                    <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                
                <div class="card-body">
                <h4 class="card-title"><strong><?php echo $project['title'] ?></strong></h4>
                <div class="row justify-content-between">
                    <h4 class="card-title col-lg-7 col-md-9"><strong>Руководитель: <?php echo $project['head'] ?></strong></h4>
                    <h4 class="pr-5 pl-3" style="width: 150px;"><i class="fas fa-users" aria-hidden="true" style="padding-right: 8px;"></i><?php echo ($approved_num.'/'.$project['capacity']) ?></h4>
                    </div>
                    <p class="card-text"><?php echo $project['description'] ?></p>
                    <hr>
                    <!-- Button -->
                    <div class="d-flex justify-content-center align-items-center">
                    <a href="/project/id-<?php echo $project['id'] ?>" class="text-primary">
                        <h4 class="waves-effect waves-light"><strong>Записаться</strong></h4>
                    </a>
                    </div>
                </div>
                </div>


                <?php endforeach; ?>
                
                <?php if ($total > 3) echo $pagination->get(); ?>
            <?php else: ?>
                <h1 class="d-flex justify-content-center">Для этого направления пока нет проектов</h1>
            <?php endif; ?>
        </div>
  </main>
    <footer class="py-3">
    © 2019 Московский политехнический университет
  </footer>

<?php include(ROOT.'/views/layouts/footer.php'); ?>