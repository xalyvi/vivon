<?php $site = 'Добавить Проект'; include(ROOT.'/views/layouts/header.php'); ?>

<!-- Custom styles -->
<link href="/template/css/main.css" rel="stylesheet">
  <link href="/template/css/project.css" rel="stylesheet">
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
            <!-- <?php else: ?> -->
            <a class="btn btn-primary btn-blue btn-rounded btn-login" href="/login" style="align-self: flex-end;" type="button">Войти</a>
            <!-- <?php endif; ?> -->
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
  <main class="flex-fill">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/profile/projects">Мои Проекты</a></li>
                    <li class="breadcrumb-item active">Создание проекта</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center"><strong>Создание проекта</strong></h4>
                    <p class="text-left mb-1 red-text">* - обязательно для заполнения</p>
                    <form enctype="multipart/form-data" class="md-form mt-1 mb-1" action="" method="post">
                        <p class="text-left mb-1"><strong>1. Фото проекта</strong></p>
                        <div class="file-field">
                            <div class="btn btn-primary btn-sm float-left">
                                <span>Выбрать</span>
                                <input type="hidden" name="MAX_FILE_SIZE" value="1000000000000" />
                                <input type="file" name="photo" accept=".jpg, .jpeg, .png, .gif, .bmp">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" name="photo_name" type="text" placeholder="Имя файла">
                            </div>
                        </div>
                        <p class="text-left mt-3 mb-1"><strong>2. Название проекта</strong><span class="red-text"> *</span></p>
                        <div class="md-form mt-3">
                            <input type="text" name="title" id="materialSubscriptionFormPasswords" class="form-control" required>
                            <label for="materialSubscriptionFormPasswords">Название</label>
                        </div>
                        <p class="text-left mb-1"><strong>3. Описание проекта</strong></p>
                        <div class="md-form mt-3">
                            <textarea type="text" name="description" id="materialContactFormMessage" class="form-control md-textarea" rows="3"></textarea>
                            <label for="materialContactFormMessage">Описание</label>
                        </div>
                        <p class="text-left mb-1"><strong>4. Направление проекта</strong><span class="red-text"> *</span></p>
                        <select class="browser-default custom-select mb-3" name="fac" required>
                            <option value="" selected>Не выбрано</option>
                            <option value="1">Транспорт</option>
                            <option value="2">Технология</option>
                            <option value="3">Химбиотех</option>
                            <option value="4">Энергетика</option>
                            <option value="5">Дизайн</option>
                            <option value="6">Социальные технологии</option>
                            <option value="7">Инициативные проекты</option>
                        </select>
                        <p class="text-left mb-1"><strong>5. Количество человек на проекте</strong><span class="red-text"> *</span></p>
                        <select class="browser-default custom-select" name="size" required>
                            <option value="" selected>Не выбрано</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                        </select>
                        <button class="btn btn-info btn-block my-4" name="create" type="submit">Создать проект</button>
                    </form>
                </div>
            </div>
        </div>
  </main>
  <footer class="py-3">
    © 2019 Московский политехнический университет
  </footer>

<?php include(ROOT.'/views/layouts/footer.php'); ?>