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
		$controlar = $this->ci->m_auth->login_usuario($username, $contraseña);
		if ($controlar) {
			$nombre_usuario = $controlar->nombre_usuario;
			$username = $controlar->username;
			$level_user = $controlar->level_user;
			//crear sesión
			$this->ci->session->set_userdata('username', $username);
			$this->ci->session->set_userdata('nombre_usuario', $nombre_usuario);
			$this->ci->session->set_userdata('level_user', $level_user);
			redirect('admin');
		} else {
			//si es falso
			$this->ci->session->set_flashdata('error', 'Correo o contraseña equivocada');
			redirect('auth/login_usuario');
		}
	}

	public function proteccion_pagina()
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
		$this->ci->session->set_flashdata('mensaje', '¡¡¡Has cerrado sesión exitosamente!!!');
		redirect('auth/login_usuario');
	}
}
?>