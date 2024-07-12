<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mis_pedidos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_transacciones');
		$this->load->model('m_pedidos_recibidos');
	}

	public function index()
	{
		$data = array(
			'title' => 'Mis Pedidos',
			'sin_pagar' => $this->m_transacciones->sin_pagar(),
			'en_proceso' => $this->m_transacciones->en_proceso(),
			'enviado' => $this->m_transacciones->enviado(),
			'completado' => $this->m_transacciones->completado(),
			'isi' => 'v_mis_pedidos',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function pagar($id_transaccion)
	{
		$this->form_validation->set_rules('a_nombre_de', 'A Nombre de', 'required', array('required' => '%s Debe ser completado!!!'));
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/comprobante_pago/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '2000';
			$this->upload->initialize($config);
			$field_name = 'comprobante_pago';
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
					'title' => 'Transacción',
					'pedido' => $this->m_transacciones->detalle_pedido($id_transaccion),
					'cuenta_bancaria' => $this->m_transacciones->cuenta_bancaria(),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'v_pagar',
				);
				$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
			} else {
				$upload_data = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/comprobante_pago/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'id_transaccion' => $id_transaccion,
					'a_nombre_de' => $this->input->post('a_nombre_de'),
					'nombre_banco' => $this->input->post('nombre_banco'),
					'numero_cuenta' => $this->input->post('numero_cuenta'),
					'estado_pago' => '1',
					'comprobante_pago' => $upload_data['uploads']['file_name'],
				);
				$this->m_transacciones->upload_comprobante_pago($data);
				$this->session->set_flashdata('mensaje', '¡Comprobante de Pago Subido Exitosamente!');
				redirect('mis_pedidos');
			}
		}

		$data = array(
			'title' => 'Transacción',
			'pedido' => $this->m_transacciones->detalle_pedido($id_transaccion),
			'cuenta_bancaria' => $this->m_transacciones->cuenta_bancaria(),
			'isi' => 'v_pagar',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function recibido($id_transaccion)
	{
		$data = array(
			'id_transaccion' => $id_transaccion,
			'estado_orden' => '3'
		);
		$this->m_pedidos_recibidos->actualizar_pedido($data);
		$this->session->set_flashdata('mensaje', '¡Pedido Recibido!');
		redirect('mis_pedidos');
	}
}
?>
