<?php
require_once('../../config/conexion.php');
if (isset($_SESSION['id'])) {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once('../html/MainHead.php'); ?>
        <title>Admin - Certificados</title>
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
                    <a class="breadcrumb-item" href="#">Admin - Certificados</a>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Admin - Certificados</h4>
                <p class="mg-b-0">Pantalla para Administrar Certificados.</p>
            </div>

            <div class="br-pagebody">

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Certificados</h6>
                    <p class="mg-b-30 tx-gray-600">Listado de Certificados.</p>

                    <div class="form-layout">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Cursos: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" data-placeholder="Selecciona" name="curso_id" id="curso_id">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-control-label">&nbsp;</label>
                                <button id="certificado_usuario" class="btn btn-outline-primary form-control" onclick="nuevo()"><i class="fa fa-plus-square mg-r-10"></i>Agregar Usuarios</button>
                            </div>
                        </div>
                    </div>

                    <p></p>

                    <div class="table-wrapper">
                        <table id="certificado_data" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p">Curso</th>
                                    <th class="wd-15p">Usuario</th>
                                    <th class="wd-15p">Fecha Inicio</th>
                                    <th class="wd-15p">Fecha Fin</th>
                                    <th class="wd-15p">Instructor</th>
                                    <th class="wd-15p">Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>

            </div><!-- br-pagebody -->

        </div><!-- br-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

        <?php require_once('modal_certificado.php'); ?>

        <?php require_once('../html/MainJs.php'); ?>
        <script type="text/javascript" src="certificado.js"></script>
    </body>

    </html>

<?php  } else {
    header('Location:' . conectar::ruta() . 'view/404/');
} ?>