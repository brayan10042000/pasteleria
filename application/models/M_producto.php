<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_producto extends CI_Model
{
    // obtener todos los datos
    public function obtener_todos_los_datos()
    {
        $this->db->select('*');
        $this->db->from('tbl_producto');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_producto.id_categoria', 'left');
        $this->db->order_by('tbl_producto.id_producto', 'desc');
        return $this->db->get()->result();
    }

    // obtener datos por ID
    public function obtener_datos($id_producto)
    {
        $this->db->select('*');
        $this->db->from('tbl_producto');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_producto.id_categoria', 'left');
        $this->db->where('id_producto', $id_producto);
        return $this->db->get()->row();
    }

    // agregar datos
    public function agregar($data)
    {
        $this->db->insert('tbl_producto', $data);
        if ($this->db->affected_rows() > 0) {
        return true;
    } 
    else 
    {
        return $this->db->error(); // Devuelve el error si la inserción falla
    }
    }

    // editar datos
    public function editar($data)
{
    $this->db->where('id_producto', $data['id_producto']);
    $this->db->update('tbl_producto', $data);

    if ($this->db->affected_rows() > 0) {
        return true; // Actualización exitosa
    } else {
        if ($this->db->affected_rows() == 0 && $this->db->error()['code'] == 0) {
            return true; // No hubo cambios, pero no es un error
        } else {
            return $this->db->error(); // Devuelve el error si la actualización falla
        }
    }
}

    // eliminar datos
    public function eliminar($data)
{
    $this->db->where('id_producto', $data['id_producto']);
    $this->db->delete('tbl_producto');

    if ($this->db->affected_rows() > 0) {
        return true; // Eliminación exitosa
    } else {
        return $this->db->error(); // Devuelve el error si la eliminación falla
    }
}
}
?>
