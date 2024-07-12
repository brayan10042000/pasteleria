<div class="col-md-12">
	<!-- general form elements disabled -->
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Añadir Producto</h3>
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

			echo form_open_multipart('producto/agregar') ?>
			<div class="form-group">
				<label>Producto</label>
				<input name="nombre_producto" class="form-control" placeholder="Producto" value="<?= set_value('nombre_producto') ?>">
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Categoria</label>
						<select name="id_categoria" class="form-control">
							<option value="">--Seleccionar Categoria--</option>
							<?php foreach ($categoria as $key => $value) { ?>
								<option value="<?= $value->id_categoria ?>"><?= $value->nombre_categoria ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Precio</label>
						<input name="precio" class="form-control" placeholder="Precio" value="<?= set_value('precio') ?>">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Peso(Gramos)</label>
						<input type="number" name="peso" min="0" class="form-control" placeholder="peso" value="<?= set_value('peso') ?>">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label>Descripcion</label>
				<textarea name="descripcion" class="form-control" rows="5" placeholder="Description.."><?= set_value('descripcion') ?></textarea>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Imagen</label>
						<input type="file" name="imagen" class="form-control" id="preview_gambar" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<img src="<?= base_url('assets/imagen/nofoto.jpg') ?>" id="gambar_load" width="400px">
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
	function bacaGambar(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#gambar_load').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#preview_gambar").change(function() {
		bacaGambar(this);
	});
</script>
