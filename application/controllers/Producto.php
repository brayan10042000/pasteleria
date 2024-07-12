<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Producto extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_producto');
        $this->load->model('m_categoria');
    }

    // Listar todos tus artículos
    public function index()
    {
        $data = array(
            'title' => 'Producto',
            'producto' => $this->m_producto->obtener_todos_los_datos(),
            'isi' => 'producto/v_producto',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Agregar un nuevo artículo
    public function agregar()
    {
        $this->form_validation->set_rules('nombre_producto', 'Nombre del Producto', 'required', 
        array('required' => '%s debe ser completado !!!'));
        $this->form_validation->set_rules('id_categoria', 'Categoría', 'required', 
        array('required' => '%s debe ser completado !!!'));
        $this->form_validation->set_rules('precio', 'Precio', 'required', 
        array('required' => '%s debe ser completado !!!'));
        $this->form_validation->set_rules('peso', 'Peso', 'required', 
        array('required' => '%s debe ser completado !!!'));
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required', 
        array('required' => '%s debe ser completado !!!'));
        
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/imagen/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2000';
            $this->upload->initialize($config);
            $field_name = "imagen";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Agregar Producto',
                    'categoria' => $this->m_categoria->obtener_todos_los_datos(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'producto/v_agregar',
                );
                $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/imagen/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'nombre_producto' => $this->input->post('nombre_producto'),
                    'id_categoria' => $this->input->post('id_categoria'),
                    'precio' => $this->input->post('precio'),
                    'peso' => $this->input->post('peso'),
                    'descripcion' => $this->input->post('descripcion'),
                    'imagen' => $upload_data['uploads']['file_name'],
                );
                $this->m_producto->add($data);
                $this->session->set_flashdata('mensaje', 'Datos agregados con éxito!!!');
                redirect('producto');
            }
        }
        $data = array(
            'title' => 'Agregar Producto',
            'categoria' => $this->m_categoria->obtener_todos_los_datos(),
            'isi' => 'producto/v_agregar',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Actualizar un artículo
    public function editar($id_producto = NULL)
    {
        $this->form_validation->set_rules('nombre_producto', 'Nombre del Producto', 'required', 
        array('required' => '%s debe ser completado !!!'));
        $this->form_validation->set_rules('id_categoria', 'Categoría', 'required', 
        array('required' => '%s debe ser completado !!!'));
        $this->form_validation->set_rules('precio', 'Precio', 'required', 
        array('required' => '%s debe ser completado !!!'));
        $this->form_validation->set_rules('peso', 'Peso', 'required', 
        array('required' => '%s debe ser completado !!!'));
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required', 
        array('required' => '%s debe ser completado !!!'));
        
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/imagen/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2000';
            $this->upload->initialize($config);
            $field_name = "imagen";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Actualizar Producto',
                    'categoria' => $this->m_categoria->obtener_todos_los_datos(),
                    'producto' => $this->m_producto->obtener_datos($id_producto),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'producto/v_editar',
                );
                $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            } else {
                // eliminar imagen
                $producto = $this->m_producto->obtener_datos($id_producto);
                if ($producto->imagen != "") {
                    unlink('./assets/imagen/' . $producto->imagen);
                }
                // fin eliminar imagen
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/imagen/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                
                $data = array(
                    'id_producto' => $id_producto,
                    'nombre_producto' => $this->input->post('nombre_producto'),
                    'id_categoria' => $this->input->post('id_categoria'),
                    'precio' => $this->input->post('precio'),
                    'peso' => $this->input->post('peso'),
                    'descripcion' => $this->input->post('descripcion'),
                    'imagen' => $upload_data['uploads']['file_name'],
                );
                $this->m_producto->editar($data);
                $this->session->set_flashdata('mensaje', 'Datos actualizados con éxito!!!');
                redirect('producto');
            }
            // si no se cambia la imagen
            $data = array(
                'id_producto' => $id_producto,
                'nombre_producto' => $this->input->post('nombre_producto'),
                'id_categoria' => $this->input->post('id_categoria'),
                'precio' => $this->input->post('precio'),
                'peso' => $this->input->post('peso'),
                'descripcion' => $this->input->post('descripcion'),
            );
            $this->m_producto->editar($data);
            $this->session->set_flashdata('mensaje', 'Datos actualizados con éxito!!!');
            redirect('producto');
        }
        $data = array(
            'title' => 'Actualizar Producto',
            'categoria' => $this->m_categoria->obtener_todos_los_datos(),
            'producto' => $this->m_producto->obtener_datos($id_producto),
            'isi' => 'producto/v_editar',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Eliminar un artículo
    public function eliminar($id_producto = NULL)
    {
        // eliminar imagen
        $producto = $this->m_producto->obtener_datos($id_producto);
        
        if ($producto->imagen != "") {
            unlink('./assets/imagen/' . $producto->imagen);
        }
        // fin eliminar imagen
        $data = array('id_producto' => $id_producto);
        $this->m_producto->delete($data);
        $this->session->set_flashdata('mensaje', 'Datos eliminados con éxito !!!');
        redirect('producto');
    }
}
?>
