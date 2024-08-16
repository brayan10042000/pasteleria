<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white bg-olive">
    <div class="container">
        <!-- Left navbar links -->
        <div class="navbar-collapse order-1 order-md-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link text-white">Inicio</a>
                </li>
                <?php $categoria = $this->m_inicio->obtener_todos_los_datos_categorias(); ?>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-white">Productos</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <?php foreach ($categoria as $key => $value) { ?>
                            <li><a href="<?= base_url('inicio/categoria/' . $value->id_categoria) ?>" class="dropdown-item"> <?= $value->nombre_categoria ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Center logo -->
        <a href="<?= base_url() ?>" class="navbar-brand mx-auto text-white">
            <div class="site-logo">
                <a href="<?= site_url('usuario/index'); ?>">
                    <img src="<?= base_url('assets/foto/logo.png'); ?>" alt="">
                </a>
            </div>
            <span class="brand-text font-weight-light text-white"></span>
        </a>

        <!-- Right navbar links -->
        <div class="navbar-collapse order-2 order-md-3">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link text-white" data-toggle="modal" data-target="#exampleModal">Contactanos</a>
                </li>
                <li class="nav-item">
                    <a href="https://wa.me/573005394832" class="nav-link text-white" target="_blank">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </li>
                <li class="nav-item">
                    <?php if ($this->session->userdata('correo') == "") { ?>
                        <a class="nav-link" href="<?= base_url('cliente/login') ?>">
                            <span class="brand-text font-weight-light text-white">Entrar/Registrarse</span>
                        </a>
                    <?php } else { ?>
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <?php
                            $nombre_cliente = $this->session->userdata('nombre_cliente');
                            $acronimos = '';
                            $nombres = explode(' ', $nombre_cliente);
                            foreach ($nombres as $nombre) {
                                $acronimos .= strtoupper($nombre[0]);
                            }
                            ?>
                            <div style="display: flex; align-items: center;">
                                <div class="brand-image img-circle elevation-3" style="background-color: #fff; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; color: #000; opacity: .8;">
                                    <?= $acronimos ?>
                                </div>
                                <span class="brand-text font-weight-light ml-2" style="margin-left: 10px;"><?= $nombre_cliente ?></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('cliente/cuenta') ?>" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> Mi Cuenta
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('mis_pedidos') ?>" class="dropdown-item">
                                <i class="fas fa-shopping-cart mr-2"></i> Mis Ordenes
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('cliente/logout') ?>" class="dropdown-item dropdown-footer">Cerrar Sesion</a>
                        </div>
                    <?php } ?>
                </li>
                <?php
                $carrito = $this->cart->contents();
                $jml_item = 0;
                foreach ($carrito as $key => $value) {
                    $jml_item += $value['qty'];
                }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white" data-toggle="dropdown" href="#">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-danger navbar-badge"><?= $jml_item ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <?php if (empty($carrito)) { ?>
                            <a href="#" class="dropdown-item">
                                <p>Carrito de compras vacío</p>
                            </a>
                        <?php } else { ?>
                            <?php foreach ($carrito as $key => $value) {
                                $producto = $this->m_inicio->detalle_producto($value['id']);
                            ?>
                                <!-- Producto start -->
                                <a href="<?= base_url('carrito') ?>" class="dropdown-item">
                                    <div class="media">
                                        <img src="<?= base_url('assets/imagen/' . $producto->imagen) ?>" alt="User Avatar" class="img-size-50 mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                <?= $value['name'] ?>
                                            </h3>
                                            <p class="text-sm"><?= $value['qty'] ?> x Precio:<?= number_format($value['price'], 0) ?></p>
                                            <p class="text-sm text-muted">
                                                <i class="fa fa-calculator"></i> Precio:<?= $this->cart->format_number($value['subtotal']); ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                            <?php } ?>
                            <!-- Producto End -->
                            <a href="<?= base_url('carrito') ?>" class="dropdown-item">
                                <div class="media">
                                    <div class="media-body">
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="right"><strong>Total:</strong></td>
                                            <td class="right">Precio.<?= $this->cart->format_number($this->cart->total()); ?></td>
                                        </tr>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('carrito') ?>" class="dropdown-item dropdown-footer">Ver carrito</a>
                            <a href="<?= base_url('carrito/checkout') ?>" class="dropdown-item dropdown-footer">Verificar</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /.navbar -->

<!-- Modal Contacto -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contactanos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>WHATSAPP: <a href="https://wa.me/573005394832" target="_blank">300 5394832</a></p>
                <p>EMAIL: <a href="mailto:pasteleriasam@gmail.com">pasteleriasam@gmail.com</a></p>
                <p>DIRECCION: CC Paseo Villa Del Rio Piso 1 - Bogotá.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<div class="content">
    <div class="container">

