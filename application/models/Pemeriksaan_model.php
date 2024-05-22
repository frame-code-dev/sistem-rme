<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan_model extends CI_Model
{

	private $_table = "pemeriksaan_pasien";
	// pasien_id	
	// keluhan_utama	
	// riwayat_penyakit_sekarang	
	// riwayat_penyakit_dahulu
	// riwayat_pengobatan
	// tekanan_darah
	// nadi
	// suhu	
	// rr	
	// tinggi_badan	
	// berat_badan
	// status_pemeriksaan
	// user_id	
	// created_at
	// updated_at
	public function rules(){
        return [
			[
				'field' => 'pasien_id',
				'label' => 'Pasien',
				'rules' => 'required'
				
			],
			[
				'field' => 'keluhan_utama',
				'label' => 'Keluhan Utama',
				'rules' => 'required'
				
			],
			[
				'field' => 'riwayat_penyakit_sekarang',
				'label' => 'Riwayat Penyakit Sekarang',
				'rules' => 'required'
				
			],
			[
				'field' => 'riwayat_penyakit_dahulu',
				'label' => 'Riwayat Penyakit Dahulu',
				'rules' => 'required'
				
			],
			[
				'field' => 'riwayat_pengobatan',
				'label' => 'Riwayat Pengobatan',
				'rules' => 'required'
				
			],
			[
				'field' => 'tekanan_darah',
				'label' => 'Tekanan Darah',
				'rules' => 'required'
				
			],
			[
				'field' => 'nadi',
				'label' => 'Nadi',
				'rules' => 'required'
				
			],
			[
				'field' => 'suhu',
				'label' => 'Suhu',
				'rules' => 'required'
				
			],
			[
				'field' => 'rr',
				'label' => 'RR',
				'rules' => 'required'
				
			],
			[
				'field' => 'tinggi_badan',
				'label' => 'Tinggi Badan',
				'rules' => 'required'
				
			],
			[
				'field' => 'berat_badan',
				'label' => 'Berat Badan',
				'rules' => 'required'
				
			]
        ];
    }

	public function getAll(){
		$this->db->from($this->_table);
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pemeriksaan_pasien.*');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'desc');
		$query = $this->db->get();

        return $query->result();
    }

	public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

	public function getByStatus($status=null, $filter=null) {
		$this->db->from($this->_table);
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_rm, pasien.jenis_pasien, pasien.tanggal_lahir, pasien.jenis_kelamin, pasien.alamat, pemeriksaan_pasien.*');

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

			// jenis kelamin where clause
			$jenis_kelamin = property_exists($filter, 'jenis_kelamin') ? strtolower($filter->jenis_kelamin) : null;
			if ($jenis_kelamin)
				$this->db->where("pasien.jenis_kelamin = '$jenis_kelamin'");
			
			// jenis pasien where clause
			$jenis_pasien = property_exists($filter, 'jenis_pasien') ? strtolower($filter->jenis_pasien) : null;
			if ($jenis_pasien)
				$this->db->where("pasien.jenis_pasien = '$jenis_pasien'");
		}
		$this->db->order_by('pemeriksaan_pasien.created_at', 'asc');
		$query = $this->db->get();

		return $query->result();
	}

	public function save() {
		$post = $this->input->post();
        $this->db->update($this->_table,[
			'pasien_id' => $post["pasien_id"],
			'keluhan_utama' => $post["keluhan_utama"],
			'riwayat_penyakit_sekarang' => $post["riwayat_penyakit_sekarang"],
			'riwayat_penyakit_dahulu' => $post["riwayat_penyakit_dahulu"],
			'riwayat_pengobatan' => $post["riwayat_pengobatan"],
			'tekanan_darah' => $post["tekanan_darah"],
			'nadi' => $post['nadi'],
			'suhu' => $post["suhu"],
			'rr' => $post["rr"],
			'tinggi_badan' => $post["tinggi_badan"],
			'berat_badan' => $post["berat_badan"],
			'status_pemeriksaan' => 'pending',
			'user_id' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d H:i:s'),
		], array('id' => $post["id"]));
		return $this->db->insert_id();
	}

	public function updateStatus($id, $status)
	{
		$this->db->update($this->_table, [
			'status_pemeriksaan' => $status,
			'updated_at' => date('Y-m-d H:i:s')
		], array('id' => $id));
	}
}
