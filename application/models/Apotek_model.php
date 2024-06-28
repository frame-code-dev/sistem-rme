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
		$this->db->select('pasien.name, pasien.nik, pasien.no_jkn, pasien.no_rm, pemeriksaan.id AS pemeriksaan_id, pemeriksaan.status_pemeriksaan, rekam_medis.id, rekam_medis.kondisi_pulang, rekam_medis.diganosa_utama_code AS diagnosa_code, rekam_medis.diganosa_utama_name AS diagnosa_name');
        $this->db->order_by('pemeriksaan.status_pemeriksaan', 'pending, sukses, batal');
        $this->db->order_by('rekam_medis.created_at', 'desc');
        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }

	public function historyPemeriksaan($id) {
		$this->db->from($this->_table_pemeriksaan);
        $this->db->order_by('pemeriksaan_pasien.status_pemeriksaan', 'sukses');
		$this->db->where('pemeriksaan_pasien.pasien_id',$id);
        $query = $this->db->get();
        $data = $query->result();

		return $data;
	}
	public function historyRekamMedis($id){
		return $this->db->get_where($this->_table_rm, ["pemeriksaan_id" => $id])->row();
	}
	public function getDiagnosaById($id)
    {
        $this->db->from($this->_table_rm);
        $this->db->join($this->_table_pemeriksaan.' AS pemeriksaan', 'pemeriksaan.id = rekam_medis.pemeriksaan_id');
        $this->db->join($this->_table_pasien.' AS pasien', 'pemeriksaan.pasien_id = pasien.id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_jkn, pasien.no_rm, pemeriksaan.id AS pemeriksaan_id, pemeriksaan.status_pemeriksaan, rekam_medis.id, rekam_medis.kondisi_pulang, rekam_medis.diganosa_utama_code AS diagnosa_code, rekam_medis.diganosa_utama_name AS diagnosa_name');
        $this->db->order_by('pemeriksaan.status_pemeriksaan', 'pending, sukses, batal');
        $this->db->order_by('rekam_medis.created_at', 'desc');
		$this->db->where('pemeriksaan.pasien_id',$id);
        $query = $this->db->get();
        $data = $query->result();

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
        $this->db->select('obat.id, obat.name, rekam_medis_obat.qty, rekam_medis_obat.frekuensi, rekam_medis_obat.satuan');
        $this->db->where('rekam_medis_obat.rekam_medis_id', $rekam_id);

        $query = $this->db->get();
        return $query->result();
    }
    
    public function getByRMId($id)
    {
        $this->db->from($this->_table_rm);
        $this->db->join($this->_table_pemeriksaan.' AS pemeriksaan', 'pemeriksaan.id = rekam_medis.pemeriksaan_id');
        $this->db->join($this->_table_pasien.' AS pasien', 'pemeriksaan.pasien_id = pasien.id');
		$this->db->select('
            pasien.id as id_pasien,
            pasien.name,
            pasien.nik,
            pasien.no_jkn,
            pasien.no_rm,
            pasien.jenis_kelamin,
            pasien.jenis_pasien,
            pasien.tanggal_lahir,
            pemeriksaan.id AS pemeriksaan_id,
            rekam_medis.id,
			rekam_medis.kondisi_pulang,
            rekam_medis.diganosa_utama_code AS diagnosa_code,
            rekam_medis.diganosa_utama_name AS diagnosa_name,
        ');
        $this->db->where('rekam_medis.id', $id);
        $this->db->order_by('rekam_medis.created_at', 'desc');
        $query = $this->db->get();
        $data = $query->row();

        return $data;
    }

	public function DiagnosaCount($filter)
    {
        $this->db->from($this->_table_rm);
		$this->db->select('rekam_medis.*,');
		$this->db->select('COUNT(rekam_medis.diganosa_utama_code) AS jumlah');
        if ($filter) {
			// date range where clause
			$dari = property_exists($filter, 'dari') ? date('Y-m-d', strtotime($filter->dari)) : null;
			$sampai = property_exists($filter, 'sampai') ? date('Y-m-d', strtotime($filter->sampai)) : null;
			if ($dari && $sampai)
				$this->db->where("(date(rekam_medis.created_at) BETWEEN '$dari' AND '$sampai')");

		}
		$this->db->group_by('rekam_medis.diganosa_utama_code');
		$this->db->order_by('jumlah', 'desc');
        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }
	public function DiagnosaList()
    {
        $this->db->from($this->_table_rm);
		$this->db->select('rekam_medis.*,');
		$this->db->select('COUNT(rekam_medis.diganosa_utama_code) AS jumlah');
		$this->db->group_by('rekam_medis.diganosa_utama_code');
		$this->db->order_by('jumlah', 'desc');
        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }
}
