<div class="col-md-12">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Datos de Miembros</h3>

			
			<!-- /.card-tools -->
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<table class="table table-bordered" id="example1">
				<thead class="text-center">
					<tr>
						<th>No</th>
						<th>Nombre del cliente</th>
						<th>Correo</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($clientes as $key => $value) { ?>
						<tr>
							<td class="text-center"><?= $no++; ?></td>
							<td><?= $value->nombre_cliente ?></td>
							<td class="text-center"><?= $value->correo ?></td>			
							
						</tr>
						
					<?php } ?>
				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>
