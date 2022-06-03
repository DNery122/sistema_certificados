<?php
require_once('../../config/conexion.php');
if (isset($_SESSION['id'])) {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once('../html/MainHead.php'); ?>
        <title>Perfil</title>
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
                    <a class="breadcrumb-item" href="#">Perfil</a>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Perfil</h4>
                <p class="mg-b-0">Pantalla perfil.</p>
            </div>

            <div class="br-pagebody">

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Perfil</h6>
                    <p class="mg-b-30 tx-gray-600">Actualize sus datos.</p>

                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingresa tu nombre" autocomplete="off">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Apellido Paterno: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="paterno" id="paterno" placeholder="Ingresa tu apellido paterno">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Apellido Materno: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="materno" id="materno" placeholder="Ingresa tu apellido materno">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Correo Electronico: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="correo" id="correo" placeholder="Ingresa tu correo electronico" autocomplete="off" readonly>
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Contraseña: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="password" id="password" placeholder="Ingresa tu contraseña" autocomplete="off">
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Selecciona tu sexo" name="sexo" id="sexo">
                                        <option label="Seleccione"></option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Teléfono: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Ingresa tu telefono" autocomplete="off">
                                </div>
                            </div><!-- col-6 -->
                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info" id="btn_actualizar">Actualizar</button>
                            <!-- <button class="btn btn-secondary">Cancelar</button> -->
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </div>

            </div><!-- br-pagebody -->

        </div><!-- br-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

        <?php require_once('../html/MainJs.php'); ?>
        <script type="text/javascript" src="userperfil.js"></script>
    </body>

    </html>

<?php  } else {
    header('Location:' . conectar::ruta() . 'view/404/');
} ?>