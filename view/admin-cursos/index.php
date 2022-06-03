<?php
require_once('../../config/conexion.php');
if (isset($_SESSION['id'])) {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once('../html/MainHead.php'); ?>
        <title>Admin - Cursos</title>
    </head>

    <body>

        <!-- ########## START: LEFT PANEL ########## -->
        <?php require_once('../html/MainMenu.php'); ?>
        <!-- ########## END: LEFT PANEL ########## -->

        <!-- ########## START: HEAD PANEL ########## -->
        <?php require_once('../html/MainHeader.php'); ?>
        <!-- ########## END: HEAD PANEL ########## -->

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="#">Admin - Cursos</a>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Admin - Cursos</h4>
                <p class="mg-b-0">Pantalla para Administrar Cursos.</p>
            </div>

            <div class="br-pagebody">

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Curso</h6>
                    <p class="mg-b-30 tx-gray-600">Listado de cursos.</p>

                    <button id="nuevo_curso" class="btn btn-outline-primary" onclick="nuevo()"><i class="fa fa-plus-square mg-r-10"></i>Nuevo Registro</button>
                    <p></p>

                    <div class="table-wrapper">
                        <table id="cursos_data" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p">Categoria</th>
                                    <th class="wd-15p">Instructor</th>
                                    <th class="wd-15p">Nombre</th>
                                    <th class="wd-15p">Fecha inicio</th>
                                    <th class="wd-20p">Fecha fin</th>
                                    <th class="wd-10p">Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>

            </div><!-- br-pagebody -->

        </div><!-- br-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

        <?php require_once('modal_curso.php'); ?>

        <?php require_once('../html/MainJs.php'); ?>
        <script type="text/javascript" src="cursos.js"></script>
    </body>

    </html>

<?php  } else {
    header('Location:' . conectar::ruta() . 'view/404/');
} ?>