<?php
defined('BASEPATH') or exit('No direct script access allowed');

class program_m extends CI_Model
{

    private $_table = "program";

    public $id_program;
    public $kode_rekening;
    public $uraian_program;
    public $date_created;
    public $created_by;


    public function rules()
    {
        return [
            [
                'field' => 'fkode_rekening',
                'label' => 'Kode Rekening',
                'rules' => 'required'
            ],
            [
                'field' => 'furaian_program',
                'label' => 'Uraian Program',
                'rules' => 'required'
            ],
        ];
    }
    public function rules_update()
    {
        return [
            [
                'field' => 'fkode_rekening',
                'label' => 'Kode Rekening',
                'rules' => 'required'
            ],
            [
                'field' => 'furaian_program',
                'label' => 'Uraian Program',
                'rules' => 'required'
            ],
        ];
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        return $this->db->get_where($this->_table, ["id_user" => $id])->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->kode_rekening = $post['fkode_rekening'];
        $this->uraian_program = $post['furaian_program'];
        $this->date_created = $post['fdate_created'];
        $this->created_by = $post['fcreated_by'];
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->where('id_program', $id);
        $this->db->delete($this->_table);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->id_user = $post['fid_user'];
        $this->nama_lengkap = $post['fnama_user'];
        $this->email = $post['femail'];
        $this->role = $post['frole'];
        $this->username = $post['fusername'];
        $this->nip = $post['fnip'];
        $this->password = $post['fpassword'];
        $this->deleted = 0;
        $this->db->update($this->_table, $this, array('id_user' => $post['fid_user']));
    }
}

/* End of file user_m.php */
