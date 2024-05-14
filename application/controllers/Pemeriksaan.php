<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pasien_model');
		$this->load->model('Pemeriksaan_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['current_user'] = $this->auth_model->current_user();
		$antrian = $this->Pasien_model->getAll();
		$data['data'] = $antrian;
		$data['title'] = 'Data Pemeriksaan';
		$this->load->view('backoffice/pemeriksaan/index', $data);
	}
}
