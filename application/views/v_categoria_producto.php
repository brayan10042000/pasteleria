<div class="container">
    <h2 style="text-align:center">Nuestros Productos</h2>
  	<div class="row">
<div class="card card-solid">
	<div class="card-body pb-0">
		<div class="row">
			<?php foreach ($producto as $key => $value) { ?>
				<div class="col-sm-4">
					<?php
					echo form_open('carrito/agregar');
					echo form_hidden('id', $value->id_producto);
					echo form_hidden('qty', 1);
					echo form_hidden('price', $value->precio);
					echo form_hidden('name', $value->nombre_producto);
					echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
					?>
					<div class="card bg-light">
						<div class="card-header text-muted border-bottom-0">
							<h2 class="lead"><b><?= $value->nombre_producto ?></b></h2>
							<p class="text-muted text-sm"><b>categoria : </b><?= $value->nombre_categoria ?></p>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="col-12 text-center">
									<img src="<?= base_url('assets/imagen/' . $value->imagen) ?>" width="300px" height="250px">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-sm-6">
									<div class="text-left">
										<h4><span class="badge bg-primary">Precio. <?= number_format($value->precio, 0) ?></span></h4>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="text-right">
										<a href="<?= base_url('inicio/detalle_producto/' . $value->id_producto)  ?>" class="btn btn-sm btn-success">
											<i class="fas fa-eye"></i>
										</a>
										<button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
											<i class="fas fa-cart-plus"> Añadir</i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			<?php } ?>

		</div>
	</div>
</div>

<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
	$(function() {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 8000
		});

		$('.swalDefaultSuccess').click(function() {
			Toast.fire({
				icon: 'success',
				title: 'Item Added To Cart Successfully !!!'
			})
		});
	});
</script>
