<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_inicio extends CI_Model
{
    // obtener todos los datos
    public function obtener_todos_datos()
    {
        $this->db->select('*');
        $this->db->from('tbl_producto');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_producto.id_categoria', 'left');
        $this->db->order_by('tbl_producto.id_producto', 'desc');
        return $this->db->get()->result();
    }

    // obtener todos los datos de categorías
    public function obtener_todos_los_datos_categorias()
    {
        $this->db->select('*');
        $this->db->from('tbl_categoria');
        $this->db->order_by('id_categoria', 'desc');
        return $this->db->get()->result();
    }

    // obtener datos de la tienda
    public function obtener_datos_tienda()
    {
        $this->db->select('*');
        $this->db->from('tbl_configuracion');
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }

    // detalle de producto
    public function detalle_producto($id_producto)
    {
        $this->db->select('*');
        $this->db->from('tbl_producto');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_producto.id_categoria', 'left');
        $this->db->where('id_producto', $id_producto);
        return $this->db->get()->row();
    }

    // imágenes de producto
    public function imagenes_producto($id_producto)
    {
        $this->db->select('*');
        $this->db->from('tbl_imagen');
        $this->db->where('id_producto', $id_producto);
        return $this->db->get()->result();
    }

    // categoría
    public function categoria($id_categoria)
    {
        $this->db->select('*');
        $this->db->from('tbl_categoria');
        $this->db->where('id_categoria', $id_categoria);
        return $this->db->get()->row();
    }

    // obtener todos los datos de productos por categoría
    public function obtener_todos_los_datos_producto($id_categoria)
    {
        $this->db->select('*');
        $this->db->from('tbl_producto');
        $this->db->join('tbl_categoria', 'tbl_categoria.id_categoria = tbl_producto.id_categoria', 'left');
        $this->db->where('tbl_producto.id_categoria', $id_categoria);
        return $this->db->get()->result();
    }
}
?>
