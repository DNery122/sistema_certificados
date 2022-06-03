<div class="br-logo"><a href="../UserHome/"><span>[</span>Empresa<span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Menú</label>
    <div class="br-sideleft-menu"></div>

    <a href="../UserHome/" class="br-menu-link">
        <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Inicio</span>
        </div><!-- menu-item -->
    </a><!-- br-menu-link -->

    <?php if ($_SESSION['rol_id'] == 1) {

    ?>
        <a href="../UserCurso/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Mis cursos</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
    <?php
    } else {
    ?>
        <a href="../admin-usuario/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Admin Usuarios</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="../admin-instructor/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Admin Instructores</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="../admin-cursos/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Admin Cursos</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="../admin-certificados/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Admin Certificados</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="../admin-categoria/" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Admin Categorias</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

    <?php
    } ?>

    <a href="../UserPerfil/" class="br-menu-link">
        <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
            <span class="menu-item-label">Perfil</span>
        </div><!-- menu-item -->
    </a><!-- br-menu-link -->

    <a href="../html/Logout.php" class="br-menu-link">
        <div class="br-menu-item">
            <i class="menu-item-icon icon ion-power tx-24"></i>
            <span class="menu-item-label">Cerrar Sesion</span>
        </div><!-- menu-item -->
    </a><!-- br-menu-link -->


</div><!-- br-sideleft-menu -->
</div><!-- br-sideleft -->