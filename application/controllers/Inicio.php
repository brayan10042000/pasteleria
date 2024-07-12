<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_inicio');
	}

	public function index()
	{
		$data = array(
			'title' => 'Inicio',
			'producto' => $this->m_inicio->obtener_todos_datos(),
			'isi' => 'v_inicio',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function categoria($id_categoria)
	{
		$categoria = $this->m_inicio->categoria($id_categoria);
		$data = array(
			'title' => 'Categoría: ' . $categoria->nombre_categoria,
			'producto' => $this->m_inicio->obtener_todos_los_datos_producto($id_categoria),
			'isi' => 'v_categoria_producto',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function detalle_producto($id_producto)
	{
		$data = array(
			'title' => 'Detalles del Producto',
			'imagen' => $this->m_inicio->imagenes_producto($id_producto),
			'producto' => $this->m_inicio->detalle_producto($id_producto),
			'isi' => 'v_detalle_producto',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}
}
?>
