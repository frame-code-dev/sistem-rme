<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
	private $_table_rm = "rekam_medis";
	private $_table_rekam_medis_obat = 'rekam_medis_obat';
	private $_table_obat = "obat";
	private $_table_pemeriksaan = 'pemeriksaan_pasien';

	public function getByStatus($status=null, $filter=null) {
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		// status where clause
		if ($status) {
			$status = strtolower($status);
			$this->db->where("pemeriksaan_pasien.status_pemeriksaan = '$status'");
		}

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();

        // Total Kunjungan
        $total_kunjungan = count($data);
        
        // Total umum
        $total_umum_l = 0;
        $total_umum_p = 0;
        
        // Total bpjs
        $total_bpjs_l = 0;
        $total_bpjs_p = 0;
        
        // Total pasien baru
        $total_pasien_baru_l = 0;
        $total_pasien_baru_p = 0;

        // Total pasien lama
        $total_pasien_lama_l = 0;
        $total_pasien_lama_p = 0;

        foreach ($data as $value) {
            if ($value->jenis_kelamin == 'l' && $value->jenis_pasien == 'umum')
                $total_umum_l++;
            if ($value->jenis_kelamin == 'l' && $value->jenis_pasien == 'bpjs')
                $total_bpjs_l++;
            if ($value->jenis_kelamin == 'p' && $value->jenis_pasien == 'umum')
                $total_umum_p++;
            if ($value->jenis_kelamin == 'p' && $value->jenis_pasien == 'bpjs')
                $total_bpjs_p++;
            if ($value->jenis_kelamin == 'l' && date('d-m-Y', strtotime($value->tgl_daftar)) == date('d-m-Y'))
                $total_pasien_baru_l++;
            if ($value->jenis_kelamin == 'p' && date('d-m-Y', strtotime($value->tgl_daftar)) == date('d-m-Y'))
                $total_pasien_baru_p++;
            if ($value->jenis_kelamin == 'l' && date('d-m-Y', strtotime($value->tgl_daftar)) < date('d-m-Y'))
                $total_pasien_lama_l++;
            if ($value->jenis_kelamin == 'p' && date('d-m-Y', strtotime($value->tgl_daftar)) < date('d-m-Y'))
                $total_pasien_lama_p++;
        }

        $result = new stdClass;
        $result->list = $data;
        $result->total_kunjungan = $total_kunjungan;
        $result->total_umum_l = $total_umum_l;
        $result->total_umum_p = $total_umum_p;
        $result->total_bpjs_l = $total_bpjs_l;
        $result->total_bpjs_p = $total_bpjs_p;
        $result->total_pasien_baru_l = $total_pasien_baru_l;
        $result->total_pasien_baru_p = $total_pasien_baru_p;
        $result->total_pasien_lama_l = $total_pasien_lama_l;
        $result->total_pasien_lama_p = $total_pasien_lama_p;

		return $result;
	}

	public function getByStatusKesakitan($status=null, $filter=null) {
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, 
			pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, 
			pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*, DATE_FORMAT(pemeriksaan_pasien.created_at, "%Y-%m-%d") AS created_at_ymd'
			);	
	
		// status where clause
		if ($status) {
			$status = strtolower($status);
			$this->db->where("pemeriksaan_pasien.status_pemeriksaan = '$status'");
		}

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
            $sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
            if ($dari && $sampai) {
				$this->db->where('DATE(pemeriksaan_pasien.created_at) BETWEEN "'. date('Y-m-d', strtotime($dari)). '" and "'. date('Y-m-d', strtotime($sampai)).'"');
            }
		}
		$this->db->group_by(array('created_at_ymd'));
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();

		return $data;
	}
	public function pasienKunjunganBaruL($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		// status where clause
		if ($status) {
			$status = strtolower($status);
			$this->db->where("pemeriksaan_pasien.status_pemeriksaan = '$status'");
		}

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'l' && date('d-m-Y', strtotime($value->tgl_daftar)) == date('d-m-Y')){
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		} else {
			return 0;
		}
		
		
	}
	public function pasienKunjunganBaruP($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		$jumlah_kunjungan_baru_p = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		// status where clause
		if ($status) {
			$status = strtolower($status);
			$this->db->where("pemeriksaan_pasien.status_pemeriksaan = '$status'");
		}

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'p' && date('d-m-Y', strtotime($value->tgl_daftar)) == date('d-m-Y')){
					$jumlah_kunjungan_baru_p++;
	
				}
			}
			return $jumlah_kunjungan_baru_p;
		}else{
			return 0;
		}
	}
	public function pasienKunjunganLamaL($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		// status where clause
		if ($status) {
			$status = strtolower($status);
			$this->db->where("pemeriksaan_pasien.status_pemeriksaan = '$status'");
		}

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'l' && date('d-m-Y', strtotime($value->tgl_daftar)) < date('d-m-Y')){
	
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		}else{
			return 0;
		}
		
	}
	public function pasienKunjunganLamaP($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		$jumlah_kunjungan_baru_p = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		// status where clause
		if ($status) {
			$status = strtolower($status);
			$this->db->where("pemeriksaan_pasien.status_pemeriksaan = '$status'");
		}

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($jenis_kelamin == 'p' && date('d-m-Y', strtotime($tgl_daftar)) < date('d-m-Y')){
					$jumlah_kunjungan_baru_p++;
				}
			}
			return $jumlah_kunjungan_baru_p;
		}else{
			return $jumlah_kunjungan_baru_p;

		}
	}
	public function pasienKunjunganBaruUsiaL($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik,pasien.umur, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		
		$this->db->where('pasien.umur >=', 60);
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'l' && date('d-m-Y', strtotime($value->tgl_daftar)) == date('d-m-Y')){
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		} else {
			return $jumlah_kunjungan_baru_l;
		}
		
		
	}
	public function pasienKunjunganBaruUsiaP($filter,$status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		$jumlah_kunjungan_baru_p = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik,pasien.umur, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('pasien.umur >=', 60);
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($jenis_kelamin == 'p' && date('d-m-Y', strtotime($tgl_daftar)) == date('d-m-Y'))
					$jumlah_kunjungan_baru_p++;
			}
			return $jumlah_kunjungan_baru_p;
		}else{
			return $jumlah_kunjungan_baru_p;
		}
		
	}

	public function pasienKunjunganLamaUsiaL($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('pasien.umur >=', 60);
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'l' && date('d-m-Y', strtotime($value->tgl_daftar)) < date('d-m-Y')){
	
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		}else{
			return 0;
		}
		
	}
	public function pasienKunjunganLamaUsiaP($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		$jumlah_kunjungan_baru_p = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('pasien.umur >=', 60);
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($jenis_kelamin == 'p' && date('d-m-Y', strtotime($tgl_daftar)) < date('d-m-Y')){
					$jumlah_kunjungan_baru_p++;
				}
			}
			return $jumlah_kunjungan_baru_p;
		}else{
			return $jumlah_kunjungan_baru_p;

		}
	}
	public function pasienUmumL($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('pasien.jenis_pasien =', 'umum');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'l'){
	
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		}else{
			return 0;
		}
		
	}
	public function pasienUmumP($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('pasien.jenis_pasien =', 'umum');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'p'){
	
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		}else{
			return 0;
		}
		
	}
	public function pasienBpjsL($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		$jumlah_kunjungan_baru_p = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('pasien.jenis_pasien =', 'bpjs');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'l'){
					$jumlah_kunjungan_baru_p++;
				}
			}
			return $jumlah_kunjungan_baru_p;
		}else{
			return $jumlah_kunjungan_baru_p;

		}
	}
	public function pasienBpjsP($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		$jumlah_kunjungan_baru_p = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('pasien.jenis_pasien =', 'bpjs');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'p'){
					$jumlah_kunjungan_baru_p++;
				}
			}
			return $jumlah_kunjungan_baru_p;
		}else{
			return $jumlah_kunjungan_baru_p;

		}
	}
	public function pasienKasusBaruL($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->join('rekam_medis', 'rekam_medis.pemeriksaan_id = pemeriksaan_pasien.id');
		$this->db->select('rekam_medis.kasus, pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('rekam_medis.kasus =', 'Kasus Baru');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'l'){
	
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		}else{
			return 0;
		}
		
	}
	public function pasienKasusBaruP($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->join('rekam_medis', 'rekam_medis.pemeriksaan_id = pemeriksaan_pasien.id');
		$this->db->select('rekam_medis.kasus, pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('rekam_medis.kasus =', 'Kasus Baru');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'p'){
	
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		}else{
			return 0;
		}
		
	}
	public function pasienKasusLamaL($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->join('rekam_medis', 'rekam_medis.pemeriksaan_id = pemeriksaan_pasien.id');
		$this->db->select('rekam_medis.kasus, pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('rekam_medis.kasus =', 'Kasus Lama');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'l'){
	
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		}else{
			return 0;
		}
		
	}
	public function pasienKasusLamaP($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->join('rekam_medis', 'rekam_medis.pemeriksaan_id = pemeriksaan_pasien.id');
		$this->db->select('rekam_medis.kasus, pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->where('rekam_medis.kasus =', 'Kasus Lama');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'p'){
	
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		}else{
			return 0;
		}
		
	}

	public function pasienKunjunganKasusL($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		// Total pasien baru
		$jumlah_kunjungan_baru_l = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->join('rekam_medis', 'rekam_medis.pemeriksaan_id = pemeriksaan_pasien.id');
		$this->db->select('rekam_medis.kasus, pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		// status where clause
		if ($status) {
			$status = strtolower($status);
			$this->db->where("pemeriksaan_pasien.status_pemeriksaan = '$status'");
		}

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'l'){
					$jumlah_kunjungan_baru_l++;
				}
			}
			return $jumlah_kunjungan_baru_l;
		} else {
			return 0;
		}
		
		
	}
	public function pasienKunjunganKasusP($filter, $status = null, $jenis_kelamin = null, $tgl_daftar = null) {
		$jumlah_kunjungan_baru_p = 0;
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->join('rekam_medis', 'rekam_medis.pemeriksaan_id = pemeriksaan_pasien.id');
		$this->db->select('rekam_medis.kasus, pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pasien.created_at AS tgl_daftar, pemeriksaan_pasien.*');

		// status where clause
		if ($status) {
			$status = strtolower($status);
			$this->db->where("pemeriksaan_pasien.status_pemeriksaan = '$status'");
		}

		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();
        $data = $query->result();
		if ($data) {
			foreach ($data as $value) {
				if ($value->jenis_kelamin == 'p'){
					$jumlah_kunjungan_baru_p++;
	
				}
			}
			return $jumlah_kunjungan_baru_p;
		}else{
			return 0;
		}
	}
	public function stokObat($filter=null){
		$this->db->from($this->_table_rm);
        $this->db->join($this->_table_pemeriksaan,'pemeriksaan_pasien.id = rekam_medis.pemeriksaan_id');
        $this->db->join($this->_table_rekam_medis_obat, 'rekam_medis_obat.rekam_medis_id = rekam_medis.id');
		$this->db->join($this->_table_obat, 'obat.id = rekam_medis_obat.obat_id');
		$this->db->select('obat.id as id_obat, obat.name,obat.satuan,obat.penerimaan_stok, obat.stok, rekam_medis_obat.qty, rekam_medis_obat.frekuensi');
		$this->db->select('SUM(rekam_medis_obat.qty) as total');  // Menghitung sisa stok
		$this->db->select('(obat.stok - SUM(rekam_medis_obat.qty)) AS sisa_stok');  // Menghitung sisa stok
		$this->db->where('pemeriksaan_pasien.status_pemeriksaan','sukses');
		$this->db->group_by('obat.id');  // Mengelompokkan berdasarkan ID obat
		if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(pemeriksaan_pasien.created_at) BETWEEN '$dari' AND '$sampai')");
		}
		$query = $this->db->get();
		$data = $query->result();
		return $data;

	}
}
