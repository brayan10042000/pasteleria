<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_usuario extends CI_Model
{
    public function obtener_todos_los_datos()
    {
        $this->db->select('*');
        $this->db->from('tbl_usuario');
        $this->db->order_by('id_usuario', 'desc');
        return $this->db->get()->result();
    }

    public function agregar($data)
    {
        $this->db->insert('tbl_usuario', $data);
    }

    public function editar($data)
    {
        $this->db->where('id_usuario', $data['id_usuario']);
        $this->db->update('tbl_usuario', $data);
    }

    public function eliminar($data)
    {
        $this->db->where('id_usuario', $data['id_usuario']);
        $this->db->delete('tbl_usuario', $data);
    }
}
?>


