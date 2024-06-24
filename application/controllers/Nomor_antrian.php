<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nomor_antrian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pasien_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('Log_Model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
    }

    public function index($id) {
        // Mendapatkan nomor antrian untuk hari ini
		$nomor_antrian_hari_ini = $this->Pasien_model->getById($id)->nomor_antrian;
		$data['current_user'] = $this->auth_model->current_user();

        // Tampilkan halaman nomor antrian
        $data['nomor_antrian_hari_ini'] = $nomor_antrian_hari_ini;
		$data['pasien'] = $this->Pasien_model->getById($id);
		$data['current_page'] = 'Pasien';
		$data['title'] = 'No Antrian';
        $this->load->view('backoffice/nomor_antrian/index', $data);
    }

	public function cetak($id) {
		$data['current_user'] = $this->auth_model->current_user();
		$data['nomor_antrian_hari_ini'] = $this->Pasien_model->getById($id)->nomor_antrian;
		$this->load->view('backoffice/nomor_antrian/cetak', $data);
	}
	public function cetak_kib($id) {
		$data['current_user'] = $this->auth_model->current_user();
		$data['data'] = $this->Pasien_model->getById($id);
		$this->load->view('backoffice/nomor_antrian/cetak_kib', $data);
	}

	public function daftar_pasien_lama($id) {
		$data['current_user'] = $this->auth_model->current_user();
		$data['title'] = 'Pendaftaran Pasien Lama';
		$data['current_page'] = 'List Pasien';

		$data['data'] = $this->Pasien_model->getById($id);
		$no_antrian = $this->Pasien_model->get_nomor_antrian();
		$data['no_antrian'] = $no_antrian;
		
		$this->load->view('backoffice/pasien/pendaftaran_pasien_lama', $data);
	}

	public function updateNo($id) {
		
		$data['current_user'] = $this->auth_model->current_user();
		// Menampilkan nomor urutan baru
		$update = $this->Pasien_model;
		$update->updateDataAntrian($id);
		$this->db->insert('pemeriksaan_pasien',[
			'pasien_id' => $id,
			'created_at' => date('Y-m-d H:i:s'),
		]);
		// Log 
		$nama = $this->Pasien_model->getById($id)->name;
		$status = 'Pasien : '.$nama.' Menunggu dilayanin dokter.';
		$this->Log_Model->insert([
			'pasien_id' => $id,
			'status' =>  $status,
			'created_at' => date('Y-m-d H:i:s'),
		]);
		$this->session->set_flashdata('message', 'Berhasil mendaftarkan.');
		redirect('nomor_antrian/index/' . $id);
	}
}
