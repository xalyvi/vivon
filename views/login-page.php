<?php $site = 'Login'; include(ROOT.'/views/layouts/header.php'); ?>

<!-- Custom styles -->
<link href="/template/css/login.css" rel="stylesheet">
<style type="text/css">
    /* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
</style>
  </head>
    <body class="d-flex flex-column h-100">

<main class="flex-fill intro-2 mask h-100 d-flex justify-content-center align-items-center">
            <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">

                                <!--Form with header-->
                                <div class="card wow fadeIn" data-wow-delay="0.3s">
                                    <div class="card-body">
                                        <form name="auth" action="" method="post">

                                            <!--Header-->
                                            <div class="form-header purple-gradient">
                                                <h3>Авторизация</h3>
                                            </div>
                                            <?php if ($errors): ?>
                                                <h3 class="d-flex justify-content-center" style="color: white;">Неверный логин или пароль</h3>
                                            <?php endif; ?>
                                            <div class="md-form">
                                                    <i class="fa fa-user prefix white-text"></i>
                                                    <input type="text" name="login" id="orangeForm-name" class="form-control" value="<?php if(array_key_exists('login', $_COOKIE))
                                                    echo $_COOKIE['login']; ?>" required>
                                                    <label for="orangeForm-name">Логин</label>
                                                </div>
                                                <div class="md-form">
                                                    <i class="fa fa-lock prefix white-text"></i>
                                                    <input type="password" name="password" id="orangeForm-pass" class="form-control" value="<?php if(array_key_exists('password', $_COOKIE))
                                                    echo $_COOKIE['password']; ?>" required>
                                                    <label for="orangeForm-pass">Пароль</label>
                                                </div>
                                            <div class="text-center">
                                            <input type="submit" class="btn purple-gradient btn-lg" value="Войти">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--/Form with header-->

                            </div>
                        </div>
                    </div>
        </main>

<?php include(ROOT.'/views/layouts/footer.php'); ?>