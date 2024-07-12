<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    // contar total de productos
    public function total_producto()
    {
        return $this->db->get('tbl_producto')->num_rows();
    }

    // contar total de categorías
    public function total_categoria()
    {
        return $this->db->get('tbl_categoria')->num_rows();
    }
    
    // contar total de pedidos
    public function total_pedidos_recibidos()
    {
        return $this->db->get('tbl_transaccion')->num_rows();
    }
    
    // contar total de clientes
    public function total_cliente()
    {
        return $this->db->get('tbl_cliente')->num_rows();
    }
    
    // obtener configuración
    public function datos_configuracion()
    {
        $this->db->select('*');
        $this->db->from('tbl_configuracion');
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }
    
    // obtener todos los datos de clientes
    public function obtener_todos_datos()
    {
        $this->db->select('*');
        $this->db->from('tbl_cliente');
        $this->db->order_by('id_cliente', 'desc');
        return $this->db->get()->result();
    }
    
    // editar configuración
    public function editar($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_configuracion', $data);
    }
}
?>
