<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_configuracion extends CI_Model 
{
    public function obtener_todos_los_datos()
    {
        $this->db->select('*');
        $this->db->from('tbl_configuracion');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }    
}
?>