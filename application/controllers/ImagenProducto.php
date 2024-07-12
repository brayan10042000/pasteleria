<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImagenProducto extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_imagenproducto');
        $this->load->model('m_producto');
    }

    public function index()
    {
        $data = array(
            'title' => 'Imagen del Producto',
            'imagenproducto' => $this->m_imagenproducto->obtener_todos_los_datos(),
            'isi' => 'imagenproducto/v_index',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function agregar($id_producto)
    {
        $this->form_validation->set_rules('descripcion', 'Descripción de la Imagen', 'required', array(
            'required' => '%s ¡Debe ser completado!'
        ));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/imagenproducto/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '2000';
            $this->upload->initialize($config);
            $field_name = "imagen";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Agregar Imagen del Producto',
                    'error_upload' => $this->upload->display_errors(),
                    'producto'  => $this->m_producto->get_data($id_producto),
                    'imagen' => $this->m_imagenproducto->get_imagen($id_producto),
                    'isi' => 'imagenproducto/v_agregar',
                );
                $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            } else {
                $upload_data	= array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/imagenproducto/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'id_producto' => $id_producto,
                    'descripcion' => $this->input->post('descripcion'),
                    'imagen'	=> $upload_data['uploads']['file_name'],
                );

                $this->m_imagenproducto->agregar($data);
                $this->session->set_flashdata('mensaje', '¡Imagen agregada con éxito!');
                redirect('imagenproducto/agregar/' . $id_producto);
            }
        }
        $data = array(
            'title' => 'Agregar Imagen del Producto',
            'producto'  => $this->m_producto->get_data($id_producto),
            'imagen' => $this->m_imagenproducto->get_imagen($id_producto),
            'isi' => 'imagenproducto/v_agregar',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function eliminar($id_producto, $id_imagen)
    {
        // eliminar imagen
        $imagen = $this->m_imagenproducto->get_data($id_imagen);
        
        if ($imagen->imagen != "") {
            unlink('./assets/imagenproducto/' . $imagen->imagen);
        }
        // fin eliminar imagen
        $data = array('id_imagen' => $id_imagen);
        $this->m_imagenproducto->eliminar($data);
        $this->session->set_flashdata('mensaje', '¡Imagen eliminada con éxito!');
        redirect('imagenproducto/agregar/' . $id_producto);
    }
}
?>
