<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_pedidos_recibidos');

    }

    public function index()
    {
        $data = array(
            'title' => 'Tablero',
            'total_producto' => $this->m_admin->total_producto(),
            'total_categoria' => $this->m_admin->total_categoria(),
            'total_pedidos_recibidos' => $this->m_admin->total_pedidos_recibidos(),
            'total_cliente' => $this->m_admin->total_cliente(),
            'contenido' => 'v_admin',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function configuracion()
    {
        // Solo accesible para superadmin
        if ($this->session->userdata('username') == 'superadmin') {
            $this->form_validation->set_rules('nombre_tienda', 'Nombre de la Tienda', 'required', array('required' => '%s debe ser completado !!!'));
            $this->form_validation->set_rules('ciudad', 'Ciudad', 'required', array('required' => '%s debe ser completado !!!'));
            $this->form_validation->set_rules('direccion_tienda', 'Dirección de la Tienda', 'required', array('required' => '%s debe ser completado !!!'));
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required', array('required' => '%s debe ser completado !!!'));
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'title' => 'Configuración',
                    'configuracion' => $this->m_admin->datos_configuracion(),
                    'contenido' => 'v_configuracion',
                );
                $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            } else {
                $data = array(
                    'id' => 1,
                    'ubicacion' => $this->input->post('ciudad'),
                    'nombre_tienda' => $this->input->post('nombre_tienda'),
                    'direccion_tienda' => $this->input->post('direccion_tienda'),
                    'telefono' => $this->input->post('telefono'),
                );
                $this->m_admin->editar($data);
                $this->session->set_flashdata('mensaje', '¡Configuración cambiada con éxito!');
                redirect('admin/configuracion');
            }
        } else {
            redirect('admin');
        }
    }

    // Lista todos tus items
    public function lista_clientes($offset = 0)
    {
        $data = array(
            'title' => 'Clientes',
            'clientes' => $this->m_admin->obtener_todos_datos(),
            'contenido' => 'v_cliente',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function pedidos_recibidos()
    {
        $data = array(
            'title' => 'Pedidos Recibidos',
            'pedido' => $this->m_pedidos_recibidos->pedido(),
            'pedido_en_proceso' => $this->m_pedidos_recibidos->pedido_en_proceso(),
            'pedido_enviado' => $this->m_pedidos_recibidos->pedido_enviado(),
            'pedido_completado' => $this->m_pedidos_recibidos->pedido_completado(),
            'contenido' => 'v_pedidos_recibidos',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function procesar($id_transaccion)
    {
        $data = array(
            'id_transaccion' => $id_transaccion,
            'estado_orden' => '1'
        );
        $this->m_pedidos_recibidos->actualizar_pedido($data);
        $this->session->set_flashdata('mensaje', '¡Pedido procesado/empacado con éxito!');
        redirect('admin/pedidos_recibidos');
    }

    public function enviar($id_transaccion)
    {
        $data = array(
            'id_transaccion' => $id_transaccion,
            'numero_rastreo' => $this->input->post('numero_rastreo'),
            'estado_orden' => '2'
        );
        $this->m_pedidos_recibidos->actualizar_pedido($data);
        $this->session->set_flashdata('mensaje', '¡Pedido enviado con éxito!');
        redirect('admin/pedidos_recibidos');
    }
}
?>
