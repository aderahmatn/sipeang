<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departemen_m extends CI_Model
{
    private $_table = "departemen";

    public $id_departemen;
    public $departemen;
    public $deleted;

    public function rules()
    {
        return [
            [
                'field' => 'fdepartemen',
                'label' => 'Nama Departemen',
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
        return $this->db->get_where($this->_table, ["id_departemen" => $id])->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->id_departemen = uniqid('dept-');
        $this->departemen = $post['fdepartemen'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_departemen', $id);
        $this->db->update($this->_table);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->id_departemen = $post['fid_departemen'];
        $this->departemen = $post['fdepartemen'];
        $this->deleted = 0;
        $this->db->update($this->_table, $this, array('id_departemen' => $post['fid_departemen']));
    }
}

/* End of file Aset_m.php */
