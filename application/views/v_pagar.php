<div class="row">
	<div class="col-sm-6">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Número de cuenta de la tienda</h3>
			</div>
			<div class="card-body">
				<p>Transfiera dinero al número de cuenta a continuación : <h1 class="text-primary">Precio. <?= number_format($pedido->total_pago, 0) ?>.-</h1>
				</p><br>
				<table class="table">
					<tr>
						<th>Banco</th>
						<th>No compensación</th>
						<th>Nombre</th>
					</tr>
					<?php foreach ($cuenta_bancaria as $key => $value) { ?>
						<tr>
							<td><?= $value->nombre_banco ?></td>
							<td><?= $value->numero_cuenta ?></td>
							<td><?= $value->a_nombre_de ?></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Subir comprobante de pago</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<?php
			echo form_open_multipart('mis_pedidos/pagar/' . $pedido->id_transaccion);
			?>
			<div class="card-body">
				<div class="form-group">
					<label>Nombre</label>
					<input name="a_nombre_de" class="form-control" placeholder="Nombre" required>
				</div>
				<div class="form-group">
					<label>Nombre del Banco</label>
					<input name="nombre_banco" class="form-control" placeholder="Nombre del Banco" required>
				</div>
				<div class="form-group">
					<label>No Compensación</label>
					<input name="numero_cuenta" class="form-control" placeholder="No Compensación" required>
				</div>

				<div class="form-group">
					<label for="exampleInputFile">Prueba de pago</label>
					<input type="file" name="comprobante_pago" class="form-control" required>
				</div>

			</div>
			<!-- /.card-body -->

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Confirmar</button>
				<a href="<?= base_url('mis_pedidos') ?>" class="btn btn-success">Atras</a>
			</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>
