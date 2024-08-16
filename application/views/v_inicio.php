<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_url() ?>assets/slider/Eclair.jpg">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="<?= base_url() ?>assets/slider/hero-bg-3.jpg">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="<?= base_url() ?>assets/slider/hero-bg-2.jpg">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="<?= base_url() ?>assets/slider/dd.jpg">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Anterior</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only"> Siguiente</span>
	</a>
</div>
</br></br></br>

<div class="container">
    <div class="row">
      <div class="col-sm-6"> 
        <img class="img-thumbnail" src="https://cdn.quest.eb.com/images/164/164_3218/164_3218824-W.jpg" alt="images" style="width:120%; height: 100%;">
      </div>
      <div class="col-sm-6" style="text-align: justify;">
        <h3><b>¿Quienes somo nosotros?</b></h3>
        <p>Pateleria SAM ofrece diversos tipos de tartas, panes y postres. No sólo eso, también ofrecemos tartas, pan o postres con multitud de toppings según los gustos del cliente.</p>
        Puedes pedir pastel, pan o postre en cualquier lugar y en cualquier momento, te atenderemos bien. Sin tener que venir directamente a la tienda puedes pedir y ver nuestros productos.
      </div>
    </div>
  </div>
  </br></br>


<section class="work">
  <div class="container">
    <h3>¿Por qué Elegirnos?</h3>
    <div class="row">
      <div class="col-sm-6">
        <img src="https://cdn.quest.eb.com/images/132/132_1379/132_1379619-W.jpg" class="align-self-center mr-3" alt="image" style="width:100%">
          <div id="mi" class="media-body" style="text-align: justify; padding: 10px;">
            <h5 class="mt-0">Entrega a domicilio</h5>
            <p class="mb-0">Se puede realizar la entrega desde cualquier lugar y en cualquier momento cuando queramos, embalado en una caja que no dañe la tarta.</p>
          </div>
      </div>

      <div class="col-sm-6">
        <img src="https://cdn.quest.eb.com/images/321/321_1753/321_1753869-W.jpg" class="align-self-center mr-3" alt="image" style="width:100%">
          <div class="media-body" style="text-align: justify; padding: 10px;">
            <h5 class="mt-0">Mejor precio</h5>
            <p class="mb-0">El precio es muy asequible pero la calidad y el sabor están garantizados. Si el pedido no coincide se puede devolver en 24 horas.</p>
          </div>
      </div>
    </div>
  </div>
</section>
</br></br></br>

	<div class="container">
    	<h2 style="text-align:center">Nuestros productos</h2>
  	<div class="row">

<div class="card card-solid">
	<div class="card-body pb-0">
		<div class="row">
			<?php foreach ($producto as $key => $value) { ?>
				<div class="col-sm-4">
					<?php
					echo form_open('carrito/agregar');
					echo form_hidden('id', $value->id_producto);
					echo form_hidden('qty', 1);
					echo form_hidden('price', $value->precio);
					echo form_hidden('name', $value->nombre_producto);
					echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
					?>
					<div class="card bg-light">
						<div class="card-header text-muted border-bottom-0">
							<h2 class="lead"><b><?= $value->nombre_producto ?></b></h2>
							<p class="text-muted text-sm"><b>Categoria : </b><?= $value->nombre_categoria ?></p>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="col-12 text-center">
									<img src="<?= base_url('assets/imagen/' . $value->imagen) ?>" class="img-fluid" width="250px">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-sm-6">
									<div class="text-left">
										<h4><span class="badge bg-primary">Precio: <?= number_format($value->precio, 0) ?></span></h4>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="text-right">
										<a href="<?= base_url('inicio/detalle_producto/' . $value->id_producto)  ?>" class="btn btn-sm btn-success">
											<i class="fas fa-eye"></i>
										</a>
										<button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
											<i class="fas fa-cart-plus"> Añadir</i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			<?php } ?>

		</div>
	</div>
</div>

<script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
	$(function() {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 8000
		});

		$('.swalDefaultSuccess').click(function() {
			Toast.fire({
				icon: 'success',
				title: 'Artículo agregado al carrito exitosamente !!!'
			})
		});
	});
</script>
