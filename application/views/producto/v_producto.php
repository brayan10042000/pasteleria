<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Datos De Productos</h3>
			<div class="card-tools">
				<a href="<?= base_url('producto/agregar
				') ?>" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Agregar</a>
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
			<table class="table table-bordered" id="example1">
				<thead class="text-center">
					<tr>
						<th>No</th>
						<th>Producto</th>
						<th>Categoria</th>
						<th>Precio</th>
						<th>Imagen</th>
						<th>Descripcion</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1;
					foreach ($producto as $key => $value) { ?>
						<tr>
							<td class="text-center"><?= $no++; ?></td>
							<td>
								<?= $value->nombre_producto ?><br>
								Tamaño : <?= $value->peso ?> Gr
							</td>
							<td class="text-center"><?= $value->nombre_categoria ?></td>
							<td class="text-center">Rp. <?= number_format($value->precio, 0) ?></td>
							<td class="text-center"><img src="<?= base_url('assets/imagen/' . $value->imagen) ?>" width="150px"></td>
							<td class="text-center"><?= $value->descripcion ?></td>
							<td class="text-center">
								<a href="<?= base_url('producto/editar/' . $value->id_producto) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
								<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar<?= $value->id_producto ?>"><i class="fas fa-trash"></i></button>
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

<!--modal delete -->
<?php foreach ($producto as $key => $value) { ?>
	<div class="modal fade" id="eliminar<?= $value->id_producto ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Eliminar <?= $value->nombre_producto ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h5>¿Estás segur@ de que quieres eliminar estos datos ...?</h5>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<a href="<?= base_url('producto/eliminar/' . $value->id_producto) ?>" class="btn btn-primary">Eliminar</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<?php } ?>
