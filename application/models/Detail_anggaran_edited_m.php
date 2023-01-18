<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_anggaran_edited_m extends CI_Model
{

    private $_table = "detail_anggaran_edited";
    public $id_detail_anggaran_edited;
    public $id_detail_anggaran;
    public $jumlah_anggaran_edited;
    public $id_apbd_edited;
    public $edited_by;
    public $edited_date;

    public function add()
    {
        $post = $this->input->post();
        $this->id_detail_anggaran = decrypt_url($post['fid_detail_anggaran']);
        $this->jumlah_anggaran_edited = $post['fjumlah_anggaran_old'];
        $this->id_apbd_edited = $post['fapbd_old'];
        $this->edited_by = $post['fcreated_by'];
        $this->edited_date = $post['fcreated_date'];
        $this->db->insert($this->_table, $this);
    }

    public function get_all($id = null)
    {
        $this->db->select('*');
        $this->db->join('apbd', 'apbd.id_apbd = detail_anggaran_edited.id_apbd_edited', 'left');
        $this->db->where('id_detail_anggaran', $id);
        $this->db->order_by('id_detail_anggaran_edited', 'asc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file Detail_anggaran_edited_m.php */
