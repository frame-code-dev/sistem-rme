<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('Pasien_model');
		$this->load->model('Obat_model');
		$this->load->model('Log_Model');
		$this->load->model('Apotek_model');
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
			'stok_obat' => $this->Obat_model->stokObat(),
			"log" => $this->Log_Model->getAll(),
			"list_penyakit" => $this->Apotek_model->DiagnosaList(),
		];
		$this->load->view('dashboard', $data);
	}

	// ... ada kode lain di sini ...
}
