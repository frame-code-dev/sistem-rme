<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Pemeriksaan_model');
		$this->load->model('Laporan_model');
		$this->load->model('Apotek_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
    }

    public function kunjungan() : void
    {
        // init page
        $data['current_user'] = $this->auth_model->current_user();
        $data['title'] = 'Kunjungan';

        // form validation
        $this->form_validation->set_data($this->input->get());
        $this->form_validation->set_rules('dari', 'Dari', 'required');
        $this->form_validation->set_rules('sampai', 'Sampai', 'required');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
        $validation = $this->form_validation;

        if ($validation->run()) {
            // form variables
            $status = 'sukses';
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');
            $jenis_kelamin = $this->input->get('jenis_kelamin');
            $jenis_pasien = $this->input->get('jenis_pasien');

            // create obj for filter
            $filter = new stdClass;
            if ($dari && $sampai) {
                $filter->dari = $dari;
                $filter->sampai = $sampai;
            }
            if ($jenis_kelamin)
                $filter->jenis_kelamin = $jenis_kelamin;

            if ($jenis_pasien)
                $filter->jenis_pasien = $jenis_pasien;
            
            // retrieve data
            $list = $this->Pemeriksaan_model->getByStatus($status, $filter);
            $data['data'] = $list;

            $this->load->view('backoffice/laporan/kunjungan', $data);
        }
        else {
            $data['data'] = [];
            $this->load->view('backoffice/laporan/kunjungan', $data);
        }
    }

	public function pdf() {
        // init page
        $data['current_user'] = $this->auth_model->current_user();
		$data['title'] = "LAPORAN KUNJUNGAN PASIEN";

        // form validation
        $this->form_validation->set_data($this->input->get());
        $this->form_validation->set_rules('dari', 'Dari', 'required');
        $this->form_validation->set_rules('sampai', 'Sampai', 'required');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
        $validation = $this->form_validation;

        if ($validation->run()) {
            // form variables
            $status = 'sukses';
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');

            // create obj for filter
            $filter = new stdClass;
            if ($dari && $sampai) {
                $filter->dari = $dari;
                $filter->sampai = $sampai;
            }

            // retrieve data
            $result = $this->Laporan_model->getByStatus($status, $filter);
            $data['data'] = $result;

            $this->load->view('backoffice/laporan/kunjungan_pdf',$data);
        }
        else {
            $data['data'] = [];
            $this->load->view('backoffice/laporan/kunjungan', $data);
        }
	}
	public function excel() {
        // init page
        $data['current_user'] = $this->auth_model->current_user();
		$data['title'] = "LAPORAN KUNJUNGAN PASIEN";

        // form validation
        $this->form_validation->set_data($this->input->get());
        $this->form_validation->set_rules('dari', 'Dari', 'required');
        $this->form_validation->set_rules('sampai', 'Sampai', 'required');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
        $validation = $this->form_validation;

        if ($validation->run()) {
            // form variables
            $status = 'sukses';
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');

            // create obj for filter
            $filter = new stdClass;
            if ($dari && $sampai) {
                $filter->dari = $dari;
                $filter->sampai = $sampai;
            }

            // retrieve data
            $result = $this->Laporan_model->getByStatus($status, $filter);
            $data['data'] = $result;

            $this->load->view('backoffice/laporan/kunjungan_excel',$data);
        }
        else {
            $data['data'] = [];
            $this->load->view('backoffice/laporan/kunjungan', $data);
        }
	}

	public function laporanPenyakit() {
		$data['title'] = 'List Laporan 10 Besar Penyakit';
		$data['current_user'] = $this->auth_model->current_user();
		$this->form_validation->set_data($this->input->get());
        $this->form_validation->set_rules('dari', 'Dari', 'required');
        $this->form_validation->set_rules('sampai', 'Sampai', 'required');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
        $validation = $this->form_validation;

        if ($validation->run()) {
            // form variables
            $status = 'sukses';
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');

            // create obj for filter
            $filter = new stdClass;
            if ($dari && $sampai) {
                $filter->dari = $dari;
                $filter->sampai = $sampai;
            }
            // retrieve data
            $list = $this->Apotek_model->DiagnosaCount($filter);
            $data['data'] = $list;
            $this->load->view('backoffice/laporan/penyakit', $data);
        }
        else {
            $data['data'] = [];
            $this->load->view('backoffice/laporan/penyakit', $data);
        }
	}

	public function penyakitPDF() {
        // init page
        $data['current_user'] = $this->auth_model->current_user();
		$data['title'] = "LAPORAN 10 BESAR PENYAKIT";

        // form validation
        $this->form_validation->set_data($this->input->get());
        $this->form_validation->set_rules('dari', 'Dari', 'required');
        $this->form_validation->set_rules('sampai', 'Sampai', 'required');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
        $validation = $this->form_validation;

        if ($validation->run()) {
            // form variables
            $status = 'sukses';
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');

            // create obj for filter
            $filter = new stdClass;
            if ($dari && $sampai) {
                $filter->dari = $dari;
                $filter->sampai = $sampai;
            }

            // retrieve data
            $result = $this->Apotek_model->DiagnosaCount($filter);
            $data['data'] = $result;

            $this->load->view('backoffice/laporan/penyakit_pdf',$data);
        }
        else {
            $data['data'] = [];
            $this->load->view('backoffice/laporan/penyakit', $data);
        }
	}

	public function penyakitExcel() {
        // init page
        $data['current_user'] = $this->auth_model->current_user();
		$data['title'] = "LAPORAN 10 BESAR PENYAKIT";

        // form validation
        $this->form_validation->set_data($this->input->get());
        $this->form_validation->set_rules('dari', 'Dari', 'required');
        $this->form_validation->set_rules('sampai', 'Sampai', 'required');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
        $validation = $this->form_validation;

        if ($validation->run()) {
            // form variables
            $status = 'sukses';
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');

            // create obj for filter
            $filter = new stdClass;
            if ($dari && $sampai) {
                $filter->dari = $dari;
                $filter->sampai = $sampai;
            }

            // retrieve data
            $result = $this->Apotek_model->DiagnosaCount($filter);
            $data['data'] = $result;

            $this->load->view('backoffice/laporan/penyakit_excel',$data);
        }
        else {
            $data['data'] = [];
            $this->load->view('backoffice/laporan/penyakit', $data);
        }
	}

	public function laporanObat()
	{
		// init page
		$data['current_user'] = $this->auth_model->current_user();
		$data['title'] = 'Laporan Obat';

		// form validation
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('dari', 'Dari', 'required');
		$this->form_validation->set_rules('sampai', 'Sampai', 'required');
		$this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
		$validation = $this->form_validation;

		if ($validation->run()) {
            // form variables
            $status = 'sukses';
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');

            // create obj for filter
            $filter = new stdClass;
            if ($dari && $sampai) {
                $filter->dari = $dari;
                $filter->sampai = $sampai;
            }
            // retrieve data
            $list = $this->Laporan_model->stokObat($filter);
            $data['data'] = $list;
            $this->load->view('backoffice/laporan/obat', $data);
        }
        else {
            $data['data'] = [];
            $this->load->view('backoffice/laporan/obat', $data);
        }
	}
	public function laporanObatPDF() {
		 // init page
		 $data['current_user'] = $this->auth_model->current_user();
		 $data['title'] = "LAPORAN 10 BESAR PENYAKIT";
 
		 // form validation
		 $this->form_validation->set_data($this->input->get());
		 $this->form_validation->set_rules('dari', 'Dari', 'required');
		 $this->form_validation->set_rules('sampai', 'Sampai', 'required');
		 $this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
		 $validation = $this->form_validation;
 
		 if ($validation->run()) {
			 // form variables
			 $status = 'sukses';
			 $dari = $this->input->get('dari');
			 $sampai = $this->input->get('sampai');
 
			 // create obj for filter
			 $filter = new stdClass;
			 if ($dari && $sampai) {
				 $filter->dari = $dari;
				 $filter->sampai = $sampai;
			 }
 
			 // retrieve data
			 $result = $this->Laporan_model->stokObat($filter);
			 $data['data'] = $result;
 
			 $this->load->view('backoffice/laporan/obat_pdf',$data);
		 }
		 else {
			 $data['data'] = [];
			 $this->load->view('backoffice/laporan/obat', $data);
		 }
	}
	public function laporanObatExcel() {
		// init page
		$data['current_user'] = $this->auth_model->current_user();
		$data['title'] = "LAPORAN 10 BESAR PENYAKIT";

		// form validation
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('dari', 'Dari', 'required');
		$this->form_validation->set_rules('sampai', 'Sampai', 'required');
		$this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
		$validation = $this->form_validation;

		if ($validation->run()) {
			// form variables
			$status = 'sukses';
			$dari = $this->input->get('dari');
			$sampai = $this->input->get('sampai');

			// create obj for filter
			$filter = new stdClass;
			if ($dari && $sampai) {
				$filter->dari = $dari;
				$filter->sampai = $sampai;
			}

			// retrieve data
			$result = $this->Laporan_model->stokObat($filter);
			$data['data'] = $result;

			$this->load->view('backoffice/laporan/obat_excel',$data);
		}
		else {
			$data['data'] = [];
			$this->load->view('backoffice/laporan/obat', $data);
		}
   }

   public function laporanKesakitan()
	{
		// init page
		$data['current_user'] = $this->auth_model->current_user();
		$data['title'] = 'Laporan Kesakitan';

		// form validation
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('dari', 'Dari', 'required');
		$this->form_validation->set_rules('sampai', 'Sampai', 'required');
		$this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
		$validation = $this->form_validation;

		if ($validation->run()) {
			$status = 'sukses';
            $dari = $this->input->get('dari');
            $sampai = $this->input->get('sampai');
            $jenis_kelamin = $this->input->get('jenis_kelamin');
            $jenis_pasien = $this->input->get('jenis_pasien');

            // create obj for filter
            $filter = new stdClass;
            if ($dari && $sampai) {
                $filter->dari = $dari;
                $filter->sampai = $sampai;
            }
            if ($jenis_kelamin)
                $filter->jenis_kelamin = $jenis_kelamin;

            if ($jenis_pasien)
                $filter->jenis_pasien = $jenis_pasien;
            
            // retrieve data
            $list = $this->Laporan_model->getByStatusKesakitan($status, $filter);
            $data['data'] = $list;
        
            $this->load->view('backoffice/laporan/kesakitan', $data);
        }
        else {
            $data['data'] = [];
            $this->load->view('backoffice/laporan/kesakitan', $data);
        }
	}
	public function laporanKesakitanPDF() {
		 // init page
		 $data['current_user'] = $this->auth_model->current_user();
		 $data['title'] = "LAPORAN KESAKITAN";
 
		 // form validation
		 $this->form_validation->set_data($this->input->get());
		 $this->form_validation->set_rules('dari', 'Dari', 'required');
		 $this->form_validation->set_rules('sampai', 'Sampai', 'required');
		 $this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
		 $validation = $this->form_validation;
 
		 if ($validation->run()) {
			 // form variables
			 $status = 'sukses';
			 $dari = $this->input->get('dari');
			 $sampai = $this->input->get('sampai');
 
			 // create obj for filter
			 $filter = new stdClass;
			 if ($dari && $sampai) {
				 $filter->dari = $dari;
				 $filter->sampai = $sampai;
			 }
 
			 // retrieve data
			 $list = $this->Laporan_model->getByStatusKesakitan($status, $filter);
			 $data['data'] = $list;
        
			 $this->load->view('backoffice/laporan/kesakitan_pdf',$data);
		 }
		 else {
			 $data['data'] = [];
			 $this->load->view('backoffice/laporan/kesakitan', $data);
		 }
	}
	public function laporanKesakitanExcel() {
		// init page
		$data['current_user'] = $this->auth_model->current_user();
		$data['title'] = "LAPORAN KESAKITAN";

		// form validation
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('dari', 'Dari', 'required');
		$this->form_validation->set_rules('sampai', 'Sampai', 'required');
		$this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
		$validation = $this->form_validation;

		if ($validation->run()) {
			// form variables
			$status = 'sukses';
			$dari = $this->input->get('dari');
			$sampai = $this->input->get('sampai');

			// create obj for filter
			$filter = new stdClass;
			if ($dari && $sampai) {
				$filter->dari = $dari;
				$filter->sampai = $sampai;
			}

			// retrieve data
			$list = $this->Laporan_model->getByStatusKesakitan($status, $filter);
			$data['data'] = $list;

			$this->load->view('backoffice/laporan/kesakitan_excel',$data);
		}
		else {
			$data['data'] = [];
			$this->load->view('backoffice/laporan/kesakitan', $data);
		}
   }


}
