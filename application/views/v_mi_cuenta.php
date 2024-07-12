<div class="card card-solid">
	<div class="card-body pb-0">
	<div class="col-lg col-6">
	<!-- small box -->
	<div class="small-box bg-success">
		<div class="inner">
		<?php if ($this->session->userdata('correo') == "") { ?>
			Aún no hay datos
				<?php } else { ?>
				<h1 class="display-4">Mi cuenta</h1>
				<h5> <b>Nombre: </b><?= $this->session->userdata('nombre_cliente')  ?></h5>
				<h5> <b>Correo: </b><?= $this->session->userdata('correo')  ?></h5>
				<?php } ?>
		</div>
		<div class="icon">
			<i class="fas  fa-user"></i>
		</div>	
	</div>
</div>

	</div>
</div>
<br><br><br>