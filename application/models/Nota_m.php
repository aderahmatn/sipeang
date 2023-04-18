<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota_m extends CI_Model
{

    private $_table = "nota";

    public $id_nota;
    public $no_urut;
    public $nomor_nota;
    public $id_subkegiatan;
    public $created_date;
    public $created_by;
    public $deleted;
    public $tahun_anggaran_nota;
    public $nomor_dpa;

    public function rules()
    {
        return [
            [
                'field' => 'fnomorNPD',
                'label' => 'Nomor NPD',
                'rules' => 'required'
            ],
            [
                'field' => 'fprogram',
                'label' => 'Program',
                'rules' => 'required'
            ],
            [
                'field' => 'fkegiatan',
                'label' => 'Kegiatan',
                'rules' => 'required'
            ],
            [
                'field' => 'fsubkegiatan',
                'label' => 'Subkegiatan',
                'rules' => 'required'
            ],
            [
                'field' => 'ftahun_anggaran_nota',
                'label' => 'Tahun Anggaran',
                'rules' => 'required|numeric'
            ],
            [
                'field' => 'fnomor_dpa',
                'label' => 'Nomor DPA',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all()
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = nota.id_subkegiatan', 'left');
        $this->db->where('nota.deleted', 0);

        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = nota.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->join('user', 'subkegiatan.pic_subkegiatan = user.id_user', 'left');
        $this->db->where('nota.deleted', 0);
        $this->db->where('nota.id_nota', $id);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->nomor_nota = $post['fnourut'] . $post['fnomorNPD'];
        $this->no_urut = $this->cek_no_urut();
        $this->id_subkegiatan = $post['fsubkegiatan'];
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->tahun_anggaran_nota = $post['ftahun_anggaran_nota'];
        $this->nomor_dpa = $post['fnomor_dpa'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_nota', $id);
        $this->db->update($this->_table);
    }

    public function cek_no_urut()
    {
        $this->db->select('no_urut');
        $this->db->order_by('no_urut', 'desc');
        $this->db->limit(1);
        $this->db->from($this->_table);
        $query = $this->db->get();
        if ($query->row() == null) {
            return 1;
        } else {
            $nourut = $query->row()->no_urut;
            $nourut++;
            return $nourut;
        }
    }
}

/* End of file Nota_m.php */
