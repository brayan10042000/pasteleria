<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_imagenproducto extends CI_Model
{
    // obtener todos los datos
    public function obtener_todos_los_datos()
    {
        $this->db->select('tbl_producto.*,COUNT(tbl_imagen.id_producto) as total_imagen');
        $this->db->from('tbl_producto');
        $this->db->join('tbl_imagen', 'tbl_imagen.id_producto = tbl_producto.id_producto', 'left');
        $this->db->group_by('tbl_producto.id_producto');
        $this->db->order_by('tbl_producto.id_producto', 'desc');
        return $this->db->get()->result();
    }

    // obtener datos por ID de imagen
    public function obtener_datos($id_imagen)
    {
        $this->db->select('*');
        $this->db->from('tbl_imagen');
        $this->db->where('id_imagen', $id_imagen);
        return $this->db->get()->row();
    }

    // obtener imágenes por ID de producto
    public function obtener_imagenes($id_producto)
    {
        $this->db->select('*');
        $this->db->from('tbl_imagen');
        $this->db->where('id_producto', $id_producto);
        return $this->db->get()->result();
    }

    // agregar imagen
    public function agregar($data)
    {
        $this->db->insert('tbl_imagen', $data);
    }

    // eliminar imagen
    public function eliminar($data)
    {
        $this->db->where('id_imagen', $data['id_imagen']);
        $this->db->delete('tbl_imagen', $data);
    }
}
?>
