<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Apotek_model extends CI_Model
{
	private $_table_rm = "rekam_medis";
	private $_table_rm_diagnosa = "rekam_medis_diagnosa";
	private $_table_rm_obat = "rekam_medis_obat";
	private $_table_obat = "obat";
	private $_table_pasien = "pasien";
	private $_table_pemeriksaan = "pemeriksaan_pasien";


    public function getAll()
    {
        $this->db->from($this->_table_rm);
        $this->db->join($this->_table_pemeriksaan.' AS pemeriksaan', 'pemeriksaan.id = rekam_medis.pemeriksaan_id');
        $this->db->join($this->_table_pasien.' AS pasien', 'pemeriksaan.pasien_id = pasien.id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_jkn, pasien.no_rm, pemeriksaan.id AS pemeriksaan_id, rekam_medis.id, rekam_medis.diganosa_utama_code AS diagnosa_code, rekam_medis.diganosa_utama_name AS diagnosa_name');
        $this->db->order_by('rekam_medis.created_at', 'desc');
        $query = $this->db->get();
        $data = $query->result();

        // if ($data) {
        //     foreach ($data as $value) {
        //         $rm_diagnosa = $this->getRekamDiagnosaByRekamId($value->id);
        //         $rm_obat = $this->getRekamObatByRekamId($value->id);
        //         $value->rm_diagnosa = $rm_diagnosa;
        //         $value->rm_obat = $rm_obat;
        //     }
        // }

        return $data;
    }

    public function getRekamDiagnosaByRekamId($rekam_id)
    {
        $this->db->from($this->_table_rm_diagnosa);
        $this->db->select('id, diagnosa_sekunder_code AS code, diagnosa_sekunder_name AS name');
        $this->db->where('rekam_medis_id', $rekam_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getRekamObatByRekamId($rekam_id)
    {
        $this->db->from($this->_table_rm_obat);
        $this->db->join($this->_table_obat, 'obat.id = rekam_medis_obat.obat_id');
        $this->db->select('obat.name, rekam_medis_obat.qty, rekam_medis_obat.frekuensi');
        $this->db->where('rekam_medis_obat.rekam_medis_id', $rekam_id);

        $query = $this->db->get();
        return $query->result();
    }
    
}