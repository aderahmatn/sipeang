<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kegiatan_m extends CI_Model
{

    private $_table = "kegiatan";

    public $id_kegiatan;
    public $id_program;
    public $kode_rekening_kegiatan;
    public $uraian_kegiatan;
    public $created_date;
    public $created_by;
    public $deleted;

    // asasa?
    public function rules()
    {
        return [
            [
                'field' => 'fkode_rekening',
                'label' => 'Kode rekening',
                'rules' => 'required'
            ],
            [
                'field' => 'fid_program',
                'label' => 'Program',
                'rules' => 'required'
            ],
            [
                'field' => 'furaian_kegiatan',
                'label' => 'Uraian kegiatan',
                'rules' => 'required'
            ],
        ];
    }
    public function rules_update()
    {
        return [
            [
                'field' => 'fkode_rekening',
                'label' => 'Kode rekening',
                'rules' => 'required'
            ],
            [
                'field' => 'fid_program',
                'label' => 'Program',
                'rules' => 'required'
            ],
            [
                'field' => 'furaian_kegiatan',
                'label' => 'Uraian kegiatan',
                'rules' => 'required'
            ],

        ];
    }

    public function get_all()
    {
        $this->db->select('*, kegiatan.kode_rekening_kegiatan');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('kegiatan.deleted', 0);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_program($id_program)
    {
        $this->db->select('*');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->where('kegiatan.deleted', 0);
        $this->db->where('kegiatan.id_program', $id_program);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->group_by('kegiatan.uraian_kegiatan');

        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        return $this->db->get_where($this->_table, ["id_kegiatan" => $id])->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->kode_rekening_kegiatan = $post['fkode_rekening'];
        $this->id_program = $post['fid_program'];
        $this->uraian_kegiatan = $post['furaian_kegiatan'];
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_kegiatan', $id);
        $this->db->update($this->_table);
    }
    // ?\asa
    public function update($post)
    {
        $post = $this->input->post();
        $this->id_kegiatan = $post['fid_kegiatan'];
        $this->kode_rekening_kegiatan = $post['fkode_rekening'];
        $this->id_program = $post['fid_program'];
        $this->uraian_kegiatan = $post['furaian_kegiatan'];
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->deleted = 0;
        $this->db->update($this->_table, $this, array('id_kegiatan' => $post['fid_kegiatan']));
    }
}

/* End of file user_m.php */
