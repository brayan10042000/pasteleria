<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carrito extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transacciones');
    }

    public function index()
    {
        if (empty($this->cart->contents())) {
            redirect('inicio');
        }
        $data = array(
            'title' => 'Carrito de Compras',
            'contenido' => 'v_carrito',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function agregar()
    {
        $redirect_page = $this->input->post('redirect_page');
        $data = array(
            'id'      => $this->input->post('id'),
            'qty'     => $this->input->post('qty'),
            'price'   => $this->input->post('price'),
            'name'    => $this->input->post('name'),
        );
        $this->cart->insert($data);
        redirect($redirect_page, 'refresh');
    }

    public function eliminar($rowid)
    {
        $this->cart->remove($rowid);
        redirect('carrito');
    }

    public function actualizar()
    {
        $i = 1;
        foreach ($this->cart->contents() as $items) {
            $data = array(
                'rowid' => $items['rowid'],
                'qty'   => $this->input->post($i . '[qty]'),
            );
            $this->cart->update($data);
            $i++;
        }
        $this->session->set_flashdata('mensaje', 'El carrito de compras ha sido actualizado con éxito!!!');
        redirect('carrito');
    }

    public function vaciar()
    {
        $this->cart->destroy();
        redirect('carrito');
    }

    public function checkout()
    {
        $this->cliente_login->proteccion_pagina();
        $this->form_validation->set_rules('provincia', 'Provincia', 'required');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'required');
        $this->form_validation->set_rules('expedicion', 'Expedicion', 'required');
        $this->form_validation->set_rules('paquete', 'Paquete', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Carrito de Checkout',
                'contenido' => 'v_checkout',
            );
            $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        } else {
            // guardar en tabla transacción
            $data = array(
                'id_cliente' => $this->session->userdata('id_cliente'),
                'numero_orden' => $this->input->post('numero_orden'),
                'fecha_orden' => date('Y-m-d'),
                'nombre_receptor' => $this->input->post('nombre_receptor'),
                'telefono_receptor' => $this->input->post('telefono_receptor'),
                'provincia' => $this->input->post('provincia'),
                'ciudad' => $this->input->post('ciudad'),
                'direccion' => $this->input->post('direccion'),
                'codigo_postal' => $this->input->post('codigo_postal'),
                'expedicion' => $this->input->post('expedicion'),
                'paquete' => $this->input->post('paquete'),
                'estimacion' => $this->input->post('estimacion'),
                'costo_envio' => $this->input->post('costo_envio'),
                'peso' => $this->input->post('peso'),
                'total_general' => $this->input->post('total_general'),
                'total_pago' => $this->input->post('total_pago'),
                'estado_pago' => '0',
                'estado_orden' => '0',
            );
            $this->m_transacciones->guardar_transaccion($data);
            
            // guardar en tabla detalles transacción
            $i = 1;
            foreach ($this->cart->contents() as $item) {
                $data_rinci = array(
                    'numero_orden' => $this->input->post('numero_orden'),
                    'id_producto' => $item['id'],
                    'cantidad' => $this->input->post('qty' . $i++),
                );
                $this->m_transacciones->guardar_detalle_transaccion($data_rinci);
            }
            $this->session->set_flashdata('mensaje', '¡Orden procesada con éxito!');
            $this->cart->destroy();
            redirect('mis_pedidos');
        }
    }
}
?>
