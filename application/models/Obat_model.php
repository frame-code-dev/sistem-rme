<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Obat_model extends CI_Model
{
	private $_table = "obat";

	public $id;
	public $name;
	public $stok;
	public $dosis;
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
			'dosis' => $post['dosis'],
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
}
