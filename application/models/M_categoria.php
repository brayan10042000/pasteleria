<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_categoria extends CI_Model
{
    // obtener todos los datos
    public function obtener_todos_los_datos()
    {
        $this->db->select('*');
        $this->db->from('tbl_categoria');
        $this->db->order_by('id_categoria', 'desc');
        return $this->db->get()->result();
    }

    // añadir
    public function agregar($data)
    {
        $this->db->insert('tbl_categoria', $data);
    }

    // editar
    public function editar($data)
    {
        $this->db->where('id_categoria', $data['id_categoria']);
        $this->db->update('tbl_categoria', $data);
    }

    // eliminar
    public function eliminar($data)
    {
        $this->db->where('id_categoria', $data['id_categoria']);
        $this->db->delete('tbl_categoria', $data);
    }
}
?>
