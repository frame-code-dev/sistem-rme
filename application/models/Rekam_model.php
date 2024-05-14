<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_model extends CI_Model
{
   private $_table = "rekam_medis";

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
}
