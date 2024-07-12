<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    // iniciar sesión como usuario
    public function login_usuario($username, $contraseña)
    {
        $this->db->select('*');
        $this->db->from('tbl_usuario');
        $this->db->where(array(
            'username' => $username,
            'contraseña' => $contraseña
        ));
        return $this->db->get()->row();
    }

    // iniciar sesión como cliente
    public function login_cliente($correo, $contraseña)
    {
        $this->db->select('*');
        $this->db->from('tbl_cliente');
        $this->db->where(array(
            'correo' => $correo,
            'contraseña' => $contraseña
        ));
        return $this->db->get()->row();
    }
}
?>
