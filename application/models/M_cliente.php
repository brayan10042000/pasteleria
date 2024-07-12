<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_cliente extends CI_Model
{
	public function registrar($datos)
	{
		$this->db->insert('tbl_cliente', $datos);
	}
}
?>
