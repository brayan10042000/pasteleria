<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente_login
{
	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('m_auth');
	}

	public function login($correo, $contraseña)
	{
		$cek = $this->ci->m_auth->login_cliente($correo, $contraseña);
		if ($cek) {
			$id_cliente = $cek->id_cliente;
			$nombre_cliente = $cek->nombre_cliente;
			$correo = $cek->correo;
			$foto = $cek->foto;
			//buat session
			$this->ci->session->set_userdata('id_cliente', $id_cliente);
			$this->ci->session->set_userdata('nombre_cliente', $nombre_cliente);
			$this->ci->session->set_userdata('correo', $correo);
			$this->ci->session->set_userdata('foto', $foto);
			redirect('inicio');
		} else {
			//jika salah
			$this->ci->session->set_flashdata('error', 'Correo o contraseña equivocada');
			redirect('cliente/login');
		}
	}

	public function proteksi_halaman()
	{
		if ($this->ci->session->userdata('nombre_cliente') == '') {
			$this->ci->session->set_flashdata('error', '¡¡¡Inicie sesión ahora !!!!');
			redirect('cliente/login');
		}
	}

	public function logout()
	{
		$this->ci->session->unset_userdata('id_cliente');
		$this->ci->session->unset_userdata('nombre_cliente');
		$this->ci->session->unset_userdata('correo');
		$this->ci->session->unset_userdata('foto');
		$this->ci->session->set_flashdata('pesan', '¡¡¡Has cerrado sesión exitosamente !!!!');
		redirect('cliente/login');
	}
}
?>