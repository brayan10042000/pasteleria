<div class="col-md-12">
	<div class="card ">
		<div class="card-header">
			<h3 class="card-title">Datos de Categoria</h3>

			<div class="card-tools">
				<button data-toggle="modal" data-target="#agregar" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Agregar</button>
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
			<table class="table" id="example1">
				<thead class="text-center">
					<tr>
						<th>No</th>
						<th>Nombre de Categoria</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($categoria as $key => $value) { ?>
						<tr>
							<td class="text-center"><?= $no++; ?></td>
							<td><?= $value->nombre_categoria ?></td>
							<td class="text-center">
								<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar<?= $value->id_categoria ?>"><i class="fas fa-edit"></i></button>
								<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar<?= $value->id_categoria ?>"><i class="fas fa-trash"></i></button>
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



<!--modal add -->
<div class="modal fade" id="agregar">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Añadir Categoria</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<?php
				echo form_open('categoria/agregar');
				?>

				<div class="form-group">
					<label>Nombre de Categoria</label>
					<input type="text" name="nombre_categoria" class="form-control" placeholder="Nombre de Categoria" required>
				</div>

			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>

			</div>
			<?php
			echo form_close();
			?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>



<!--modal edit -->
<?php foreach ($categoria as $key => $value) { ?>
	<div class="modal fade" id="editar<?= $value->id_categoria ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Actualizar Categoria</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<?php
					echo form_open('categoria/editar/' . $value->id_categoria);
					?>

					<div class="form-group">
						<label>Nombre de Categoria</label>
						<input type="text" name="nombre_categoria" value="<?= $value->nombre_categoria ?>" class="form-control" placeholder="Nama Kategori" required>
					</div>

				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>

				</div>
				<?php
				echo form_close();
				?>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<?php } ?>



<!--modal delete -->
<?php foreach ($categoria as $key => $value) { ?>
	<div class="modal fade" id="eliminar<?= $value->id_categoria ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Eliminar <?= $value->nombre_categoria ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">


					<h5>¿Estás segur@ de que quieres eliminar estos datos ...?</h5>


				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<a href="<?= base_url('categoria/eliminar/' . $value->id_categoria) ?>" class="btn btn-primary">Eliminar</a>
				</div>

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<?php } ?>
