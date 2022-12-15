<?php
defined('BASEPATH') or exit('No direct script access allowed');

class anggaran_m extends CI_Model
{
    private $_table = "anggaran";

    public $id_belanja;
    public $kode_rekening_belanja;
    public $uraian_belanja;
    public $bulan;
    public $anggaran_belanja;
    public $id_subkegiatan;
    public $created_date;
    public $created_by;
    public $id_apbd;
    public $update_penyerapan;
    public $deleted;

    public function rules()
    {
        return [
            [
                'field' => 'fkode_rekening_anggaran',
                'label' => 'Kode Rekening',
                'rules' => 'required'
            ],
            [
                'field' => 'fbulan_anggaran',
                'label' => 'Bulan Anggaran',
                'rules' => 'required'
            ],
            [
                'field' => 'furaian_anggaran',
                'label' => 'Uraian Anggaran',
                'rules' => 'required'
            ],
            [
                'field' => 'fanggaran_belanja',
                'label' => 'Jumlah Anggaran',
                'rules' => 'required'
            ],
            [
                'field' => 'fjenis_apbd',
                'label' => 'Jenis APBD',
                'rules' => 'required'
            ],

        ];
    }
    public function get_all()
    {
        $this->db->select('*');
        return $this->db->get_where($this->_table, ["anggaran.deleted" => 0])->result();
    }
    public function get_all_by_subkegiatan_penyerapan($id)
    {
        $this->db->select('*');
        $this->db->where('anggaran.update_penyerapan', 0);
        $this->db->where('deleted', 0);
        $this->db->where('anggaran.id_subkegiatan', $id);
        $this->db->order_by('id_belanja', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('anggaran.id_belanja', $id);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_by_subkegiatan($id)
    {
        $this->db->select('*');
        $this->db->join('apbd', 'apbd.id_apbd = anggaran.id_apbd', 'left');

        $this->db->where('anggaran.id_subkegiatan', $id);
        $this->db->order_by('id_belanja', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_total_by_subkegiatan($id)
    {
        return $this->db->query('SELECT SUM(anggaran_belanja) as total_anggaran FROM anggaran WHERE id_subkegiatan = ' . $id)->row()->total_anggaran;
    }
    public function add()
    {
        $post = $this->input->post();
        $this->kode_rekening_belanja = $post['fkode_rekening_anggaran'];
        $this->uraian_belanja = $post['furaian_anggaran'];
        $this->bulan = $post['fbulan_anggaran'];
        $this->anggaran_belanja = str_replace(".", "", $post['fanggaran_belanja']);
        $this->id_subkegiatan = decrypt_url($post['fid_subkegiatan']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->id_apbd = $post['fjenis_apbd'];
        $this->deleted = 0;
        $this->update_penyerapan = 0;
        $this->db->insert($this->_table, $this);
    }
    public function update_penyerapan($id)
    {
        $this->db->set('update_penyerapan', 1);
        $this->db->where('id_belanja', $id);
        $this->db->update($this->_table);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->id_belanja = decrypt_url($post['fid_anggaran']);
        $this->kode_rekening_belanja = $post['fkode_rekening_anggaran'];
        $this->uraian_belanja = $post['furaian_anggaran'];
        $this->bulan = $post['fbulan_anggaran'];
        $this->anggaran_belanja = str_replace(".", "", $post['fanggaran_belanja']);
        $this->id_subkegiatan = decrypt_url($post['fid_subkegiatan']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->id_apbd = $post['fjenis_apbd'];
        $this->deleted = 0;
        $this->update_penyerapan = 0;
        $this->db->update($this->_table, $this, array('id_belanja' => decrypt_url($post['fid_anggaran'])));
    }
}

/* End of file kategori_m.php */
