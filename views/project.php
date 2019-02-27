<?php $site = 'Проект'; include(ROOT.'/views/layouts/header.php'); ?>

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

  <main class="flex-fill">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/projects">Проекты</a></li>
                        <li class="breadcrumb-item"><a href="/projects/<?php echo $project['fac']; ?>"><?php echo $category; ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $project['title']; ?></li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="view overlay">
                        <img class="card-img-top" src="/template/img/<?php echo $project['image']; ?>" alt="Card image cap">
                    </div>
            
                    <div class="card-body">
                        <h4 class="card-title"><strong><?php echo $project['title']; ?></strong></h4>
                        <div class="row justify-content-between">
                            <h4 class="card-title col-lg-7 col-md-9"><strong>Руководитель: <?php echo $project['head']; ?></strong></h4>
                            <h4 class="pr-5 pl-3" style="width: 150px;"><i class="fas fa-users" aria-hidden="true" style="padding-right: 8px;"></i><?php echo $approved_num.'/'.$project['capacity']; ?></h4>
                        </div>
                        <p class="card-text"><?php echo $project['description']; ?></p>

            <?php if (isset($requests[0])): ?>
                <hr>
                <div class="d-flex justify-content-center align-items-center">
                    <h5><strong>Поданные заявки</strong></h5>
                </div>
                <div class="table-responsive">
                    <!--Table-->
                    <table id="tablePreview" class="table table-striped table-sm text-nowrap">
                        <!--Table head-->
                        <thead>
                            <tr>
                                <th><strong>Имя</strong></th>
                                <th><strong>Фамилия</strong></th>
                                <th><strong>Курс</strong></th>
                                <th><strong>Роль</strong></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                <?php foreach ($requests as $request): ?>
                    <tr>
                            <td class="align-middle"><?php echo $request['name']; ?></td>
                            <td class="align-middle"><?php echo $request['surname']; ?></td>
                            <td class="align-middle"><?php echo $request['course']; ?></td>
                            <td class="align-middle"><?php echo $request['role']; ?></td>
                    <?php if ($request['user_id'] == $_SESSION['user']['id'] || $_SESSION['user']['type'] == 'admin' || ($_SESSION['user']['type'] == 'teacher' && $is_project_creator)): ?>
                    <?php $already = true; ?>
                        <td class="align-middle">
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $request['user_id']; ?>">
                                <input type="submit" class="btn btn-primary btn-rounded btn-sm" name="cancel_req" value="Отменить">
                            </form>
                        </td>
                    <?php else: ?>
                        <td class="align-middle"></td>
                    <?php endif; ?>
                    <?php if ($_SESSION['user']['type'] == 'admin' || ($_SESSION['user']['type'] == 'teacher' && $is_project_creator)): ?>
                        <td class="align-middle">
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $request['user_id']; ?>">
                                <input type="submit" class="btn btn-primary btn-rounded btn-sm" name="add_req" value="Добавить">
                            </form>
                        </td>
                    <?php else: ?>
                        <td class="align-middle"></td>
                    <?php endif; ?>
                    </tr>
        <?php endforeach; ?>
                </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
        <?php endif; ?>

        <?php  if (isset($approved[0])): ?> 
                <div class="d-flex justify-content-center align-items-center">
                    <h5><strong>Сформированная команда</strong></h5>
                </div>
                <div class="table-responsive">
                    <!--Table-->
                    <table id="tablePreview" class="table table-striped table-sm text-nowrap">
                        <!--Table head-->
                        <thead>
                            <tr>
                                <th><strong>Имя</strong></th>
                                <th><strong>Фамилия</strong></th>
                                <th><strong>Курс</strong></th>
                                <th><strong>Роль</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>

                <?php foreach ($approved as $approved_item): ?>
                    <tr>
                            <td class="align-middle"><?php echo $approved_item['name']; ?></td>
                            <td class="align-middle"><?php echo $approved_item['surname']; ?></td>
                            <td class="align-middle"><?php echo $approved_item['course']; ?></td>
                            <td class="align-middle"><?php echo $approved_item['role']; ?></td>
                            <?php if ($approved_item['user_id'] == $_SESSION['user']['id'] || $_SESSION['user']['type'] == 'admin' || ($_SESSION['user']['type'] == 'teacher' && $is_project_creator)): ?>
                            <?php $already = true; ?>
                        <td class="align-middle">
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $approved_item['user_id'] ?>">
                                <input type="submit" class="btn btn-primary btn-rounded btn-sm" name="cancel_apr" value="Отменить">
                            </form>
                        </td>
        <?php else: ?>
                        <td class="align-middle"></td>
        <?php endif; ?>
                    </tr>
                <? endforeach; ?>
                </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
        <?php endif; ?>

                <?php if ($_SESSION['user']['type'] == 'student' && !$already): ?>
                    <form action="" method="post">
                            <div class="row justify-content-center d-flex align-items-center text-center">
                                <input type="text" class="form-control col-8 col-sm-4 mr-4" name="role" placeholder="Ваша роль">
                                <input type="submit" class="btn btn-primary btn-rounded" name="add" value="Подать заявку">
                            </div>
                        </form>';
                <?php endif; ?>
                  </div>
                    </div>
                </div>
  </main>
  <footer class="py-3">
    © 2019 Московский политехнический университет
  </footer>

<?php include(ROOT.'/views/layouts/footer.php'); ?>