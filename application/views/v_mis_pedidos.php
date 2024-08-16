<div class="row">
	<div class="col-sm-12">
		<?php

		if ($this->session->flashdata('mensaje')) {
			echo '<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h5><i class="icon fas fa-check"></i>';
			echo $this->session->flashdata('mensaje');
			echo '</h5>
	</div>';
		}
		?>
		<div class="card card-primary card-outline card-outline-tabs">
			<div class="card-header p-0 border-bottom-0">
				<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Orden</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Proceso</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Enviar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Historia</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content" id="custom-tabs-four-tabContent">
					<div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
						<!-- data pesanan order -->
						<table class="table">
							<tr>
								<th>No Orden</th>
								<th>Datos</th>
								<th>Expedicion</th>
								<th>Pago Total</th>
								<th>Accion</th>
							</tr>
							<?php foreach ($sin_pagar as $key => $value) { ?>
								<tr>
									<td><?= $value->numero_orden ?></td>
									<td><?= $value->fecha_orden ?></td>
									<td>
										<b><?= $value->expedicion ?></b><br>
										Paquete : <?= $value->paquete ?><br>
										Envio : <?= number_format($value->costo_envio, 0) ?>
									</td>
									<td>
										<b>Rp.<?= number_format($value->total_pago, 0) ?></b><br>
										<?php if ($value->estado_pago == 0) { ?>
											<span class="badge badge-warning">Aún no pagado</span>
										<?php } else { ?>
											<span class="badge badge-success">Ya pagado</span><br>
											<span class="badge badge-primary">Esperando verificación</span>
										<?php } ?>
									</td>
									<td>
										<?php if ($value->estado_pago == 0) { ?>
											<a href="<?= base_url('mis_pedidos/pagar/' . $value->id_transaccion) ?>" class="btn btn-sm btn-flat btn-primary">Pagado</a>
										<?php } ?>

									</td>
								</tr>
							<?php } ?>

						</table>
					</div>
					<div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
						<!-- data pesanan diproses -->
						<table class="table">
							<tr>
								<th>No Orden</th>
								<th>Datos</th>
								<th>Expedicion</th>
								<th>Pago Total</th>

							</tr>
							<?php foreach ($en_proceso as $key => $value) { ?>
								<tr>
									<td><?= $value->numero_orden ?></td>
									<td><?= $value->fecha_orden ?></td>
									<td>
										<b><?= $value->expedicion ?></b><br>
										Paquete : <?= $value->paquete ?><br>
										Envio : <?= number_format($value->costo_envio, 0) ?>
									</td>
									<td>
										<b>Rp.<?= number_format($value->total_pago, 0) ?></b><br>
										<span class="badge badge-success">Verificado</span><br>
										<span class="badge badge-primary">Procesar/Empacar</span>

									</td>

								</tr>
							<?php } ?>

						</table>

					</div>
					<div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
						<table class="table">
							<tr>
								<th>No Orden</th>
								<th>Datos</th>
								<th>Expedicion</th>
								<th>Pago Total</th>
								<th>No Residencia</th>

							</tr>
							<?php foreach ($enviado as $key => $value) { ?>
								<tr>
									<td><?= $value->numero_orden ?></td>
									<td><?= $value->fecha_orden ?></td>
									<td>
										<b><?= $value->expedicion ?></b><br>
										Paquete : <?= $value->paquete ?><br>
										Envio : <?= number_format($value->costo_envio, 0) ?>
									</td>
									<td>
										<b>Precio.<?= number_format($value->total_pago, 0) ?></b><br>
										<span class="badge badge-success">Enviado</span><br>
									</td>
									<td>
										<h5><?= $value->numero_rastreo ?><br>
											<button data-toggle="modal" data-target="#recibido<?= $value->id_transaccion ?>" class="btn btn-primary btn-xs btn-flat">Enviado</button>
										</h5>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
					<div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
						<table class="table">
							<tr>
								<th>No Orden</th>
								<th>Datos</th>
								<th>Expedicion</th>
								<th>Pago Total</th>
								<th>No Residencia</th>

							</tr>
							<?php foreach ($completado as $key => $value) { ?>
								<tr>
									<td><?= $value->numero_orden ?></td>
									<td><?= $value->fecha_orden ?></td>
									<td>
										<b><?= $value->expedicion ?></b><br>
										Paquete : <?= $value->paquete ?><br>
										Envio : <?= number_format($value->costo_envio, 0) ?>
									</td>
									<td>
										<b>Precio.<?= number_format($value->total_pago, 0) ?></b><br>
										<span class="badge badge-success">Finalizar</span><br>
									</td>
									<td>
										<h5><?= $value->numero_rastreo ?><br>
										</h5>
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
</div>

<?php foreach ($enviado as $key => $value) { ?>
	<div class="modal fade" id="recibido<?= $value->id_transaccion ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Orden Recibida</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				¿Estás seguro de que tu pedido ha sido recibido...?
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<a href="<?= base_url('mis_pedidos/recibido/' . $value->id_transaccion) ?>" class="btn btn-primary">Si</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>
