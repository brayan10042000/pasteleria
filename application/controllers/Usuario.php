<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_usuario');
	}

	// Listar todos los elementos
	public function index($offset = 0)
	{
		$data = array(
			'title' => 'Usuario',
			'usuario' => $this->m_usuario->obtener_todos_los_datos(),
			'isi' => 'v_usuario',
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	// Añadir un nuevo elemento
	public function agregar()
	{
		if ($this->session->userdata('username') == 'superadmin') 
		{
			$data = array(
				'nombre_usuario' => $this->input->post('nombre_usuario'),
				'username' => $this->input->post('username'),
				'contraseña' => $this->input->post('contraseña'),	
			);
			$this->m_usuario->agregar($data);
			$this->session->set_flashdata('mensaje', 'Datos agregados con éxito !!!');
			redirect('usuario');
		}
	}

	// Actualizar un elemento
	public function editar($id_usuario = NULL)
	{
		if ($this->session->userdata('username') == 'superadmin') 
		{
			$data = array(
				'id_usuario' => $id_usuario,
				'nombre_usuario' => $this->input->post('nombre_usuario'),
				'username' => $this->input->post('username'),
				'contraseña' => $this->input->post('contraseña'),
			);
			$this->m_usuario->editar($data);
			$this->session->set_flashdata('mensaje', 'Datos actualizados con éxito !!!');
			redirect('usuario');
		}
	}

	// Eliminar un elemento
	public function eliminar($id_usuario = NULL)
	{
		if ($this->session->userdata('username') == 'superadmin')
		{
			$data = array('id_usuario' => $id_usuario);
			$this->m_usuario->eliminar($data);
			$this->session->set_flashdata('mensaje', 'Datos eliminados con éxito !!!');
			redirect('usuario');
		}
	}
}
?>
