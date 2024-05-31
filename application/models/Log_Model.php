<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Log_Model extends CI_Model
{

	protected $table = 'log';
	protected $_table_pasien = 'pasien';

	public function __construct()
	{
		parent::__construct();
	}

	public function getAll(){
        $this->db->from($this->table);
        $this->db->join($this->_table_pasien.' AS pasien', 'log.pasien_id = pasien.id');
		$this->db->select('pasien.name, pasien.nik, pasien.no_jkn, pasien.no_rm, pasien.tanggal_lahir,pasien.alamat, log.*');
        $this->db->order_by('log.created_at', 'desc');
		$this->db->limit(10); // Limit the query to return only the 10 most recent records
		$query = $this->db->get();
        $data = $query->result();

        return $data;
    }

	public function insert($data){
		$this->db->insert($this->table, $data);
	}
}
