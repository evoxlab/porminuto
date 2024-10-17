<!doctype html>
<html lang="en">

<head>
    <title>Alelife Global | Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--style-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo site_url() . "assets/admin/css/fontawesome.css"; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo site_url() . "assets/admin/css/animate.css"; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo site_url() . "assets/admin/css/bootstrap.css"; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo site_url() . "assets/admin/css/style_admin.css"; ?>" type="text/css" media="all" />
    <meta name="description" content="Somos una compañía peruana donde trabajamos con una tecnología llamada la atomización y estamos listos para marcar la diferencia agregando valor a más familias emprendedoras en Latinoamérica y el mundo." />
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta name="keywords" content="MN, mundo, network, mundo network,  mulinivel de productos, colágeno, relajante, ventas, bajar de peso," />
    <meta name="author" content="Evox Lab">
    <meta name="distribution" content="Global">
    <!-- begin facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo site_url(); ?>">
    <meta property="og:title" content="MUNDO NETWORK | Rumbo a la libertad y el éxito">
    <meta property="og:description" content="Somos una compañía peruana donde trabajamos con una tecnología llamada la atomización y estamos listos para marcar la diferencia agregando valor a más familias emprendedoras en Latinoamérica y el mundo.">
    <meta property="og:image" content="<?php echo site_url() . "assets/front/img/logo/mn_negro01.png"; ?>">
    <meta property="og:site_name" content="MUNDO NETWORK | Rumbo a la libertad y el éxito">
    <meta property="og:locale" content="pe">
    <!-- begin SEO -->
    <meta itemprop="name" content="MUNDO NETWORK | Rumbo a la libertad y el éxito">
    <meta itemprop="url" content="<?php echo site_url(); ?>">
    <meta itemprop="description" content="Somos una compañía peruana donde trabajamos con una tecnología llamada la atomización y estamos listos para marcar la diferencia agregando valor a más familias emprendedoras en Latinoamérica y el mundo.">
    <meta itemprop="image" content="<?php echo site_url() . "assets/front/img/logo/mn_negro01.png"; ?>">
    <!-- begin twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="MUNDO NETWORK | Rumbo a la libertad y el éxito">

    <!-- begin favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo site_url() . "assets/front/img/logo/favicon/apple-touch-icon.png"; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo site_url() . "assets/front/img/logo/favicon/favicon-32x32.png"; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url() . "assets/front/img/logo/favicon/favicon-16x16.png"; ?>">
    <link rel="mask-icon" href="<?php echo site_url() . "assets/front/img/logo/favicon/safari-pinned-tab.svg"; ?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- end favicon -->
    <script type="text/javascript">
        var site = '<?php echo base_url(); ?>';
    </script>
</head>

<body data-new-gr-c-s-check-loaded="14.1042.0" data-gr-ext-installed="">
    <div class="auth-wrapper">

        <div class="auth-content subscribe">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-4 col-lg-6 d-none d-md-flex d-lg-flex theme-bg align-items-center justify-content-center">
                        <img src="<?php echo site_url() . "assets/admin/img/lock.png"; ?>" alt="lock images" class="img-fluid">
                    </div>
                    <div class="col-md-8 col-lg-6">
                        <div class="card-body text-center">
                            <div class="row justify-content-center">
                                <div class="col-sm-10">
                                    <h3 class="mb-4">Iniciar Sesión</h3>
                                    <form id="login-form" name="login-form" method="post" action="javascript:void(0);" onsubmit="login();" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Ingrese Email" required="">
                                        </div>
                                        <div class="input-group mb-4">
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Ingrese Contraseña" required="">
                                        </div>
                                        <div class="form-group text-left">
                                        </div>
                                        <button id="submit" type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Required Js -->
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/login.js?123'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/vendor-all.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/bootstrap.js'); ?>"></script>
</body>

</html>