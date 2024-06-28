<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Obat_model extends CI_Model
{
	private $_table = "obat";

	public $id;
	public $name;
	public $stok;
	public $dosis;
	public $satuan;
	public $created_at;

	public function rules(){
        return [
            [
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'required'
            ],
            [
                'field' => 'stok',
                'label' => 'Stok',
                'rules' => 'required'
            ],
			[
                'field' => 'dosis',
                'label' => 'Dosis',
                'rules' => 'required'
            ],
			[
                'field' => 'satuan',
                'label' => 'Satuan',
                'rules' => 'required'
            ],
        ];
    }

	public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

	public function save()
    {
        $post = $this->input->post();
        $this->name = $post["name"];
        $this->satuan = $post["satuan"];
        $this->stok = $post["stok"];
        $this->dosis = $post["dosis"];
		$this->created_at = date('Y-m-d H:i:s');
        return $this->db->insert($this->_table, $this);
    }

	public function updateData($id)
    {
        $post = $this->input->post();
		return $this->db->update($this->_table, [
			'name' => $post['name'],
			'stok' => $post['stok'],
			'satuan' => $post['satuan'],
			'dosis' => $post['dosis'],
			'updated_at' => date('Y-m-d H:i:s')
		], array('id' => $id));
    }
	public function updateDataStok($id)
    {
        $post = $this->input->post();
		$result_stok = $this->getById($id)->penerimaan_stok + $post['stok'];
		return $this->db->update($this->_table, [
			'penerimaan_stok' => $result_stok,
			'updated_at' => date('Y-m-d H:i:s')
		], array('id' => $id));
    }

	public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }

    public function subtractStock($id, int $stock_used)
    {
        $this->db->set('stok', 'stok-'.$stock_used, FALSE);
        $this->db->where('id', $id);
        $this->db->update($this->_table);
    }

	public function stokObat(){
		$this->db->from($this->_table);
		$this->db->where('stok <', 50);
		$q = $this->db->get();
		return $q->result();
	}
}
