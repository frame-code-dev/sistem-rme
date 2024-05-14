<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RekamMedis extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pasien_model');
		$this->load->model('Rekam_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
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
		$data['title'] = 'Diagnosa Rekam Medis';
		$data['current_page'] = 'Rekam Medis';
		$data['current_user'] = $this->auth_model->current_user();
		
		$this->load->view('backoffice/rekam-medis/create', $data);
	}
}
