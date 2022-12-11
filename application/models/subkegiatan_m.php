<?php
defined('BASEPATH') or exit('No direct script access allowed');

class subkegiatan_m extends CI_Model
{

    private $_table = "subkegiatan";

    public $id_subkegiatan;
    public $id_kegiatan;
    public $kode_rekening_subkegiatan;
    public $uraian_subkegiatan;
    public $created_date;
    public $created_by;


    public function rules()
    {
        return [
            [
                'field' => 'fkode_rekening_subkegiatan',
                'label' => 'Kode rekening',
                'rules' => 'required'
            ],
            [
                'field' => 'fid_kegiatan',
                'label' => 'Program',
                'rules' => 'required'
            ],
            [
                'field' => 'furaian_subkegiatan',
                'label' => 'Uraian sub kegiatan',
                'rules' => 'required'
            ],
        ];
    }
    public function rules_update()
    {
        return [
            [
                'field' => 'fkode_rekening_subkegiatn',
                'label' => 'Kode rekening',
                'rules' => 'required'
            ],
            [
                'field' => 'fid_kegiatan',
                'label' => 'Program',
                'rules' => 'required'
            ],
            [
                'field' => 'furaian_subkegiatan',
                'label' => 'Uraian sub kegiatan',
                'rules' => 'required'
            ],
        ];
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'kegiatan.id_program = program.id_program', 'left');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'kegiatan.id_program = program.id_program', 'left');
        $this->db->where('subkegiatan.id_subkegiatan', $id);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
        // return $this->db->get_where($this->_table, ["id_subkegiatan" => $id])->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->kode_rekening_subkegiatan = $post['fkode_rekening_subkegiatan'];
        $this->id_kegiatan = $post['fid_kegiatan'];
        $this->uraian_subkegiatan = $post['furaian_subkegiatan'];
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->where('id_subkegiatan', $id);
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
