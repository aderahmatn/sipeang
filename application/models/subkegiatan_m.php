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
    public $pic_subkegiatan;


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
            [
                'field' => 'fpic_subkegiatan',
                'label' => 'PIC sub kegiatan',
                'rules' => 'required'
            ],
        ];
    }
    public function rules_update()
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
            [
                'field' => 'fpic_subkegiatan',
                'label' => 'PIC sub kegiatan',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all()
    {
        if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'operator') {
            $this->db->select('*');
            $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
            $this->db->join('program', 'kegiatan.id_program = program.id_program', 'left');
            $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
            $this->db->where('subkegiatan.deleted', 0);
            $this->db->from($this->_table);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('*');
            $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
            $this->db->join('program', 'kegiatan.id_program = program.id_program', 'left');
            $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
            $this->db->where('subkegiatan.deleted', 0);
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
            $this->db->from($this->_table);
            $query = $this->db->get();
            return $query->result();
        }
    }
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'kegiatan.id_program = program.id_program', 'left');
        $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
        $this->db->where('subkegiatan.id_subkegiatan', $id);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
        // return $this->db->get_where($this->_table, ["id_subkegiatan" => $id])->row();
    }
    public function get_by_kegiatan($id_kegiatan)
    {
        $this->db->select('*');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'kegiatan.id_program = program.id_program', 'left');
        $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
        $this->db->where('subkegiatan.id_kegiatan', $id_kegiatan);
        $this->db->where('subkegiatan.deleted', 0);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->kode_rekening_subkegiatan = $post['fkode_rekening_subkegiatan'];
        $this->id_kegiatan = $post['fid_kegiatan'];
        $this->uraian_subkegiatan = $post['furaian_subkegiatan'];
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->pic_subkegiatan = $post['fpic_subkegiatan'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_subkegiatan', $id);
        $this->db->update($this->_table);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->id_subkegiatan = decrypt_url($post['fid_subkegiatan']);
        $this->kode_rekening_subkegiatan = $post['fkode_rekening_subkegiatan'];
        $this->id_kegiatan = $post['fid_kegiatan'];
        $this->uraian_subkegiatan = $post['furaian_subkegiatan'];
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->pic_subkegiatan = $post['fpic_subkegiatan'];
        $this->deleted = 0;
        $this->db->update($this->_table, $this, array('id_subkegiatan' => decrypt_url($post['fid_subkegiatan'])));
    }
}

/* End of file user_m.php */
