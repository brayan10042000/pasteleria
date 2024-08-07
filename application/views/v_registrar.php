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
            <h2 class="fw-bold mb-5">Regístrate ahora</h2>
			<?php
					echo validation_errors('<div class="alert alert-warning alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>', '</div>');
					if ($this->session->flashdata('pesan')) {
						echo '<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>';
						echo $this->session->flashdata('pesan');
						echo '</div>';
					}

					echo form_open('cliente/registrar'); ?>


            <form id="formAuthentication" class="row" method="POST" action="">
			<!-- Name input -->
			  <div class="form-outline">
                    <input type="text" name="nombre_cliente" value="<?= set_value('nombre_cliente') ?>" class="form-control" required autofocus/>
                    <label class="form-label" for="form3Example1">Nombre</label>
                  </div>
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="correo" value="<?= set_value('correo') ?>" class="form-control" required autofocus />
                <label class="form-label" for="form3Example3">Correo</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="contraseña" value="<?= set_value('contraseña') ?>" class="form-control" required/>
                <label class="form-label" for="form3Example4">Contraseña</label>
              </div>

              <!-- Password Confirmation -->
              <div class="form-outline mb-4">
                <input type="password" name="repetir_contraseña" value="<?= set_value('repetir_contraseña') ?>" class="form-control" required/>
                <label class="form-label" for="form3Example4">Confirmar Contraseña</label>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">
                Registrarse
              </button>
			  <a href="<?= base_url('cliente/login') ?>" class="text-center">Tengo una cuenta...!</a>
            </form>
			<?php echo form_close() ?>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0">
        <img src="https://cdn.quest.eb.com/images/164/164_3223/164_3223628-W.jpg" class="w-100 rounded-4 shadow-4"
          alt="" />
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->


