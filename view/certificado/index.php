<!DOCTYPE html>
<html lang="es" class="pos-relative">

<head>
    <?php require_once('../html/MainHead.php'); ?>
    <title>Certificado</title>
</head>

<body class="pos-relative">

    <div class="ht-100v d-flex align-items-center justify-content-center">
        <div class="wd-lg-70p wd-xl-50p tx-center pd-x-40">
            <h1 class="tx-100 tx-xs-140 tx-normal tx-inverse tx-roboto mg-b-0">

                <!-- <img src="../../public/certificado.png" class="img-fluid" alt="Responsive image"> -->
                <canvas id="canvas" height="650px" width="900px" class="img-fluid" alt="Responsive Imagen"></canvas>

            </h1>
            <br>
            <p class="tx-16 mg-b-30 text-justify" id="descripcion_curso"></p>

            <div class="form-layout-footer">
                <button class="btn btn-outline-info" id="btnPNG"><i class="fa fa-send mg-r-10"></i>PNG</button>
                <button class="btn btn-outline-success" id="btnPDF"><i class="fa fa-send mg-r-10"></i>PDF</button>
            </div><!-- form-layout-footer -->
        </div><!-- form-layout -->

    </div>
    </div><!-- ht-100v -->

    <?php require_once('../html/MainJs.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script type="text/javascript" src="certificado.js"></script>

</body>

</html>