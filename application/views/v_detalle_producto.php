<!-- Default box -->
<div class="card card-solid">
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-sm-6">
				<h3 class="d-inline-block d-sm-none"><?= $producto->nombre_poducto ?></h3>
				<div class="col-12">
					<img src="<?= base_url('assets/imagen/' . $producto->imagen) ?>" class="product-image" alt="Product Image">
				</div>
				<div class="col-12 product-image-thumbs">
					<div class="product-image-thumb active"><img src="<?= base_url('assets/imagen/' . $producto->imagen) ?>" alt="Product Image"></div>
					<?php foreach ($imagen as $key => $value) { ?>
						<div class="product-image-thumb"><img src="<?= base_url('assets/imagenproducto/' . $value->imagen) ?>" alt="Product Image"></div>
					<?php } ?>


				</div>
			</div>
			<div class="col-12 col-sm-6">
				<h3 class="my-3"><?= $producto->nombre_producto ?></h3>
				<hr>
				<h5><?= $producto->nombre_categoria ?></h5>
				<hr>
				<p><?= $producto->descripcion ?></p>
				<hr>




				<div class="bg-gray py-2 px-3 mt-4">
					<h2 class="mb-0">
						Precio. <?= number_format($producto->precio, 0) ?>.00
					</h2>
				</div>
				<hr>
				<?php
				echo form_open('carrito/agregar');
				echo form_hidden('id', $producto->id_producto);
				echo form_hidden('price', $producto->precio);
				echo form_hidden('name', $producto->nombre_producto);
				echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
				?>
				<div class="mt-4">
					<div class="row">
						<div class="col-sm-2">
							<input type="number" name="qty" class="form-control" value="1" min="1">
						</div>
						<div class=" col-sm-8">
							<button type="submit" class="btn btn-primary btn-flat swalDefaultSuccess">
								<i class="fas fa-cart-plus fa-lg mr-2"></i>
								Añadir al Carrito
							</button>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>

	</div>
	<!-- /.card-body -->
</div>
<!-- /.card -->
<!-- jQuery -->

<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>template/dist/js/demo.js"></script>
<script type="text/javascript">
	$(function() {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});

		$('.swalDefaultSuccess').click(function() {
			Toast.fire({
				icon: 'success',
				title: 'Item Added To Cart Successfully !!!'
			})
		});
	});
</script>
