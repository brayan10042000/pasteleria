<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rajaongkir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
    }

    public function provincia()
    {
        $data_provincia = [
            ['province_id' => 1, 'province' => 'Antioquia'],
            ['province_id' => 2, 'province' => 'Bogotá'],
            ['province_id' => 3, 'province' => 'Cundinamarca'],
            // Agrega más provincias según sea necesario
        ];

        echo "<option value=''>--Seleccionar Provincia--</option>";
        foreach ($data_provincia as $provincia) {
            echo "<option value='" . $provincia['province'] . "' id_provincia='" . $provincia['province_id'] . "'>" . $provincia['province'] . "</option>";
        }
    }

    public function ciudad()
    {
        $id_provincia_seleccionada = $this->input->post('id_provincia');

        $ciudades_por_provincia = [
            1 => [
                ['city_id' => 1, 'city_name' => 'Medellín'],
                ['city_id' => 2, 'city_name' => 'Envigado'],
                // Agrega más ciudades para Antioquia
            ],
            2 => [
                ['city_id' => 3, 'city_name' => 'Bogotá D.C.'],
                // Agrega más ciudades para Bogotá
            ],
            3 => [
                ['city_id' => 4, 'city_name' => 'Soacha'],
                ['city_id' => 5, 'city_name' => 'Chía'],
                // Agrega más ciudades para Cundinamarca
            ],
            // Agrega más provincias y sus ciudades
        ];

        $data_ciudad = isset($ciudades_por_provincia[$id_provincia_seleccionada]) ? $ciudades_por_provincia[$id_provincia_seleccionada] : [];

        echo "<option value=''>--Seleccionar Ciudad--</option>";
        foreach ($data_ciudad as $ciudad) {
            echo "<option value='" . $ciudad['city_id'] . "' id_ciudad='" . $ciudad['city_id'] . "'>" . $ciudad['city_name'] . "</option>";
        }
    }

    public function expedicion()
    {
        echo '<option value="">--Seleccionar Expedición--</option>';
        echo '<option value="servientrega">Servientrega</option>';
        echo '<option value="interrapidisimo">Interrapidísimo</option>';
        echo '<option value="envia">Envia</option>';
        // Agrega más opciones de expedición si es necesario
    }

    public function paquete()
    {
        $paquetes = [
            ['service' => 'Express', 'cost' => 15000, 'etd' => 2],
            ['service' => 'Standard', 'cost' => 10000, 'etd' => 5],
            ['service' => 'Económico', 'cost' => 7000, 'etd' => 7],
            // Agrega más opciones de paquetes si es necesario
        ];

        echo "<option value=''>--Seleccionar Paquete--</option>";
        foreach ($paquetes as $paquete) {
            echo "<option value='" . $paquete['service'] . "' costo_envio='" . $paquete['cost'] . "' estimacion='" . $paquete['etd'] . " Días'>";
            echo $paquete['service'] . " | $" . $paquete['cost'] . " | " . $paquete['etd'] . " Días";
            echo "</option>";
        }
    }
}
?>
