<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Datos Imágenes Producto</h3>
			<div class="card-tools">
			</div>
			<!-- /.card-tools -->
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<?php
				if ($this->session->flashdata('pesan')) {
					echo '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5><i class="icon fas fa-check"></i>';
					echo $this->session->flashdata('pesan');
					echo '</h5></div>';
				}
			?>
			<table class="table table-bordered" id="example1">
				<thead class="text-center">
					<tr>
						<th>No</th>
						<th>Producto</th>
						<th>Cubrir</th>
						<th>Total</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($imagenproducto as $key => $value) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $value->nombre_producto ?></td>
							<td class="text-center"><img src="<?= base_url('assets/imagen/' . $value->imagen) ?>" width="100px"></td>
							<td class="text-center"><span class="badge bg-primary">
								<h5><?= $value->total_imagen ?></h5>
								</span></td>
							<td class="text-center">
								<a href="<?= base_url('imagenproducto/agregar/' . $value->id_producto) ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Añadir imagen	</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>
