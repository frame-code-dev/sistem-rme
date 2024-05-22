<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Obat_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['current_user'] = $this->auth_model->current_user();
		$obat = $this->Obat_model->getAll();
		$data['title'] = 'Data Obat';
		$data['data'] = $obat;
		$this->load->view('backoffice/obat/index', $data);
	}

	public function create()
	{
		$data['title'] = 'Tambah Obat';
		$data['current_page'] = 'List Obat';
		$data['current_user'] = $this->auth_model->current_user();
		$this->load->view('backoffice/obat/create', $data);
	}

	public function store() {
		$data['title'] = 'Tambah Obat';
		$data['current_page'] = 'List Obat';

		$tambah = $this->Obat_model;
        $validation = $this->form_validation;
        $validation->set_rules($tambah->rules());

        if ($validation->run()) {
            $tambah->save();
            $this->session->set_flashdata('message', 'Berhasil menambahkan data.');
			redirect('obat');
        }else{
			$this->load->view('backoffice/obat/create', $data);
		}
	}

	public function edit($id = null) {
		if (!isset($id)) redirect('obat');

		$data['title'] = 'Edit Obat';
		$data['current_page'] = 'List Obat';
		$data['current_user'] = $this->auth_model->current_user();
		$data['obat'] = $this->Obat_model->getById($id);
		if (!$data['obat']) show_404();

		$this->load->view('backoffice/obat/edit', $data);
	}

	public function update($id = null)
    {
        if (!isset($id)) redirect('user');
       
        $obat = $this->Obat_model;
        $validation = $this->form_validation;
        $validation->set_rules($obat->rules());

        if ($validation->run()) {
            $obat->updateData($id);
            $this->session->set_flashdata('message', 'Berhasil mengganti data');
			redirect('obat');
        }else{
			$data['title'] = 'Edit Obat';
			$data['current_page'] = 'List Obat';
			$data["obat"] = $obat->getById($id);
			$this->load->view("backoffice/obat/edit", $data);
		}
    }

	public function delete($id = null) {
		if (!isset($id)) redirect('obat');
		$obat = $this->Obat_model;
		$obat->delete($id);
		$this->session->set_flashdata('message', 'Berhasil menghapus data');
		redirect('obat');
	}

	public function editStok($id = null) {
		if (!isset($id)) redirect('obat');

		$data['title'] = 'Update Stok Obat';
		$data['current_page'] = 'List Obat';
		$data['current_user'] = $this->auth_model->current_user();
		$data['obat'] = $this->Obat_model->getById($id);
		if (!$data['obat']) show_404();
		$this->load->view('backoffice/obat/edit_stok', $data);
	}
	public function updateStok($id = null)
    {
        if (!isset($id)) redirect('user');
       
        $obat = $this->Obat_model;
		$validation = $this->form_validation;
		$validation->set_rules('stok','Stok penerimaan obat','required');

        if ($validation->run()) {
            $obat->updateDataStok($id);
            $this->session->set_flashdata('message', 'Berhasil update stok');
			redirect('obat');
        }else{
			$data['title'] = 'Edit Obat';
			$data['current_page'] = 'List Obat';
			$data["obat"] = $obat->getById($id);
			
			$this->load->view("backoffice/obat/edit", $data);
		}

    }

}
