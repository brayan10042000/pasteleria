<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class ApiCategoria extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_categoria'); // Cargar el modelo de categorías
    }

    // Obtener todas las categorías (GET)
    public function index_get()
    {
        $result_cat = $this->m_categoria->obtener_todos_los_datos(); // Usar el método exacto del modelo
        $this->response($result_cat, 200);
    }

    // Agregar una nueva categoría (POST)
    public function agregar_post()
    {
        $data = [
            'nombre_categoria' => $this->input->post('nombre_categoria'),
            'descripcion' => $this->input->post('descripcion'),
        ];
        $result = $this->m_categoria->agregar($data); // Usar el método exacto del modelo

        if ($result === true) {
            $this->response([
                'status' => true,
                'message' => 'Nueva categoría creada',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Categoría no creada',
                'error' => $result // Mostrar el error
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Editar una categoría existente (PUT)
    public function editar_put($id_categoria)
    {
        $data = [
            'id_categoria' => $id_categoria,
            'nombre_categoria' => $this->put('nombre_categoria'),
            'descripcion' => $this->put('descripcion'),
        ];

        if (!is_array($data)) {
            $this->response(['status' => false, 'message' => 'Error en los datos enviados'], RestController::HTTP_BAD_REQUEST);
            return;
        }

        $result = $this->m_categoria->editar($data); // Usar el método exacto del modelo

        if ($result === true) {
            $this->response(['status' => true, 'message' => 'Categoría actualizada con éxito'], RestController::HTTP_OK);
        } else {
            $this->response(['status' => false, 'message' => 'Error al actualizar la categoría', 'error' => $result], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Eliminar una categoría (DELETE)
    public function eliminar_delete($id_categoria)
    {
        $categoria = $this->m_categoria->obtener_todos_los_datos(['id_categoria' => $id_categoria]); // Cambiar método para obtener categoría

        if ($categoria) {
            $result = $this->m_categoria->eliminar(['id_categoria' => $id_categoria]); // Usar el método exacto del modelo

            if ($result === true) {
                $this->response([
                    'status' => true,
                    'message' => 'Categoría eliminada con éxito'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Error al eliminar la categoría',
                    'error' => $result // Mostrar el error si la eliminación falla
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Categoría no encontrada'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}

