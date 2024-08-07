<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reporte extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_reporte');
    }

    public function index()
    {
        $data = array(
            'title' => 'Reporte',
            'contenido' => 'v_reporte',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function rep_diario()
    {
        $fecha = $this->input->post('fecha');
        $mes = $this->input->post('mes');
        $año = $this->input->post('año');

        $data = array(
            'title' => 'Reporte Diario',
            'fecha' => $fecha,
            'mes' => $mes,
            'año' => $año,
            'reporte' => $this->m_reporte->rep_diario($fecha, $mes, $año),
            'contenido' => 'v_rep_diario',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function rep_mensual()
    {
        $mes = $this->input->post('mes');
        $año = $this->input->post('año');

        $data = array(
            'title' => 'Reporte Mensual',
            'mes' => $mes,
            'año' => $año,
            'reporte' => $this->m_reporte->rep_mensual($mes, $año),
            'isi' => 'v_rep_mensual',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function rep_anual()
    {
        $año = $this->input->post('año');

        $data = array(
            'title' => 'Reporte Anual',
            'año' => $año,
            'reporte' => $this->m_reporte->rep_anual($año),
            'isi' => 'v_rep_anual',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
}
?>
