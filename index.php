<?php

require_once("config/conexion.php");

if (isset($_POST['enviar']) and $_POST['enviar'] == 'si') {
    require_once('models/Usuario.php');
    $usuario = new Usuario();
    $usuario->login();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Bracket">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Sistema de certificados online</title>

    <!-- vendor css -->
    <link href="public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="public/lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="public/css/bracket.css">
</head>

<body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
        <form action="" method="POST">

            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
                <?php
                if (isset($_GET['m'])) {
                    switch ($_GET['m']) {
                        case '1':
                ?>
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong class="d-block d-sm-inline-block-force">Error!</strong> Datos incorrectos
                            </div><!-- alert -->
                        <?php
                            break;
                        case '2':
                        ?>
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong class="d-block d-sm-inline-block-force">Error!</strong> Campos vacios
                            </div><!-- alert -->
                <?php
                            break;
                    }
                }
                ?>
                <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> Mi empresa <span class="tx-normal">]</span></div>
                <div class="tx-center mg-b-60">Sistema de certificados onlie</div>

                <div class="form-group">
                    <input type="text" class="form-control" name="correo" placeholder="Ingresa tu correo">
                </div><!-- form-group -->
                <div class="form-group">
                    <input type="password" class="form-control" name="pass" placeholder="Ingresa tu contraseña">
                    <!-- <a href="" class="tx-info tx-12 d-block mg-t-10">¿Olvido su contraseña?</a> -->
                </div><!-- form-group -->
                <input type="hidden" name="enviar" value="si">
                <button type="submit" class="btn btn-info btn-block">Ingresar</button>

                <div class="mg-t-60 tx-center">¿No te has registrado? <a href="" class="tx-info">Registrarse</a></div>
            </div><!-- login-wrapper -->

        </form>

    </div><!-- d-flex -->

    <script src="public/lib/jquery/jquery.js"></script>
    <script src="public/lib/popper.js/popper.js"></script>
    <script src="public/lib/bootstrap/bootstrap.js"></script>

</body>

</html>