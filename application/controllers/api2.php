<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rajaongkir extends CI_Controller
{
	private $api_key = '1874787026a425d03602960b9e689e7c';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function provincia()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: $this->api_key"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$array_response = json_decode($response, true);
			$data_provincia = $array_response['rajaongkir']['results'];
			echo "<option value=''>--Seleccionar Provincia--</option>";
			foreach ($data_provincia as $key => $value) {
				echo "<option value='" . $value['province'] . "' id_provincia='" . $value['province_id'] . "'>" . $value['province'] . "</option>";
			}
		}
	}

	public function ciudad()
	{
		$id_provincia_seleccionada = $this->input->post('id_provincia'); 
	
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provincia_seleccionada,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: $this->api_key"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$array_response = json_decode($response, true);
			$data_ciudad = $array_response['rajaongkir']['results'];
			echo "<option value=''>--Seleccionar Ciudad--</option>";
			foreach ($data_ciudad as $key => $value) {
				echo "<option value='" . $value['city_id'] . "' id_ciudad='" . $value['city_id'] . "'>" . $value['city_name'] . "</option>";
			}
		}
	}

	public function expedicion()
	{
		echo '<option value="">--Seleccionar Expedición--</option>';
		echo '<option value="jne">JNE</option>';
		echo '<option value="tiki">TIKI</option>';
		echo '<option value="pos">POS Indonesia</option>';
	}

	public function paquete()
	{
		$id_ciudad_origen = $this->m_admin->datos_configuracion()->ubicacion;
		$expedicion = $this->input->post('expedicion');
		$id_ciudad = $this->input->post('id_ciudad');
		$peso = $this->input->post('peso');

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=" . $id_ciudad_origen . "&destination=" . $id_ciudad . "&weight=" . $peso . "&courier=" . $expedicion,
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: $this->api_key"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$array_response = json_decode($response, true);
			$data_paquete =  $array_response['rajaongkir']['results'][0]['costs'];
			echo "<option value=''>--Seleccionar Paquete--</option>";
			foreach ($data_paquete as $key => $value) {
				echo "<option value='" . $value['service'] . "' costo_envio='" . $value['cost'][0]['value'] . "' estimacion='" . $value['cost'][0]['etd'] . " Días'>";
				echo $value['service'] . " | Rp." . $value['cost'][0]['value'] . " | " . $value['cost'][0]['etd'] . " Días";
				echo "</option>";
			}
		}
	}
}
?>
