<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nomor_antrian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pasien_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
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
}