<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login_usuario()
    {
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required', array('required' => '%s debe ser completado !!!'));
        $this->form_validation->set_rules('contraseña', 'Contraseña', 'required', array('required' => '%s debe ser completado !!!'));
        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $contraseña = $this->input->post('contraseña');
            $this->usuario_login->login($username, $contraseña);
        }
        $data = array(
            'title' => 'Iniciar sesión de usuario',
        );
        $this->load->view('v_login_usuario', $data, FALSE);
    }

    public function logout_usuario()
    {
        $this->usuario_login->logout();
    }
}
?>
