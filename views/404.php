<?php $site = 404; include(ROOT.'/views/layouts/header.php'); ?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark elegant-color-dark">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
          aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                <div class="dropdown user-dropdown align-self-end">
                    <button class="btn btn-primary dropdown-toggle btn-blue btn-rounded" type="button" id="dropdownMenu1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><?php echo ($_SESSION['user']['name'].' '.$_SESSION['user']['surname']) ?></button>

                    <div class="dropdown-menu dropdown-primary dropdown-user">
                        <a class="dropdown-item" href="#"><i class="fal fa-user-circle fa-lg" aria-hidden="true" style="padding-right: 8px;"></i>Личный кабинет</a>
                        <a class="dropdown-item" href="#"><i class="far fa-calendar fa-lg" aria-hidden="true" style="padding-right: 8px;"></i>График</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-file-alt fa-lg" aria-hidden="true" style="padding-right: 8px;"></i>Мои проекты</a>
                        <a class="dropdown-item" href="/logout"><i class="fas fa-power-off fa-lg" aria-hidden="true" style="padding-right: 8px;"></i>Выйти</a>
                    </div>
                </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
          <a class="navbar-brand mr-5" href="/projects">Проекты МосПолитеха</a>
          <ul class="navbar-nav mt-lg-0">
          <li class="nav-item dropdown mr-4 mega-dropdown active">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Проекты
                    </a>
                    <div class="dropdown-menu mega-menu v-2 z-depth-1 elegant-color px-3" aria-labelledby="navbarDropdownMenuLink2">
                            <div class="row">
                            <a class="nav-link mx-3" href="/projects">Все</a>
                    <a class="nav-link mx-3" href="/projects/transport">Транспорт</a>
                    <a class="nav-link mx-3" href="/projects/tech">Технология</a>
                    <a class="nav-link mx-3" href="/projects/him">Химбиотех</a>
                    <a class="nav-link mx-3" href="/projects/energ">Энергетика</a>
                    <a class="nav-link mx-3" href="/projects/design">Дизайн</a>
                    <a class="nav-link mx-3" href="/projects/social">Социальные Технологии</a>
                    <a class="nav-link mx-3" href="/projects/initiativ">Инициативные проекты</a>
                        </div>
                        </div>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="/users">Участники</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="/teams">Команды</a>
                    </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
    <!-- 404 -->
    <h1 class="d-flex justify-content-center">404 PAGE NOT FOUND</h1>
                    <style type="text/css">
                        footer {
                        position: absolute;
                        
                        }
                    </style>

<?php include(ROOT.'/views/layouts/footer.php'); ?>