<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_reporte extends CI_Model
{
    // Reporte diario
    public function rep_diario($fecha, $mes, $año)
    {
        $this->db->select('*');
        $this->db->from('tbl_detalle_transaccion');
        $this->db->join('tbl_transaccion', 'tbl_transaccion.numero_orden = tbl_detalle_transaccion.numero_orden', 'left');
        $this->db->join('tbl_producto', 'tbl_producto.id_producto = tbl_detalle_transaccion.id_producto', 'left');
        $this->db->where('DAY(tbl_transaccion.fecha_orden)', $fecha);
        $this->db->where('MONTH(tbl_transaccion.fecha_orden)', $mes);
        $this->db->where('YEAR(tbl_transaccion.fecha_orden)', $año);
        return $this->db->get()->result();
    }

    // Informe mensual
    public function rep_mensual($mes, $año)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaccion');
        $this->db->where('MONTH(fecha_orden)', $mes);
        $this->db->where('YEAR(fecha_orden)', $año);
        $this->db->where('estado_pago=1');
        return $this->db->get()->result();
    }

    // Informe anual
    public function rep_anual($año)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaccion');
        $this->db->where('YEAR(fecha_orden)', $año);
        $this->db->where('estado_pago=1');
        return $this->db->get()->result();
    }
}
?>
