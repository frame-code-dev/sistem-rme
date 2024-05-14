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
		$antrian = $this->Pasien_model->getAntrian();
		$data['data'] = $antrian;
		$data['title'] = 'Data Pemeriksaan';
		$this->load->view('backoffice/pemeriksaan/index', $data);
	}

    public function create($id = null)
    {
        if (!isset($id)) redirect('pemeriksaan');

		$data['title'] = 'Pemeriksaan';
		$data['current_page'] = 'List Pemeriksaan';
		$data['current_user'] = $this->auth_model->current_user();
		$data['pasien'] = $this->Pasien_model->getById($id);
		if (!$data['pasien']) show_404();

		$this->load->view('backoffice/pemeriksaan/create', $data);
    }

    public function store()
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
			redirect('pemeriksaan/index');
        }
        else {
            $data['pasien'] = $this->Pasien_model->getById($this->input->post()['pasien_id']);
            $this->load->view('backoffice/pemeriksaan/create', $data);
		}
    }
}
