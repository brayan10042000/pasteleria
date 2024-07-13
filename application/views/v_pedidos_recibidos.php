<div class="col-sm-12">
	<?php

	if ($this->session->flashdata('pesan')) {
		echo '<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h5><i class="icon fas fa-check"></i>';
		echo $this->session->flashdata('pesan');
		echo '</h5>
	</div>';
	}
	?>
	<div class="card card-primary card-outline card-outline-tabs">
		<div class="card-header p-0 border-bottom-0">
			<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pedidos entrantes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Procesada</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Enviar</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Finalizar</a>
				</li>
			</ul>
		</div>
		<!-- Pesanan Masuk -->
		<div class="card-body">
			<div class="tab-content" id="custom-tabs-four-tabContent">
				<div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
					<table class="table" id="example1"  >
						<tr>
							<th>No Orden</th>
							<th>Datos</th>
							<th>Expedición</th>
							<th>Pago total</th>
							
						</tr>
						<?php foreach ($pedido as $key => $value) { ?>
							<tr>
								<td><?= $value->numero_orden ?></td>
								<td><?= $value->fecha_orden ?></td>
								<td>
									<b><?= $value->empresa_envio ?></b><br>
									Paquete : <?= $value->paquete ?><br>
									Envío : <?= number_format($value->costo_envio, 0) ?>
								</td>
								<td>
									<b>Precio.<?= number_format($value->total_pago, 0) ?></b><br>
									<?php if ($value->estado_pago == 0) { ?>
										<span class="badge badge-warning">Aún no pagado</span>
									<?php } else { ?>
										<span class="badge badge-success">Ya pagado</span><br>
										<span class="badge badge-primary">Esperando verificación</span>
									<?php } ?>
								</td>
								<td>
									<?php if ($value->estado_pago == 1) { ?>
										<button class="btn btn-sm btn-success btn-flat" data-toggle="modal" data-target="#cek<?= $value->id_transaccion ?>">Cheque Comprobante de Pago</button>
										<a href="<?= base_url('admin/procesar/' . $value->id_transaccion) ?>" class="btn btn-sm btn-flat btn-primary">Proceso</a>
									<?php } ?>

								</td>
							
							</tr>
						<?php } ?>

					</table>
				</div>
				<div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
					<table class="table" id="example1">
						<tr>
							<th>No Orden</th>
							<th>Datos</th>
							<th>Expedicion</th>
							<th>Pago total</th>
							
						</tr>
						<?php foreach ($pedido_en_proceso as $key => $value) { ?>
							<tr>
								<td><?= $value->numero_orden ?></td>
								<td><?= $value->fecha_orden ?></td>
								<td>
									<b><?= $value->empresa_envio ?></b><br>
									Paquete : <?= $value->paquete ?><br>
									Envío : <?= number_format($value->costo_envio, 0) ?>
								</td>
								<td>
									<b>Precio.<?= number_format($value->total_pago, 0) ?></b><br>

									<span class="badge badge-primary">Procesar/Empacar</span>
								</td>
								<td>
									<?php if ($value->estado_pago == 1) { ?>

										<button class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#enviar<?= $value->id_transaccion ?>"><i class="fa fa-paper-plane"></i> Enviar</button>
									<?php } ?>

								</td>
								
							</tr>
						<?php } ?>

					</table>
				</div>
				<div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
					<table class="table" id="example1">
						<tr>
							<th>No Orden</th>
							<th>Datos</th>
							<th>Expedicion</th>
							<th>Pago total</th>
							<th>No Residencia</th>
						</tr>
						<?php foreach ($pedido_enviado as $key => $value) { ?>
							<tr>
								<td><?= $value->numero_orden ?></td>
								<td><?= $value->fecha_orden ?></td>
								<td>
									<b><?= $value->empresa_envio ?></b><br>
									Paquete : <?= $value->paquete ?><br>
									Envío : <?= number_format($value->costo_envio, 0) ?>
								</td>
								<td>
									<b>Rp.<?= number_format($value->total_pago, 0) ?></b><br>

									<span class="badge badge-success">Enviado</span>

								</td>
								<td>
									<h4><?= $value->numero_rastreo ?></h4>
								</td>
							</tr>
						<?php } ?>

					</table>
				</div>
				<div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
					<table class="table" id="example1">
						<tr>
							<th>No Orden</th>
							<th>Datos</th>
							<th>Expedicion</th>
							<th>Pago total</th>
							<th>No Residencia</th>
						</tr>
						<?php foreach ($pedido_completado as $key => $value) { ?>
							<tr>
								<td><?= $value->numero_orden ?></td>
								<td><?= $value->fecha_orden ?></td>
								<td>
									<b><?= $value->empresa_envio ?></b><br>
									Paquete : <?= $value->paquete ?><br>
									Envío : <?= number_format($value->costo_envio, 0) ?>
								</td>
								<td>
									<b>Precio.<?= number_format($value->total_pago, 0) ?></b><br>

									<span class="badge badge-success">Recibido/Llegado</span>
								</td>
								<td>
									<h4><?= $value->numero_rastreo ?></h4>
								</td>
							</tr>
						<?php } ?>

					</table>
				</div>
			</div>
		</div>
		<!-- /.card -->
	</div>
</div>

<?php foreach ($pedido as $key => $value) { ?>

	<!-- modal cek bukti pembayaran -->
	<div class="modal fade" id="cek<?= $value->id_transaccion ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><?= $value->numero_orden ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<table class="table">
						<tr>
							<th>Nombre del banco</th>
							<th>:</th>
							<td><?= $value->nombre_banco ?></td>
						</tr>
						<tr>
							<th>No Cuenta</th>
							<th>:</th>
							<td><?= $value->numero_cuenta ?></td>
						</tr>
						<tr>
							<th>Nombre</th>
							<th>:</th>
							<td><?= $value->a_nombre_de ?></td>
						</tr>
						<tr>
							<th>Pago Total</th>
							<th>:</th>
							<td>Precio. <?= number_format($value->total_pago, 0) ?></td>
						</tr>
					</table>

					<img class="img-fluid pad" src="<?= base_url('assets/comprobante_pago/' . $value->comprobante_pago) ?>" alt="">

				</div>

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>


<?php foreach ($pedido_en_proceso as $key => $value) { ?>
	<div class="modal fade" id="enviar<?= $value->id_transaccion ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><?= $value->numero_orden ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<?php echo form_open('admin/enviar/' . $value->id_transaccion) ?>
					<table class="table">
						<tr>
							<th>Expedicion</th>
							<th>:</th>
							<th><?= $value->empresa_envio ?></th>
						</tr>
						<tr>
							<th>Paquete</th>
							<th>:</th>
							<th><?= $value->paquete ?></th>
						</tr>
						<tr>
							<th>Paquete</th>
							<th>:</th>
							<th>Precio.<?= number_format($value->costo_envio, 0) ?></th>
						</tr>
						<tr>
							<th>No Residencia</th>
							<th>:</th>
							<th><input name="numero_rastreo" class="form-control" placeholder="No Residencia" required></th>
						</tr>
					</table>

				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Confirmar</button>
				</div>
				<?php echo form_close() ?>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>

<!-- datatable -->
<script>
  $(function () {
    $("#datamasuk").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>