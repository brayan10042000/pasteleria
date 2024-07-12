<div class="col-md-12">
	<!-- general form elements disabled -->
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Configuración del Sitio Web</h3>
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

			echo form_open('admin/configuracion'); ?>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Provincia</label>
						<select name="provincia" class="form-control"></select>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label>Ciudad</label>
						<select name="ciudad" class="form-control">
							<option value="<?= $configuracion->ubicacion ?>"><?= $configuracion->ubicacion ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Nombre de la Tienda</label>
						<input type="text" name="nombre_tienda" class="form-control" value="<?= $configuracion->nombre_tienda ?>" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Número de Teléfono</label>
						<input type="text" name="telefono" value="<?= $configuracion->telefono ?>" class="form-control" required>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label>Dirección</label>
				<input type="text" name="direccion_tienda" value="<?= $configuracion->direccion_tienda ?>" class="form-control" required>
			</div>
			<div class="form-group">
				<a href="<?= base_url('admin') ?>" class="btn btn-secondary btn-sm">Volver</a>
				<button type="submit" class="btn btn-primary btn-sm">Guardar</button>
			</div>

			<?php echo form_close() ?>

		</div>
	</div>
</div>

<!-- API RAJA ONGKIR -->
<script>
	$(document).ready(function() {
		// Insertar datos en el select de provincia
		$.ajax({
			type: "POST",
			url: "<?= base_url('rajaongkir/provincia') ?>",
			success: function(hasil_provincia) {
				//console.log(hasil_provincia);
				$("select[name=provincia]").html(hasil_provincia);
			}
		});

		// Insertar datos en el select de ciudad
		$("select[name=provincia]").on("change", function() {
			var id_provincia_seleccionada = $("option:selected", this).attr("id_provincia");
			$.ajax({
				type: "POST",
				url: "<?= base_url('rajaongkir/ciudad') ?>",
				data: 'id_provincia=' + id_provincia_seleccionada,
				success: function(hasil_ciudad) {
					$("select[name=ciudad]").html(hasil_ciudad);
				}
			});
		});
	});
</script>
