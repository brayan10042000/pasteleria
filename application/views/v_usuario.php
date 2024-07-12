<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Datos de Miembros</h3>

			<div class="card-tools">
				<button data-toggle="modal" data-target="#agregar" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Añadir</button>
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
						<th>Nombre</th>
						<th>Username</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($usuario as $key => $value) { ?>
						<tr>
							<td class="text-center"><?= $no++; ?></td>
							<td><?= $value->nombre_usuario ?></td>
							<td class="text-center"><?= $value->username ?></td>			
							<td class="text-center">
								<?php if ($this->session->userdata('username') == 'superadmin')  { ?>

									<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar<?= $value->id_usuario ?>"><i class="fas fa-edit"></i></button>
									<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar<?= $value->id_usuario ?>"><i class="fas fa-trash"></i></button>
								<?php } 
								
								elseif ($this->session->userdata('username') !== $this->session->userdata('username') ) { ?>
									<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar<?= $value->id_usuario ?>"><i class="fas fa-edit"></i></button>
								<?php } 
								
								?>
								
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Añadir Usuario</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<?php
				echo form_open('usuario/agregar');
				?>

				<div class="form-group">
					<label>Nombre de Usuario</label>
					<input type="text" name="nombre_usuario" class="form-control" placeholder="Name User" required>
				</div>

				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" placeholder="Username" required>
				</div>

				<div class="form-group">
					<label>Contraseña</label>
					<input type="text" name="contraseña" class="form-control" placeholder="Password" required>
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
<?php foreach ($usuario as $key => $value) { ?>
	<div class="modal fade" id="editar<?= $value->id_usuario ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Editar Usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<?php
					echo form_open('usuario/editar/' . $value->id_usuario);
					?>

					<div class="form-group">
						<label>Nombre de Usuario</label>
						<input type="text" name="nombre_usuario" value="<?= $value->nombre_usuario ?>" class="form-control" placeholder="Name User" required>
					</div>

					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" value="<?= $value->username ?>" class="form-control" placeholder="Username" required>
					</div>

					<div class="form-group">
						<label>Contraseña</label>
						<input type="text" name="contraseña" value="<?= $value->contraseña ?>" class="form-control" placeholder="Password" required>
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
<?php foreach ($usuario as $key => $value) { ?>
	<div class="modal fade" id="eliminar<?= $value->id_usuario ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Eliminar <?= $value->nombre_usuario ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">


					<h5>¿Estás segur@ de que quieres eliminar estos datos ...?</h5>


				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<a href="<?= base_url('usuario/eliminar/' . $value->id_usuario) ?>" class="btn btn-primary">Eliminar</a>
				</div>

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<?php } ?>
