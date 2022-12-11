<?php
defined('BASEPATH') or exit('No direct script access allowed');

class apbd_m extends CI_Model
{
    private $_table = "apbd";

    public $id_apbd;
    public $nama_apbd;
    public $deleted;


    public function rules()
    {
        return [
            [
                'field' => 'fnamaapbd',
                'label' => 'Jenis APBD',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all()
    {
        return $this->db->get_where($this->_table, ["deleted" => 0])->result();
    }
    public function get_by_id($id)
    {
        return $this->db->get_where($this->_table, ["id_kategori" => $id])->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->nama_apbd = $post['fnamaapbd'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_apbd', $id);
        $this->db->update($this->_table);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->db->set('kategori', $post['fkategori']);
        $this->db->where('id_kategori', $post['fid']);
        $this->db->update($this->_table);
    }
}

/* End of file kategori_m.php */
