
<!-- Section: Design Block -->
<section class="text-center text-lg-start">
  <style>
    .cascading-right {
      margin-right: -50px;
    }

    @media (max-width: 991.98px) {
      .cascading-right {
        margin-right: 0;
      }
    }
  </style>

  <!-- Jumbotron -->
  <div class="container py-4">
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5">Iniciar sesión</h2>
			<?php
					echo validation_errors('<div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>', '</div>');

					if ($this->session->flashdata('mensaje')) {
						echo '<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo $this->session->flashdata('mensaje');
						echo '</div>';
					}

					if ($this->session->flashdata('error')) {
						echo '<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo $this->session->flashdata('error');
						echo '</div>';
					}

					echo form_open('cliente/login'); ?>

                <form id="formAuthentication" class="mb-3" method="POST" action="" novalidate="">
                
                <div class="mb-3">
                  <label for="email" class="form-label" required autofocus>Correo</label>
                  <input type="text" class="form-control" value="<?= set_value('correo') ?>" name="correo" placeholder="Introduce tu correo" autofocus/>
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password" required>Contraseña</label>
                  <div class="input-group input-group-merge">
                    <input type="password" value="<?= set_value('contraseña') ?>" class="form-control" name="contraseña" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Iniciar sesión</button>
				  <a href="<?= base_url('cliente/registrar') ?>" class="text-center">¡No tengo una cuenta...!</a>
                </div>
              </form>
			  <?php echo form_close() ?>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/096.jpg" class="w-100 rounded-4 shadow-4"
          alt="" />
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->

  </body>
</html>


<div class="row">


	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		