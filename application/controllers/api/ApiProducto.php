<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class ApiProducto extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_producto');
        $this->load->model('m_categoria');
    }

    public function index_get()
    {
        $result_emp = $this->m_producto->obtener_todos_los_datos();
        $this->response($result_emp, 200);
    }

    public function agregar_post()
    {
        $data = [
            'id_producto' => $this->input->post('id_producto'),
            'nombre_producto' => $this->input->post('nombre_producto'),
            'precio' => $this->input->post('precio'),
            'descripcion' => $this->input->post('descripcion'),
            'peso' => $this->input->post('peso'),
        ];
        $result = $this->m_producto->agregar($data);

        if ($result === true) {
            $this->response([
                'status' => true,
                'message' => 'nuevo producto creado',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'producto no creado',
                'error' => $result // Mostrar el error
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function editar_put($id_producto)
{
    $data = [
        'id_producto' => $id_producto,
        'nombre_producto' => $this->put('nombre_producto'),
        'id_categoria' => $this->put('id_categoria'),
        'precio' => $this->put('precio'),
        'peso' => $this->put('peso'),
        'descripcion' => $this->put('descripcion'),
    ];

    
    if (!is_array($data)) {
        $this->response(['status' => false, 'message' => 'Error en los datos enviados'], RestController::HTTP_BAD_REQUEST);
        return;
    }

    $result = $this->m_producto->editar($data);

    if ($result === true) {
        $this->response(['status' => true, 'message' => 'Producto actualizado con éxito'], RestController::HTTP_OK);
    } else {
        $this->response(['status' => false, 'message' => 'Error al actualizar el producto', 'error' => $result], RestController::HTTP_BAD_REQUEST);
    }
}

    // Eliminar un producto (DELETE)
    public function eliminar_delete($id_producto)
{
    $producto = $this->m_producto->obtener_datos($id_producto);

    if ($producto) {
        if (!empty($producto->imagen)) {
            unlink('./assets/imagen/' . $producto->imagen);
        }
        $result = $this->m_producto->eliminar(['id_producto' => $id_producto]);

        if ($result === true) {
            $this->response([
                'status' => true,
                'message' => 'Producto eliminado con éxito'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Error al eliminar el producto',
                'error' => $result // Mostrar el error si la eliminación falla
            ], RestController::HTTP_BAD_REQUEST);
        }
    } else {
        $this->response([
            'status' => false,
            'message' => 'Producto no encontrado'
        ], RestController::HTTP_NOT_FOUND);
    }
}
}