<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_model extends CI_Model
{
	private $_table = "rekam_medis";
	private $_table_rekam_medis_diagnosa = 'rekam_medis_diagnosa';
	private $_table_rekam_medis_obat = 'rekam_medis_obat';
	private $_table_pemeriksaan = 'pemeriksaan_pasien';
   	public function getAll(){
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik,pasien.no_jkn,pasien.jenis_kelamin,pasien.alamat,pasien.tanggal_lahir, pasien.no_rm, pemeriksaan_pasien.*');
		$this->db->where('pemeriksaan_pasien.status_pemeriksaan','pending');
		$this->db->order_by('pemeriksaan_pasien.created_at', 'desc');
		$query = $this->db->get();

		return $query->result();
	}

	public function getById($id){
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_jkn, pasien.jenis_kelamin, pasien.alamat, pasien.tanggal_lahir, pasien.no_rm, pemeriksaan_pasien.*');
		$this->db->where('pemeriksaan_pasien.status_pemeriksaan', 'pending');
		$this->db->where('pemeriksaan_pasien.id', $id);
		$this->db->order_by('pemeriksaan_pasien.created_at', 'desc');
		$query = $this->db->get(); // Add get() to execute the query
		return $query->row(); // Fetch a single row
	}
	public function getByIdSukses($id){
		$this->db->from('pemeriksaan_pasien');
		$this->db->join('pasien', 'pasien.id = pemeriksaan_pasien.pasien_id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_jkn, pasien.jenis_kelamin, pasien.alamat, pasien.tanggal_lahir, pasien.no_rm, pemeriksaan_pasien.*');
		$this->db->where('pemeriksaan_pasien.id', $id);
		$this->db->order_by('pemeriksaan_pasien.created_at', 'desc');
		$query = $this->db->get(); // Add get() to execute the query
		return $query->row(); // Fetch a single row
	}

	public function save()
    {
        $post = $this->input->post();
		$current_time = date('Y-m-d H:i:s');
		// rekam_medis
        $this->db->insert($this->_table, [
			'pemeriksaan_id' => $post['pemeriksaan_id'],
			'diganosa_utama_code' => $post['diganosa_utama_code'],
			'diganosa_utama_name' => $post['diganosa_utama_name'],
			'catatan' => $post['catatan'],
			'kasus' => $post['kasus'],
			'kondisi_pulang' => $post['kondisi_pulang'],
			'created_at' => $current_time,
		]);
		$id = $this->db->insert_id();
		if ($this->input->post('code_diagnosis_other') != null) {
			for ($i=0; $i < count($this->input->post('code_diagnosis_other')) ; $i++) { 
				$this->db->insert($this->_table_rekam_medis_diagnosa,[
					'rekam_medis_id' => $id,
					'diagnosa_sekunder_code' => $this->input->post('code_diagnosis_other')[$i],
					'diagnosa_sekunder_name' => $this->input->post('description_diagnosis_other')[$i],	
					'created_at' => $current_time,
	
				]);
			};
		}
		for ($i=0; $i < count($post['obat']) ; $i++) { 
			$this->db->insert($this->_table_rekam_medis_obat,[
				'rekam_medis_id' => $id,
				'obat_id' => $post['obat'][$i],
				'frekuensi' => $post['frekuensi'][$i],	
				'qty' => $post['qty'][$i],
				'satuan' => $post['satuan'][$i],
				'created_at' => $current_time,
			]);
		};
    }

	public function is_diagnosis_exists($id) {
		$this->db->where('pemeriksaan_id', $id);
        $query = $this->db->get($this->_table);

        // Check if there is any row returned
        return $query->num_rows() > 0;
	}

	public function is_pemeriksaan_exists($id) {
		$this->db->where('id', $id);
		$this->db->where('pemeriksaan_pasien.keluhan_utama',null);
        $query = $this->db->get($this->_table_pemeriksaan);

        // Check if there is any row returned
        return $query->num_rows() > 0;
	}
}
