<div class="col-md-12">
	<!-- general form elements disabled -->
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Editar Producto</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<?php
			//notifikasi form kosong
			echo validation_errors('<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h5><i class="icon fas fa-info"></i>', '</h5> </div>');
			//notifikasi gagal upload gambar
			if (isset($error_upload)) {
				echo '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-info"></i>' . $error_upload . '</h5> </div>';
			}

			echo form_open_multipart('producto/editar/' . $producto->id_producto) ?>
			<div class="form-group">
				<label>Producto</label>
				<input name="nombre_producto" class="form-control" placeholder="Product" value="<?= $producto->nombre_producto  ?>">
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Categoria</label>
						<select name="id_categoria" class="form-control">
							<option value="<?= $producto->id_categoria ?>"><?= $producto->nombre_categoria ?></option>
							<?php foreach ($categoria as $key => $value) { ?>
								<option value="<?= $value->id_categoria ?>"><?= $value->nombre_categoria ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Precio</label>
						<input name="precio" class="form-control" placeholder="Price" value="<?= $producto->precio ?>">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Peso (Gramo)</label>
						<input type="number" name="peso" min="0" class="form-control" placeholder="Weight" value="<?= $producto->peso ?>">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label>Descripcion</label>
				<textarea name="descripcion" class="form-control" rows="5" placeholder="Description.."><?= $producto->descripcion ?></textarea>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Foto </label>
						<input type="file" name="imagen" class="form-control" id="imagen_vistaprevia">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<img src="<?= base_url('assets/imagen/' . $producto->imagen) ?>" id="carga_imagen" width="400px">
					</div>
				</div>
			</div>

			<div class="form-group">
			<a href="<?= base_url('producto') ?>" class="btn btn-secondary btn-sm">Atras</a>
				<button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
			</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>

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
