<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penyerapan_m extends CI_Model
{
    private $_table = "penyerapan";

    public $id_penyerapan;
    public $id_belanja;
    public $jumlah_penyerapan;
    public $lampiran;
    public $created_date;
    public $created_by;
    public $deleted;


    public function rules()
    {
        return [
            [
                'field' => 'fjumlah_penyerapan',
                'label' => 'Jumlah penyerapan',
                'rules' => 'required'
            ],
        ];
    }

    public function add($post, $file)
    {
        $post = $this->input->post();
        $this->id_belanja = decrypt_url($post['fid_belanja']);
        $this->jumlah_penyerapan = str_replace(".", "", $post['fjumlah_penyerapan']);
        $this->lampiran = $file;
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }

    public function get_all_by_subkegiatan($id = null)
    {

        $this->db->select('*');
        $this->db->join('anggaran', 'anggaran.id_belanja = penyerapan.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->where('anggaran.id_subkegiatan', $id);
        $this->db->order_by('id_penyerapan', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_total_by_subkegiatan($id = null)
    {
        $this->db->select_sum('jumlah_penyerapan');
        $this->db->join('anggaran', 'anggaran.id_belanja = penyerapan.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->where('anggaran.id_subkegiatan', $id);
        $query = $this->db->get($this->_table);
        return $query->row()->jumlah_penyerapan;
    }
}

/* End of file penyerapan_m.php */
