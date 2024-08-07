<!-- Contenedor Principal de la Barra Lateral -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo de la Marca -->
    <a href="<?= base_url('admin') ?>" class="brand-link">
        <i class="fas fa-store"></i>
        <span class="brand-text font-weight-light">
        PASTELERIA SAM
        </span>
    </a>

    <!-- Barra Lateral -->
    <div class="sidebar">
        <!-- Panel del usuario de la barra lateral (opcional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                $nombre_usuario = $this->session->userdata('nombre_usuario');
                $acronimos = '';
                $nombres = explode(' ', $nombre_usuario);
                foreach ($nombres as $nombre) {
                    $acronimos .= strtoupper($nombre[0]);
                }
                ?>
                <div class="img-circle elevation-2" style="background-color: #fff; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; color: #000;">
                    <?= $acronimos ?>
                </div>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $nombre_usuario ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?= base_url('admin') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'admin' and $this->uri->segment(2) == "") {
                        echo "active";
                        } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard </p>
                    </a>
                </li>

                <?php if ($this->session->userdata('username') == 'superadmin')  { ?>
                <li class="nav-item">
                    <a href="<?= base_url('categoria') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'categoria') {
                        echo "active";
                        } ?>">
                        <i class="nav-icon fas fa-list"></i>
                        <p> Categoria </p>
                    </a>
                </li>
                <?php }  ?>
                <li class="nav-item">
                    <a href="<?= base_url('producto')  ?>" class="nav-link <?php if ($this->uri->segment(1) == 'producto') {
                        echo "active";
                        } ?>">
                        <i class="nav-icon fas  fa-birthday-cake"></i>
                        <p> Producto </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('imagenproducto')  ?>" class="nav-link <?php if ($this->uri->segment(1) == 'imagenproducto') {
                    echo "active";
                    } ?>">
                        <i class="nav-icon fas  fa-image"></i>
                        <p> Detalle del Producto </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/pedidos_recibidos')  ?>" class="nav-link <?php if ($this->uri->segment(2) == 'pedidos_recibidos' and $this->uri->segment(1) == 'admin') {
                        echo "active";
                        } ?>">
                        <i class="nav-icon fas  fa-download"></i>
                        <p> Pedidos Entrantes </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('reporte') ?>" class="nav-link">
                        <i class="nav-icon fa fa-file"></i>
                        <p> Reporte </p>
                    </a>
                </li>
                
                <!-- Limitar la configuración a la que solo puede acceder el superadministrador -->
                <?php if ($this->session->userdata('username') == 'superadmin')  { ?>
                <li class="nav-item">
                    <a href="<?= base_url('admin/configuracion') ?>" class="nav-link">
                        <i class="nav-icon fa fa-asterisk"></i>
                        <p> Configuracion </p>
                    </a>
                </li>
                <?php }  ?>

                <?php if ($this->session->userdata('username') == 'superadmin')  { ?>
                <li class="nav-item">
                    <a href="<?= base_url('usuario') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'usuario') {
                    echo "active";
                    } ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Usuario </p>
                    </a>
                </li>
                <?php }  ?>
                
                <li class="nav-item">
                    <a href="<?= base_url('cliente') ?>" class="nav-link <?php if ($this->uri->segment(1) == 'cliente') {
                    echo "active";
                    } ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Miembros </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout_usuario') ?>" class="nav-link">
                    <img src="https://img.icons8.com/ios-filled/15/FFFFFF/exit.png"/>
                        <p> Cerrar sesion </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Contenedor de Contenido Principal -->
<div class="content-wrapper">
    <!-- Encabezado de Contenido -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Contenido Principal -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
