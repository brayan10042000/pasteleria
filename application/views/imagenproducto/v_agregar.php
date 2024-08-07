<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Agregar imagen del producto : <?= $producto->nombre_producto ?></h3>
			<div class="card-tools">
			</div>
			<!-- /.card-tools -->
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<?php
				if ($this->session->flashdata('mensaje')) {
					echo '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5><i class="icon fas fa-check"></i>';
					echo $this->session->flashdata('mensaje');
					echo '</h5></div>';
				}
			?>
			<?php
			//notificación de formulario vacío
			echo validation_errors('<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h5><i class="icon fas fa-info"></i>', '</h5> </div>');
			//notificación no pudo cargar la imagen
			if (isset($error_upload)) {
				echo '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-info"></i>' . $error_upload . '</h5> </div>';
			}
			echo form_open_multipart('imagenproducto/agregar/' . $producto->id_producto) ?>

			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Descripcion de la Imagen</label>
						<input name="descripcion" class="form-control" placeholder="Caption" value="<?= set_value('descripcion') ?>">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Imagen</label>
						<input type="file" name="imagen" class="form-control" id="imagen_vistaprevia" required>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<img src="<?= base_url('assets/imagen/nofoto.jpg') ?>" id="carga_imagen" width="200px">
					</div>
				</div>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
				<a href="<?= base_url('imagenproducto') ?>" class="btn btn-success btn-sm">Atras</a>
			</div>

			<?php echo form_close() ?>

			<hr>
			<div class="row">
				<?php foreach ($imagen as $key => $value) { ?>
					<div class="col-sm-3">
						<div class="form-group">
							<img src="<?= base_url('assets/imagenproducto/' . $value->imagen) ?>" id="carga_imagen" width="250px" height="200px">
						</div>
						<p for="">Descripcion :  <?= $value->descripcion ?></p>
						<button data-toggle="modal" data-target="#eliminar<?= $value->id_imagen ?>" class="btn btn-danger btn-xs btn-block"><i class="fas fa-trash"></i> Eliminar</button>
					</div>
				<?php } ?>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>

<!--modal delete -->
<?php foreach ($imagen as $key => $value) { ?>
	<div class="modal fade" id="eliminar<?= $value->id_imagen ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Eliminar <?= $value->descripcion ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<div class="form-group">
						<img src="<?= base_url('assets/imagenproducto/' . $value->imagen) ?>" id="carga_imagen" width="250px" height="200px">
					</div>
					<h5>¿Estás segur@ de que quieres eliminar esta imagen ...?</h5>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<a href="<?= base_url('imagenproducto/eliminar/' . $value->id_producto . '/' . $value->id_imagen) ?>" class="btn btn-primary">Eliminar</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<?php } ?>


<script>
	function leerImagen(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#carga_imagen').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imagen_vistaprevia").change(function() {
		leerImagen(this);
	});
</script>
