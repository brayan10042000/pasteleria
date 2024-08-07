<!-- Main content -->
<div class="invoice p-3 mb-3">
	<!-- title row -->
	<div class="row">
		<div class="col-12">
			<h4>
				<i class="fas fa-shopping-cart"></i> Verificar.
				<small class="float-right">Datos: <?= date('d-m-Y') ?></small>
			</h4>
		</div>
		<!-- /.col -->
	</div>
	<!-- info row -->

	<!-- /.row -->

	<!-- Table row -->
	<div class="row">

		<div class="col-12 table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Cantidad</th>
						<th width="150px" class="text-center">Precio</th>
						<th>Producto</th>
						<th class="text-center">Total</th>
						<th class="text-center">Peso</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$tot_peso = 0;
					foreach ($this->cart->contents() as $items) {
						$producto = $this->m_inicio->detalle_producto($items['id']);
						$peso = $items['qty'] * $producto->peso;

						$tot_peso = $tot_peso + $peso;
					?>
						<tr>
							<td><?php echo $items['qty']; ?></td>
							<td class="text-center">Precio. <?php echo number_format($items['price'], 0); ?></td>
							<td><?php echo $items['name']; ?></td>
							<td class="text-center">Precio. <?php echo  number_format($items['subtotal'], 0); ?></td>
							<td class="text-center"><?= $peso  ?> Gr</td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	<?php
	echo validation_errors('<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
	?>
	<?php
	echo form_open('carrito/checkout');
	$numero_orden = date('Ymd') . strtoupper(random_string('alnum', 8));
	?>
	<div class="row">
		<!-- accepted payments column -->
		<div class="col-sm-8 invoice-col">
			Destino :
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
						<select name="ciudad" class="form-control"></select>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label>Expedicion</label>
						<select name="expedicion" class="form-control"></select>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label>Paquete</label>
						<select name="paquete" class="form-control"></select>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="form-group">
						<label>Direccion</label>
						<input name="direccion" class="form-control" required>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Codigo Postal</label>
						<input name="codigo_postal" class="form-control" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Nombre</label>
						<input name="nombre_receptor" class="form-control" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Telefono</label>
						<input name="telefono_receptor" class="form-control" required>
					</div>
				</div>
			</div>
		</div>
		<!-- /.col -->
		<div class="col-4">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th style="width:50%">Total General:</th>
						<th>Precio. <?php echo number_format($this->cart->total(), 0); ?></th>
					</tr>
					<tr>
						<th>Peso:</th>
						<th><?= $tot_peso ?> Gr</th>
					</tr>
					<tr>
						<th>Envio:</th>
						<th><label id="costo_envio"></label></th>
					</tr>
					<tr>
						<th>Total Payment:</th>
						<th><label id="total_pago"></label></th>
					</tr>
				</table>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- Simpan Transaksi -->
	<input name="numero_orden" value="<?= $numero_orden ?>" hidden>
	<input name="estimacion" hidden>
	<input name="costo_envio" hidden>
	<input name="peso" value="<?= $tot_peso ?>" hidden><br>
	<input name="total_general" value="<?= $this->cart->total() ?>" hidden>
	<input name="total_pago" hidden>
	<!-- end Simpan Transaksi -->
	<!-- Simpan Rinci Transaksi -->
	<?php
	$i = 1;
	foreach ($this->cart->contents() as $items) {
		echo form_hidden('qty' . $i++, $items['qty']);
	}

	?>
	<!-- end Simpan Rinci Transaksi -->
	<div class="row no-print">
		<div class="col-12">
			<a href="<?= base_url('carrito')  ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Volver al carrito</a>
			<button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
				<i class="fas fa-shopping-cart"></i> Pago procesado
			</button>
		</div>
	</div>
	<?php echo form_close() ?>
</div>




<script>
	$(document).ready(function() {
		//masukkan data ke selec provinsi
		$.ajax({
			type: "POST",
			url: "<?= base_url('rajaongkir/provincia') ?>",
			success: function(resultados_provinciales) {
				//console.log(hasil_provinsi);
				$("select[name=provincia]").html(resultados_provinciales);
			}
		});

		//masukkan data ke selec kota
		$("select[name=provincia]").on("change", function() {
			var id_provincia_seleccionada = $("option:selected", this).attr("id_provincia");
			$.ajax({
				type: "POST",
				url: "<?= base_url('rajaongkir/ciudad') ?>",
				data: 'id_provincia=' + id_provincia_seleccionada,
				success: function(resultados_ciudad) {
					$("select[name=ciudad]").html(resultados_ciudad);
				}
			});
		});

		$("select[name=ciudad]").on("change", function() {
			$.ajax({
				type: "POST",
				url: "<?= base_url('rajaongkir/expedicion') ?>",
				success: function(resultados_expedición) {
					$("select[name=expedicion]").html(resultados_expedición);
				}
			});
		});

		//mendapatkan data paket
		$("select[name=expedicion]").on("change", function() {
			//mendapatkan expedisi terpilih
			var expedición_seleccionada = $("select[name=expedicion]").val()
			// mendapatkan id kota tujuan terpilih
			var id_ciudad_destino_seleccionado = $("option:selected", "select[name=ciudad]").attr('id_ciudad');
			//mengambil data ongkos kirim
			var total_peso = <?= $tot_peso ?>;

			$.ajax({
				type: "POST",
				url: "<?= base_url('rajaongkir/paquete') ?>",
				data: 'expedicion=' + expedición_seleccionada + '&id_ciudad=' + id_ciudad_destino_seleccionado + '&peso=' + total_peso,
				success: function(resultados_paquete) {
					$("select[name=paquete]").html(resultados_paquete);
				}
			});
		});

		//
		$("select[name=paquete]").on("change", function() {
			//menampilkan ongkir
			var datos_envio = $("option:selected", this).attr('costo_envio');
			var reverse = datos_envio.toString().split('').reverse().join(''),
			gastos_envio = reverse.match(/\d{1,3}/g);
			gastos_envio = gastos_envio.join(',').split('').reverse().join('');

			$("#costo_envio").html("Rp. " + gastos_envio)
			//menghitung totol Bayar
			var datos_total_pagado = parseInt(datos_envio) + parseInt(<?= $this->cart->total() ?>);
			var reverse2 = datos_total_pagado.toString().split('').reverse().join(''),
				costo_total_pagado = reverse2.match(/\d{1,3}/g);
			costo_total_pagado = costo_total_pagado.join(',').split('').reverse().join('');
			$("#total_pagado").html("Rp. " + costo_total_pagado);

			//estimasi dan ongkir
			var estimacion = $("option:selected", this).attr('estimacion');
			$("input[name=estimacion]").val(estimacion);
			$("input[name=costo_envio]").val(datos_envio);
			$("input[name=total_pago]").val(datos_total_pagado);
		});




	});
</script>
