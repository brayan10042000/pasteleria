<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_cliente');
		$this->load->model('m_auth');
	}

	public function index()
	{
		$data = array(
			'title' => 'Miembros',
			'clientes' => $this->m_admin->obtener_todos_datos(),
			'contenido' => 'v_cliente'
		);

		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function registrar()
	{
		$this->form_validation->set_rules('nombre_cliente', 'Nombre del Cliente', 'required', array('required' => '%s Debe ser completado!!!'));
		$this->form_validation->set_rules('correo', 'Correo Electrónico', 'required|is_unique[tbl_cliente.correo]', array('required' => '%s Debe ser completado!!!', 'is_unique' => '%s Este correo ya ha sido registrado...!'));
		$this->form_validation->set_rules('contraseña', 'Contraseña', 'required', array('required' => '%s Debe ser completado!!!'));
		$this->form_validation->set_rules('repetir_contraseña', 'Repetir Contraseña', 'required|matches[contraseña]', array('required' => '%s Debe ser completado!!!', 'matches' => '%s Las contraseñas no coinciden...!'));
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'title' => 'Registro de Miembro',
				'contenido' => 'v_registrar',
			);
			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
		} else {
			$data = array(
				'nombre_cliente' => $this->input->post('nombre_cliente'),
				'correo' => $this->input->post('correo'),
				'contraseña' => $this->input->post('contraseña'),
			);
			$this->m_cliente->registrar($data);
			$this->session->set_flashdata('mensaje', '¡Felicitaciones, Registro Exitoso! Por favor, inicia sesión.');
			redirect('cliente/login');
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('correo', 'Correo Electrónico', 'required', array('required' => '%s Debe ser completado!!!'));
		$this->form_validation->set_rules('contraseña', 'Contraseña', 'required', array('required' => '%s Debe ser completado!!!'));
		if ($this->form_validation->run() == TRUE) {
			$correo = $this->input->post('correo');
			$contraseña = $this->input->post('contraseña');
			$this->cliente_login->login($correo, $contraseña);
		}
		$data = array(
			'title' => 'Inicio de Sesión de Miembro',
			'contenido' => 'v_login_cliente',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function logout()
	{
		$this->cliente_login->logout();
	}

	public function cuenta()
	{
		// proteccion de página
		$this->cliente_login->proteccion_pagina();
		$data = array(
			'title' => 'Mi Cuenta',
			'contenido' => 'v_mi_cuenta',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}
}
?>
