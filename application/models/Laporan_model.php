<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
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
}
