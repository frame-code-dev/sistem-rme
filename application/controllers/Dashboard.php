<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('Pasien_model');
		$this->load->model('Log_Model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data = [
			"current_user" => $this->auth_model->current_user(),
			"count_pasien" => $this->Pasien_model->totalKunjungan(),
			"count_umum" => $this->Pasien_model->totalPasienUmum(),
			"count_bpjs" => $this->Pasien_model->totalPasienBPJS(),
			"persentaseKunjungan" => $this->Pasien_model->persentaseKunjungan(),
			"log" => $this->Log_Model->getAll(),
		];
		$this->load->view('dashboard', $data);
	}

	// ... ada kode lain di sini ...
}
