<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apotek extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Apotek_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index() : void
	{
		$data['current_user'] = $this->auth_model->current_user();
		$apotek = $this->Apotek_model->getAll();
		
		$data['data'] = $apotek;
		$data['title'] = 'List Antrian Obat Pasien';

		$this->load->view('backoffice/apotek/index', $data);
	}


	public function detail($rm_id) : void
	{
		$status = 'failed';
		$message = null;
		$data = null;

		if ($rm_id) {
			$status = 'success';
			$message = 'Berhasil mengambil data';
			$diagnosa = $this->Apotek_model->getRekamDiagnosaByRekamId($rm_id);
			$obat = $this->Apotek_model->getRekamObatByRekamId($rm_id);

			$data = new stdClass;
			$data->diagnosa = $diagnosa;
			$data->obat = $obat;
		}
		

		$response = new stdClass;
		$response->status = $status;
		$response->message = $message;
		$response->data = $data;

		echo json_encode($response);
	}
}
