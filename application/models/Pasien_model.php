<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_model extends CI_Model
{

	private $_table = "pasien";
	// name	
	// no_rm	
	// nik	
	// no_kk	
	// jenis_pasien	
	// no_jkn	
	// tanggal_lahir	
	// jenis_kelamin	
	// agama	
	// no_hp	
	// no_telp	
	// alamat	
	// pendidikan	
	// pekerjaan	
	// status_pernikahan	
	// user_id	
	// created_at	
	// updated_at	
	public function rules(){
        return [
			[
				'field' => 'nama_pasien',
				'label' => 'Nama Pasien',
				'rules' => 'required'
				
			],
			[
				'field' => 'no_rm',
				'label' => 'No. Rekam Medis',
				'rules' => 'required'
				
			],
			[
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'required'
				
			],
			[
				'field' => 'no_kk',
				'label' => 'No. KK',
				'rules' => 'required'
				
			],
			[
				'field' => 'jenis_pasien',
				'label' => 'Jenis Pasien',
				'rules' => 'required'
				
			],
			[
				'field' => 'tgl_lahir',
				'label' => 'Tanggal Lahir',
				'rules' => 'required'
				
			],
			[
				'field' => 'jenis_kelamin',
				'label' => 'Jenis Kelamin',
				'rules' => 'required'
				
			],
			[
				'field' => 'agama',
				'label' => 'Agama',
				'rules' => 'required'
				
			],
			[
				'field' => 'no_hp',
				'label' => 'No. HP',
				'rules' => 'required'
				
			],
			[
				'field' => 'no_telp',
				'label' => 'No. Telp',
				'rules' => 'required'
				
			],
			[
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'required'
				
			],
			[
				'field' => 'pendidikan',
				'label' => 'Pendidikan',
				'rules' => 'required'
				
			],
			[
				'field' => 'pekerjaan',
				'label' => 'Pekerjaan',
				'rules' => 'required'
				
			],
			[
				'field' => 'status_kawin',
				'label' => 'Status Pernikahan',
				'rules' => 'required'
				
			],
        ];
    }

	public function getAll(){
        return $this->db->get($this->_table)->result();
    }

	public function getAntrean(){
		$this->db->from($this->_table);
		$this->db->where('id NOT IN (SELECT pasien_id FROM pemeriksaan_pasien)');
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get();
		
		return $query->result();
    }

	public function getTotalAntrean() : int
	{
		$query = $this->db->query("SELECT * FROM $this->_table WHERE id NOT IN (SELECT pasien_id FROM pemeriksaan_pasien)");
		return (int) $query->num_rows();
	}

	public function getTotalPasienDiperiksa() : int
	{
		$query = $this->db->query("SELECT * FROM $this->_table WHERE id IN (SELECT pasien_id FROM pemeriksaan_pasien)");
		return (int) $query->num_rows();
	}

	public function getTotalPasienToday() : int
	{
		$today = date('Y-m-d');
		$query = $this->db->query("SELECT * FROM $this->_table WHERE date(created_at) = '$today'");
		return (int) $query->num_rows();
	}

	public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

	public function save() {
		$post = $this->input->post();
        $this->db->insert($this->_table,[
			'name' => $post["nama_pasien"],
			'no_rm' => $post["no_rm"],
			'nik' => $post["nik"],
			'no_kk' => $post["no_kk"],
			'jenis_pasien' => $post["jenis_pasien"],
			'no_jkn' => $post["no_kartu_jkn"],
			'tanggal_lahir' => date('Y-m-d', strtotime($post["tgl_lahir"])),
			'jenis_kelamin' => $post["jenis_kelamin"],
			'agama' => $post["agama"],
			'no_hp' => $post["no_hp"],
			'no_telp' => $post["no_telp"],
			'alamat' => $post["alamat"],
			'pendidikan' => $post["pendidikan"],
			'pekerjaan' => $post["pekerjaan"],
			'status_pernikahan' => $post["status_kawin"],
			'nomor_antrian' => $post['nomor_antrian'],
			'user_id' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d H:i:s'),
		]);
		return $this->db->insert_id();
	}

	public function get_nomor_antrian() {

        // Mendapatkan tanggal awal hari ini (pukul 00:00:00)
        $start_of_today = strtotime('today', time());

        // Mendapatkan tanggal akhir hari ini (pukul 23:59:59)
        $end_of_today = strtotime('tomorrow', $start_of_today) - 1;

        // Mengambil nomor antrian untuk hari ini
        $this->db->select('nomor_antrian');
        $this->db->where('created_at >=', date('Y-m-d H:i:s', $start_of_today));
        $this->db->where('created_at <=', date('Y-m-d H:i:s', $end_of_today));
        $this->db->order_by('nomor_antrian', 'DESC');
        $query = $this->db->get('pasien');

        if ($query->num_rows() > 0) {
            // Jika sudah ada data untuk hari ini, ambil nomor antrian terakhir dan tambahkan 1
            $last_nomor_antrian = $query->row()->nomor_antrian;
            return $last_nomor_antrian + 1;
        } else {
            // Jika belum ada data untuk hari ini, nomor antrian dimulai dari 1
            return 1;
        }
    }

	public function get_sequence() {
       // Mendapatkan nomor urutan terakhir dari database
		$last_sequence = $this->db->select_max('no_rm')->get($this->_table)->row()->no_rm;

		if ($last_sequence) {
			// Jika ada nomor urutan terakhir, tingkatkan nomor urutan
			return str_pad(intval($last_sequence) + 1, 6, '0', STR_PAD_LEFT);
		} else {
			// Jika tabel kosong, mulai dari 000001
			return '000001';
		}
    }

	public function generate_sequence($count) {
		// Mendapatkan nomor urutan terakhir dari database
		$last_sequence = $this->db->select_max('no_rm')->get($this->_table)->row()->no_rm;
	
		if ($last_sequence) {
			// Jika ada nomor urutan terakhir, tingkatkan nomor urutan
			$new_sequence = str_pad(intval($last_sequence) + $count, 6, '0', STR_PAD_LEFT);
		} else {
			// Jika tabel kosong, mulai dari 000001
			$new_sequence = str_pad($count, 6, '0', STR_PAD_LEFT);
		}
	
		return $new_sequence;
	}
}
