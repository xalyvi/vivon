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
           <!-- <?php if (isset($_SESSION['user'])): ?> -->
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

                if(preg_match("/\A\/$/i",$_SERVER['REQUEST_URI']) || preg_match("/\A\/page-[0-9]+$/i",$_SERVER['REQUEST_URI']) || preg_match("/\A\/projects$/i",$_SERVER['REQUEST_URI']) || preg_match("/\A\/projects\/page-[0-9]+$/i",$_SERVER['REQUEST_URI']))
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

                if(preg_match("/\A\/projects$/",$_SERVER['REQUEST_URI']) || preg_match("/\A\/projects\/page-[0-9]+$/i",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects">Все</a>
                <a class="nav-link mx-3';
                if(preg_match("/\btransport\b/i",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/transport">Транспорт</a>
                <a class="nav-link mx-3';
                if(preg_match("/\btech\b/i",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/tech">Технология</a>
                <a class="nav-link mx-3';
                if(preg_match("/\bhim\b/i",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/him">Химбиотех</a>
                <a class="nav-link mx-3';
                if(preg_match("/\benerg\b/i",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/energ">Энергетика</a>
                <a class="nav-link mx-3';
                if(preg_match("/\bdesign\b/i",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/design">Дизайн</a>
                <a class="nav-link mx-3';
                if(preg_match("/\bsocial\b/i",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/social">Социальные Технологии</a>
                <a class="nav-link mx-3';
                if(preg_match("/\binitiativ\b/i",$_SERVER['REQUEST_URI']))
                    echo ' selected';
                echo '" href="/projects/initiativ">Инициативные проекты</a>
                    </div>
                    </div>
                </li>
                <li class="nav-item mr-4';
                if(preg_match("/users/i",$_SERVER['REQUEST_URI']))
                    echo ' active';
                echo '">
                    <a class="nav-link" href="/users">Участники</a>
                </li>
                <li class="nav-item mr-4';
                if(preg_match("/teams/i",$_SERVER['REQUEST_URI']))
                    echo ' active';
                echo '">
                    <a class="nav-link" href="/teams">Команды</a>
                </li>';
            ?>
          </ul>
        </div>
      </div>
    </nav>
    
    <nav class="navbar navbar-expand-lg navbar-dark elegant-color">
      <div class="container">
        <div class="row w-100">
            <div class="input-group md-form form-sm form-2 pl-0 p-1 pt-3 m-0 col-12 col-xl-9 align-middle" style="height: 50px;">
                <input class="form-control my-0 py-1" id="search" type="text" placeholder="Название проекта" aria-label="Search">
                <div class="input-group-append">
                    <a class="input-group-text blue darken-2" id="link-search"><i class="fas fa-search text-white" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="col-12 col-xl-3">
                <p class="text-white m-1">Сортировка проектов</p>
                <select class="browser-default custom-select">
                    <option value="1">По дате (сначала новые)</option>
                    <option value="2">По дате (сначала старые)</option>
                    <option value="3">По заполненности (сначала заполненные)</option>
                    <option value="4">По заполненности (сначала пустые)</option>
                </select>
            </div>
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
                    <?php if ($project['image'] != 'none'): ?>
                    <img class="card-img-top" src="/template/img/<?php echo $project['image'] ?>" alt="Card image cap">
<?php else: ?>
                    <p>Нет Картинки</p>
<?php endif; ?>
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
        <?php if(isset($_SESSION['user']) && $_SESSION['user']['type'] == 'leader'): ?>
            <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
                    <a class="btn-floating btn-lg blue-gradient" href="/profile/addproject"><i class="fas fa-plus"></i></a>
            </div>
        <?php endif;?>
  </main>
    <footer class="py-3">
    © 2019 Московский политехнический университет
  </footer>
  <script>
    $(document).ready(function(){
        $("#search").blur(function(){
            $("#link-search").attr("href", "/projects/search-" + $("#search").val())
        });
    });
  </script>

<?php include(ROOT.'/views/layouts/footer.php'); ?>