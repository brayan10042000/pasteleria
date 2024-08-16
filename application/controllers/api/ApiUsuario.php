<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class ApiUsuario extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_usuario'); // Cargar el modelo de usuarios
    }

    // Obtener todos los usuarios (GET)
    public function index_get()
    {
        $result_usr = $this->m_usuario->obtener_todos_los_datos(); // Usar el método exacto del modelo
        $this->response($result_usr, 200);
    }

    // Agregar un nuevo usuario (POST)
    public function agregar_post()
    {
        $data = [
            'nombre_usuario' => $this->input->post('nombre_usuario'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'rol' => $this->input->post('rol'),
        ];
        $result = $this->m_usuario->agregar($data); // Usar el método exacto del modelo

        if ($result === true) {
            $this->response([
                'status' => true,
                'message' => 'Nuevo usuario creado',
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Usuario no creado',
                'error' => $result // Mostrar el error
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Editar un usuario existente (PUT)
    public function editar_put($id_usuario)
    {
        $data = [
            'id_usuario' => $id_usuario,
            'nombre_usuario' => $this->put('nombre_usuario'),
            'email' => $this->put('email'),
            'password' => $this->put('password'),
            'rol' => $this->put('rol'),
        ];

        if (!is_array($data)) {
            $this->response(['status' => false, 'message' => 'Error en los datos enviados'], RestController::HTTP_BAD_REQUEST);
            return;
        }

        $result = $this->m_usuario->editar($data); // Usar el método exacto del modelo

        if ($result === true) {
            $this->response(['status' => true, 'message' => 'Usuario actualizado con éxito'], RestController::HTTP_OK);
        } else {
            $this->response(['status' => false, 'message' => 'Error al actualizar el usuario', 'error' => $result], RestController::HTTP_BAD_REQUEST);
        }
    }

    // Eliminar un usuario (DELETE)
    public function eliminar_delete($id_usuario)
    {
        $usuario = $this->m_usuario->obtener_todos_los_datos(['id_usuario' => $id_usuario]); // Cambiar método para obtener usuario

        if ($usuario) {
            $result = $this->m_usuario->eliminar(['id_usuario' => $id_usuario]); // Usar el método exacto del modelo

            if ($result === true) {
                $this->response([
                    'status' => true,
                    'message' => 'Usuario eliminado con éxito'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Error al eliminar el usuario',
                    'error' => $result // Mostrar el error si la eliminación falla
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Usuario no encontrado'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
