<?php
defined('BASEPATH') or exit('No direct script access allowed');

class anggaranupdated_m extends CI_Model
{
    private $_table = "anggaran_updated";

    public $id_anggaran_updated;
    public $id_belanja;
    public $kode_rekening_updated;
    public $uraian_belanja;
    public $tahun_anggaran;
    public $anggaran_belanja;
    public $id_subkegiatan;
    public $created_date;
    public $created_by;
    public $id_apbd;
    public $deleted;
    // holllaaa
    public function get_all()
    {
        $this->db->select('*');

        return $this->db->get_where($this->_table, ["anggaran.deleted" => 0])->result();
    }
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('anggaran.id_belanja', $id);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_by_anggaran($id)
    {
        $this->db->select('*');
        $this->db->where('id_belanja', $id);
        $this->db->join('apbd', 'anggaran_updated.id_apbd = apbd.id_apbd', 'left');
        $this->db->order_by('id_anggaran_updated', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->id_belanja = decrypt_url($post['fid_anggaran']);
        $this->kode_rekening_updated = $post['fkode_rekening_belanja_old'];
        $this->uraian_belanja = $post['furaian_belanja_old'];
        $this->tahun_anggaran = $post['ftahun_anggaran_old'];
        $this->anggaran_belanja = $post['fanggaran_belanja_old'];
        $this->id_subkegiatan = decrypt_url($post['fid_subkegiatan']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->id_apbd = $post['fjenis_apbd_old'];
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
        $this->id_belanja = decrypt_url($post['fid_anggaran']);
        $this->kode_rekening_updated = $post['fkode_rekening_anggaran'];
        $this->uraian_belanja = $post['furaian_anggaran'];
        $this->tahun_anggaran = $post['ftahun_anggaran'];
        $this->anggaran_belanja = $post['fanggaran_belanja'];
        $this->id_subkegiatan = decrypt_url($post['fid_subkegiatan']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->id_apbd = $post['fjenis_apbd'];
        $this->deleted = 0;
        $this->db->update($this->_table, $this, array('id_belanja' => decrypt_url($post['fid_anggaran'])));
    }
}

/* End of file kategori_m.php */
