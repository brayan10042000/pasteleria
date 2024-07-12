<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-info">
		<div class="inner">
			<h3><?= $total_pedidos_recibidos ?></h3>
			<p>Total Ordenes</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		<a href="<?= base_url('admin/pedidos_recibidos')  ?>" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>

<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-success">
		<div class="inner">
			<h3><?= $total_producto ?></h3>
			<p>Productos</p>
		</div>
		<div class="icon">
			<i class="fas  fa-birthday-cake"></i>
		</div>
		<a href="<?= base_url('producto') ?>" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>

<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-warning">
		<div class="inner">
			<h3><?= $total_cliente ?></h3>
			<p>Miembros</p>
		</div>
		<a href="<?= base_url('cliente') ?>" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
		<div class="icon">
			<i class="fas fa-users"></i>
		</div>
		<a href="#" class="small-box-footer"></a>
	</div>
</div>

<div class="col-lg-3 col-6">
	<div class="small-box bg-danger">
		<div class="inner">
			<h3><?= $total_categoria ?></h3>
			<p>Categorias</p>
		</div>
		<div class="icon">
			<i class="fas fa-list"></i>
		</div>
		<a href="<?= base_url('categoria') ?>" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
