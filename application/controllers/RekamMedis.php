<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RekamMedis extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pasien_model');
		$this->load->model('Log_Model');
		$this->load->model('Rekam_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('Obat_model');
		$this->load->model('Apotek_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index() {
		$data['title'] = 'List Rekam Medis';
		$data['current_user'] = $this->auth_model->current_user();
		$data['data'] = $this->Rekam_model->getAll();
		$this->load->view('backoffice/rekam-medis/index',$data);
	}

	public function create($id) {
		$data['data'] = $this->Rekam_model->getById($id);
		$data['pasien'] = $this->Pasien_model->getById($data['data']->pasien_id);
		$data['obat'] = $this->Obat_model->getAll();

		$data['history_diagnosa'] = $this->Apotek_model->getDiagnosaById($data['data']->pasien_id);
		$data['title'] = 'Diagnosa Rekam Medis';
		$data['current_page'] = 'Rekam Medis';
		$data['current_user'] = $this->auth_model->current_user();
		$this->load->view('backoffice/rekam-medis/create', $data);
	}

	public function store($id) {
		$validation = $this->form_validation;
        $validation->set_rules('diganosa_utama_code', 'Diagnosa Utama Kode', 'required');
        $validation->set_rules('diganosa_utama_name', 'Diagnosa Utama Deskripsi', 'required');
        $validation->set_rules('kasus', 'Kasus', 'required');
		// LOG 
		$data['data'] = $this->Rekam_model->getById($id);
		$nama = $this->Pasien_model->getById($data['data']->pasien_id)->name;
		$status = 'Pasien : '.$nama.' Dilayanin Apotek.';
		$this->Log_Model->insert([
			'pasien_id' => $data['data']->pasien_id,
			'status' =>  $status,
			'created_at' => date('Y-m-d H:i:s'),
		]);
		if ($validation->run()) {
			$this->Rekam_model->save();
			$this->session->set_flashdata('message', 'Berhasil menambahkan data.');
			redirect('rekam-medis');
		}else{
			$data['history_diagnosa'] = $this->Apotek_model->getDiagnosaById($data['data']->pasien_id);
			$data['data'] = $this->Rekam_model->getById($id);
			$data['pasien'] = $this->Pasien_model->getById($data['data']->pasien_id);
			$data['obat'] = $this->Obat_model->getAll();
			$data['title'] = 'Diagnosa Rekam Medis';
			$data['current_page'] = 'Rekam Medis';
			$data['current_user'] = $this->auth_model->current_user();
			
			$this->load->view('backoffice/rekam-medis/create', $data);
		}

	}

	public function history($id) {
		$data['title'] = 'History Rekam Medis';
		$data['current_user'] = $this->auth_model->current_user();
		$data['pasien'] = $this->Pasien_model->getById($id);
		$data['history_pemeriksaan'] = $this->Apotek_model->historyPemeriksaan($id);
		$this->load->view('backoffice/rekam-medis/history',$data);
	}

	public function dataObat() {
		$obat = $this->Obat_model->getAll();
		echo json_encode($obat);
	}

	public function riwayat_pemeriksaan($id) {
		$data['data'] = $this->Rekam_model->getById($id);
		$data['pasien'] = $this->Pasien_model->getById($data['data']->pasien_id);
		$data['obat'] = $this->Obat_model->getAll();
		$data['history_diagnosa'] = $this->Apotek_model->getDiagnosaById($data['data']->pasien_id);
		$data['title'] = 'RESUME MEDIS';
		$data['current_user'] = $this->auth_model->current_user();
		$this->load->view('backoffice/rekam-medis/pdf', $data);
	}
	public function cetak_pemeriksaan($id) {
		$data['data'] = $this->Rekam_model->getByIdSukses($id);
		$data['pasien'] = $this->Pasien_model->getById($data['data']->pasien_id);
		$data['obat'] = $this->Obat_model->getAll();
		$data['history_diagnosa'] = $this->Apotek_model->getDiagnosaById($data['data']->pasien_id);
		$data['title'] = 'RESUME MEDIS';
		$data['current_user'] = $this->auth_model->current_user();
		$this->load->view('backoffice/rekam-medis/pdf-history', $data);
	}
}
