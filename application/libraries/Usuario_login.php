<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_login
{
	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('m_auth');
	}

	public function login($username, $contraseña)
	{
		$cek = $this->ci->m_auth->login_usuario($username, $contraseña);
		if ($cek) {
			$nombre_usuario = $cek->nombre_usuario;
			$username = $cek->username;
			$level_user = $cek->level_user;
			//buat session
			$this->ci->session->set_userdata('username', $username);
			$this->ci->session->set_userdata('nombre_usuario', $nombre_usuario);
			$this->ci->session->set_userdata('level_user', $level_user);
			redirect('admin');
		} else {
			//jika salah
			$this->ci->session->set_flashdata('error', 'Correo o contraseña equivocada');
			redirect('auth/login_usuario');
		}
	}

	public function proteksi_halaman()
	{
		if ($this->ci->session->userdata('username') == '') {
			$this->ci->session->set_flashdata('error', '¡¡¡Por favor inicie sesión ahora!!!');
			redirect('auth/login_usuario');
		}
	}

	public function logout()
	{
		$this->ci->session->unset_userdata('username');
		$this->ci->session->unset_userdata('nombre_usuario');
		$this->ci->session->unset_userdata('level_user');
		$this->ci->session->set_flashdata('pesan', '¡¡¡Has cerrado sesión exitosamente!!!');
		redirect('auth/login_usuario');
	}
}
?>