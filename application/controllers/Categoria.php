<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categoria extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_categoria');
	}

	// Listar todos los ítems
	public function index()
	{
		// Si no es superadmin, redirigir al dashboard
		if ($this->session->userdata('username') == 'superadmin')  
		{
			$data = array(
				'title' => 'Categoría',
				'categoria' => $this->m_categoria->obtener_todos_los_datos(),
				'contenido' => 'v_categoria',
			);
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
		}else{
			redirect('admin');
		}
	}

	// Agregar un nuevo ítem
	public function agregar()
	{
		if ($this->session->userdata('username') == 'superadmin')  
		{
			$data = array(
				'nombre_categoria' => $this->input->post('nombre_categoria'),
			);
			
			$this->m_categoria->agregar($data);
			$this->session->set_flashdata('mensaje', '¡Datos agregados exitosamente!');
			redirect('categoria');
		}else{
			redirect('admin');
		}
	}

	// Actualizar un ítem
	public function editar($id_categoria = NULL)
	{
		if ($this->session->userdata('username') == 'superadmin')  
		{
			$data = array(
				'id_categoria' => $id_categoria,
				'nombre_categoria' => $this->input->post('nombre_categoria'),
			);
			$this->m_categoria->editar($data);
			$this->session->set_flashdata('mensaje', '¡Datos actualizados exitosamente!');
			redirect('categoria');
		}else{
			redirect('admin');
		}
	}

	// Eliminar un ítem
	public function eliminar($id_categoria = NULL)
	{
		if ($this->session->userdata('username') == 'superadmin')
		{
			$data = array('id_categoria' => $id_categoria);
			$this->m_categoria->eliminar($data);
			$this->session->set_flashdata('mensaje', '¡Datos eliminados exitosamente!');
			redirect('categoria');
		}else{
			redirect('admin');
		}
	}
}
?>
