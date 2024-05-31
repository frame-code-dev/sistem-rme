<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apotek extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Apotek_model');
		$this->load->model('Pasien_model');
		$this->load->model('Log_Model');
		$this->load->model('Rekam_model');
		$this->load->model('Obat_model');
		$this->load->model('Pemeriksaan_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index() : void
	{
		$data['current_user'] = $this->auth_model->current_user();
		$apotek = $this->Apotek_model->getAll();
		
		$data['data'] = $apotek;
		$data['title'] = 'List Antrean Obat Pasien';

		$this->load->view('backoffice/apotek/index', $data);
	}


	public function detail($rm_id) : void
	{
		$status = 'failed';
		$message = null;
		$data = null;

		if ($rm_id) {
			$status = 'success';
			$message = 'Berhasil mengambil data';
			$diagnosa = $this->Apotek_model->getRekamDiagnosaByRekamId($rm_id);
			$obat = $this->Apotek_model->getRekamObatByRekamId($rm_id);
			$rekam = $this->Rekam_model->getById($rm_id);
			$data = new stdClass;
			$data->diagnosa = $diagnosa;
			$data->obat = $obat;
			$data->rekam = $rekam;
		}
		

		$response = new stdClass;
		$response->status = $status;
		$response->message = $message;
		$response->data = $data;

		echo json_encode($response);
	}

	public function create($rm_id)
	{
		$data['current_user'] = $this->auth_model->current_user();
		$data['current_page'] = 'List Antrean Obat Pasien';
		$data['title'] = 'Resep Obat';
		
		$rm_data = $this->Apotek_model->getByRMId($rm_id);
		$obat = $this->Apotek_model->getRekamObatByRekamId($rm_id);
		$data['rm'] = $rm_data;
		$data['obat'] = $obat;
		$this->load->view('backoffice/apotek/create', $data);
	}

	public function store()
	{
		// init page
        $data['current_user'] = $this->auth_model->current_user();
        $data['title'] = 'Resep Obat';

        // form validation
        $this->form_validation->set_data($this->input->post());
        $this->form_validation->set_rules('obat_id[]', 'Obat', 'required');
        $this->form_validation->set_rules('qty[]', 'Qty', 'required');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
        $validation = $this->form_validation;

		if ($validation->run()) {
			$form = $this->input->post();
			$rm_id = $form['rm_id'];
			$pemeriksaan_id = $form['pemeriksaan_id'];
			$obat_id = $form['obat_id'];
			$obat_qty = $form['qty'];

			$this->db->trans_start();
			// Update stock
			for ($i=0; $i < count($obat_id); $i++) { 
				$id = $obat_id[$i];
				$qty = $obat_qty[$i];

				$this->Obat_model->subtractStock($id, $qty);
			}

			// Update status pemeriksaan
			$this->Pemeriksaan_model->updateStatus($pemeriksaan_id, 'sukses');
			$this->db->trans_complete();

			// LOG 
			$nama = $this->Pasien_model->getById($form['pasien_id'])->name;
			$status = 'Pasien : '.$nama.' Selesai Dilayani.';
			$this->Log_Model->insert([
				'pasien_id' => $form['pasien_id'],
				'status' =>  $status,
				'created_at' => date('Y-m-d H:i:s'),
			]);
            $this->session->set_flashdata('message', 'Berhasil menyelesaikan antrean');
			redirect('apotek/index');
		}
		else {
            $this->session->set_flashdata('error', 'Harap cantumkan obat yang digunakan');
			redirect('apotek/index');
		}
	}
}
