<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pasien_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('Log_Model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['current_user'] = $this->auth_model->current_user();
		$pasien = $this->Pasien_model->getAll();
		$data['data'] = $pasien;
		$data['title'] = 'Data Pasien';
		$this->load->view('backoffice/pasien/index', $data);
	}

	public function list()
	{
		$data['current_user'] = $this->auth_model->current_user();
		$pasien = $this->Pasien_model->getAll();
		$data['data'] = $pasien;
		$data['title'] = 'Data Pasien';
		$this->load->view('backoffice/pasien/list', $data);
	}

	public function create() {
		$data['title'] = 'Tambah Pasien';
		$data['current_page'] = 'List Pendaftaran';
		$data['current_user'] = $this->auth_model->current_user();
		// Mendapatkan nomor urutan terakhir
		$no_rm = $this->Pasien_model->get_sequence();
		$no_antrian = $this->Pasien_model->get_nomor_antrian();
		$data['no_antrian'] = $no_antrian;
		// Menampilkan nomor urutan baru
		$data['no_rm'] = $no_rm;
		$this->load->view('backoffice/pasien/create', $data);
	}

	public function store() {
		$data['title'] = 'Tambah Pasien';
		$data['current_page'] = 'List Pendaftaran';
		$data['current_user'] = $this->auth_model->current_user();
		$no_rm = $this->Pasien_model->get_sequence();
		$no_antrian = $this->Pasien_model->get_nomor_antrian();
		// Menampilkan nomor urutan baru
		$data['no_rm'] = $no_rm;
		$data['no_antrian'] = $no_antrian;

		$tambah = $this->Pasien_model;
		// memanggil library form validation 
        $validation = $this->form_validation;
        $validation->set_rules($tambah->rules());
        if ($validation->run()) {
			$pasien_id = $tambah->save();
			$this->db->insert('pemeriksaan_pasien',[
				'pasien_id' => $pasien_id,
			]);
			// LOG 
			$nama = $this->Pasien_model->getById($pasien_id)->name;
			$status = 'Pasien : '.$nama.' Menunggu dilayanin dokter.';
			$this->Log_Model->insert([
				'pasien_id' => $pasien_id,
				'status' =>  $status,
				'created_at' => date('Y-m-d H:i:s'),
			]);
            $this->session->set_flashdata('message', 'Berhasil menambahkan data.');
			redirect('nomor_antrian/index/' . $pasien_id);
        }else{
			$this->load->view('backoffice/pasien/create', $data);
		}
	}

	public function edit($id) {
		$data['current_user'] = $this->auth_model->current_user();
		$data['title'] = 'Edit Pasien';
		$data['current_page'] = 'List Pasien';

		$data['data'] = $this->Pasien_model->getById($id);
		$this->load->view('backoffice/pasien/edit', $data);
	}

	public function update($id = null)
    {
        if (!isset($id)) redirect('pasien');
       
        $pasien = $this->Pasien_model;
        $validation = $this->form_validation;
        $validation->set_rules($pasien->edit_rules());

        if ($validation->run()) {
            $pasien->updateData($id);
            $this->session->set_flashdata('message', 'Berhasil mengganti data');
			redirect('pasien');
        }else{
			$data['title'] = 'Edit Pasien';
			$data['current_user'] = $this->auth_model->current_user();
			$data['current_page'] = 'List Pasien';
			$data["data"] = $pasien->getById($id);
			
			$this->load->view("backoffice/pasien/edit", $data);
		}
    }

	public function delete($id = null) {
		if (!isset($id)) redirect('pasien');
		$pasien = $this->Pasien_model;
		$pasien->delete($id);
		$this->session->set_flashdata('message', 'Berhasil menghapus data');
		redirect('pasien');
	}

}
