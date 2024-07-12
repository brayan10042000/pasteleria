<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transacciones extends CI_Model
{
	public function guardar_transaccion($data)
	{
		$this->db->insert('tbl_transaccion', $data);
	}

	public function guardar_detalle_transaccion($data_rinci)
	{
		$this->db->insert('tbl_detalle_transaccion', $data_rinci);
	}

	public function sin_pagar()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaccion');
		$this->db->where('id_cliente', $this->session->userdata('id_cliente'));
		$this->db->where('estado_orden=0');
		$this->db->order_by('id_transaccion', 'desc');
		return $this->db->get()->result();
	}

	public function en_proceso()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaccion');
		$this->db->where('id_cliente', $this->session->userdata('id_cliente'));
		$this->db->where('estado_orden=1');
		$this->db->order_by('id_transaccion', 'desc');
		return $this->db->get()->result();
	}

	public function enviado()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaccion');
		$this->db->where('id_cliente', $this->session->userdata('id_cliente'));
		$this->db->where('estado_orden=2');
		$this->db->order_by('id_transaccion', 'desc');
		return $this->db->get()->result();
	}

	public function completado()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaccion');
		$this->db->where('id_cliente', $this->session->userdata('id_cliente'));
		$this->db->where('estado_orden=3');
		$this->db->order_by('id_transaccion', 'desc');
		return $this->db->get()->result();
	}

	public function detalle_pedido($id_transaccion)
	{
		$this->db->select('*');
		$this->db->from('tbl_transaccion');
		$this->db->where('id_transaccion', $id_transaccion);
		return $this->db->get()->row();
	}

	public function cuenta_bancaria()
	{
		$this->db->select('*');
		$this->db->from('tbl_cuenta');
		return $this->db->get()->result();
	}

	public function subir_comprobante_pago($data)
	{
		$this->db->where('id_transaccion', $data['id_transaccion']);
		$this->db->update('tbl_transaccion', $data);
	}
}
?>
