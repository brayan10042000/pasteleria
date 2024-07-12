<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pedidos_recibidos extends CI_Model
{
	public function pedido()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaccion');
		$this->db->where('estado_orden=0');
		$this->db->order_by('id_transaccion', 'desc');
		return $this->db->get()->result();
	}

	public function pedido_en_proceso()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaccion');
		$this->db->where('estado_orden=1');
		$this->db->order_by('id_transaccion', 'desc');
		return $this->db->get()->result();
	}

	public function pedido_enviado()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaccion');
		$this->db->where('estado_orden=2');
		$this->db->order_by('id_transaccion', 'desc');
		return $this->db->get()->result();
	}

	public function pedido_completado()
	{
		$this->db->select('*');
		$this->db->from('tbl_transaccion');
		$this->db->where('estado_orden=3');
		$this->db->order_by('id_transaccion', 'desc');
		return $this->db->get()->result();
	}

	public function actualizar_pedido($data)
	{
		$this->db->where('id_transaccion', $data['id_transaccion']);
		$this->db->update('tbl_transaccion', $data);
	}
}
?>