<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_nota_m extends CI_Model
{
    private $_table = "detail_nota";

    public $id_detail_nota;
    public $id_nota;
    public $id_belanja;
    public $total_anggaran;
    public $sisa_anggaran;
    public $total_pencairan;
    public $created_by;
    public $created_date;
    public $deleted;


    public function rules()
    {
        return [
            [
                'field' => 'fanggaran',
                'label' => 'Anggaran',
                'rules' => 'required'
            ],
            [
                'field' => 'fpencairan_anggaran',
                'label' => 'Pencairan anggaran',
                'rules' => 'required'
            ],

        ];
    }
    public function add()
    {
        $post = $this->input->post();
        $this->id_nota = decrypt_url($post['fid_nota']);
        $this->id_belanja = $post['fanggaran'];
        $this->total_anggaran = $post['ftotal_anggaran_h'];
        $this->sisa_anggaran = $post['fsisa_anggaran_h'];
        $this->total_pencairan = str_replace(".", "", $post['fpencairan_anggaran']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function get_by_id_nota($id_nota)
    {
        $this->db->select('*');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_nota.id_belanja', 'left');
        $this->db->where('detail_nota.id_nota', $id_nota);
        $this->db->where('detail_nota.deleted', 0);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_total_anggaran($id_nota)
    {
        $this->db->select_sum('total_anggaran');
        $this->db->where('detail_nota.id_nota', $id_nota);
        $this->db->where('detail_nota.deleted', 0);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->total_anggaran;
    }
    public function get_total_sisa_anggaran($id_nota)
    {
        $this->db->select_sum('sisa_anggaran');
        $this->db->where('detail_nota.id_nota', $id_nota);
        $this->db->where('detail_nota.deleted', 0);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->sisa_anggaran;
    }
    public function get_pencairan_anggaran($id_nota)
    {
        $this->db->select_sum('total_pencairan');
        $this->db->where('detail_nota.id_nota', $id_nota);
        $this->db->where('detail_nota.deleted', 0);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->total_pencairan;
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_detail_nota', $id);
        $this->db->update($this->_table);
    }
}

/* End of file Detail_nota_m.php */
