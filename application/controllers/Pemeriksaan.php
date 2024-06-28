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
		$this->load->model('Log_Model');
		$this->load->model('Rekam_model');
		$this->load->model('Obat_model');
		$this->load->model('Apotek_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index() : void
	{
		$data['current_user'] = $this->auth_model->current_user();
		$antrian = $this->Pasien_model->getAntrean();
		$data['data'] = $antrian;
		$data['title'] = 'Dashboard';
        $data['total_antrean'] = $this->Pasien_model->getTotalAntrean();
        $data['total_diperiksa'] = $this->Pasien_model->getTotalPasienDiperiksa();
        $data['total_pasien_today'] = $this->Pasien_model->getTotalPasienToday();

		$data['log'] = $this->Log_Model->getAll();
		$this->load->view('backoffice/pemeriksaan/index', $data);
	}
    
    public function list() : void
    {
        $data['current_user'] = $this->auth_model->current_user();
		$antrian = $this->Pasien_model->getAntrean();
		$data['data'] = $antrian;
		$data['title'] = 'Data Pemeriksaan';
		$this->load->view('backoffice/pemeriksaan/list', $data);
    }

    public function create($id = null) : void
    {
        if (!isset($id)) redirect('pemeriksaan');

		$data['title'] = 'Rekam Medis';
		$data['current_page'] = 'List Rekam Medis';
		$data['current_pemeriksaan'] = $this->Pemeriksaan_model->getById($id);
		$data['current_user'] = $this->auth_model->current_user();
		$data['pasien'] = $this->Pasien_model->getById($data['current_pemeriksaan']->pasien_id);
		if (!$data['pasien']) show_404();

		$this->load->view('backoffice/pemeriksaan/create', $data);
    }

    public function store() : void
    {
        $data['title'] = 'Pemeriksaan';
		$data['current_page'] = 'List Pemeriksaan';
		$data['current_user'] = $this->auth_model->current_user();
		$pemeriksaan = $this->Pemeriksaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($pemeriksaan->rules());

        if ($validation->run()) {
			$pemeriksaan->save();
            $this->session->set_flashdata('message', 'Berhasil melakukan pemeriksaan.');
			redirect('rekam-medis/create/' . $this->input->post()['id']);
        }
        else {
            $data['pasien'] = $this->Pasien_model->getById($this->input->post()['pasien_id']);
			$data['current_pemeriksaan'] = $this->Pemeriksaan_model->getById($this->input->post()['pasien_id']);
            $this->load->view('backoffice/pemeriksaan/create', $data);
		}
    }
}
