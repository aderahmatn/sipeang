<?php
defined('BASEPATH') or exit('No direct script access allowed');

class anggaran_m extends CI_Model
{
    private $_table = "anggaran";

    public $id_belanja;
    public $kode_rekening_belanja;
    public $uraian_belanja;
    public $tahun_anggaran;
    public $anggaran_belanja;
    public $id_subkegiatan;
    public $created_date;
    public $created_by;
    public $id_apbd;
    public $sisa_anggaran;
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
                'field' => 'ftahun_anggaran',
                'label' => 'Tahun Anggaran',
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
    public function get_all_by_tahun($tahun)
    {
        $this->db->select('*, anggaran.id_belanja, anggaran.anggaran_belanja as anggaran_belanja_one');
        $this->db->select_sum('anggaran.anggaran_belanja');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'kegiatan.id_kegiatan = subkegiatan.id_kegiatan', 'left');
        $this->db->join('penyerapan', 'penyerapan.id_belanja = anggaran.id_belanja', 'left');
        $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        $this->db->where('anggaran.tahun_anggaran', $tahun);
        $this->db->select_sum('penyerapan.jumlah_penyerapan');
        $this->db->group_by('anggaran.id_belanja');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_all_by_subkegiatan_penyerapan($id)
    {
        $this->db->select('*');
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
        // $this->db->select_sum('penyerapan.jumlah_penyerapan');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        // $this->db->join('penyerapan', 'penyerapan.id_belanja = anggaran.id_belanja', 'left');
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
    public function get_total_anggaran($tahun)
    {
        $this->db->select_sum('anggaran_belanja');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        $this->db->where('tahun_anggaran', $tahun);
        $query = $this->db->get($this->_table);
        return $query->row()->anggaran_belanja;
    }
    public function get_sisa_anggaran($tahun)
    {
        $this->db->select_sum('sisa_anggaran');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        $this->db->where('tahun_anggaran', $tahun);
        $query = $this->db->get($this->_table);
        return $query->row()->sisa_anggaran;
    }
    public function add()
    {
        $post = $this->input->post();
        $this->kode_rekening_belanja = $post['fkode_rekening_anggaran'];
        $this->uraian_belanja = $post['furaian_anggaran'];
        $this->tahun_anggaran = $post['ftahun_anggaran'];
        $this->anggaran_belanja = str_replace(".", "", $post['fanggaran_belanja']);
        $this->id_subkegiatan = decrypt_url($post['fid_subkegiatan']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->id_apbd = $post['fjenis_apbd'];
        $this->deleted = 0;
        $this->sisa_anggaran = str_replace(".", "", $post['fanggaran_belanja']);
        $this->db->insert($this->_table, $this);
    }
    public function update_sisa_anggaran($id, $post)
    {
        $this->db->set('sisa_anggaran', $post['fsisa_anggaran'] - str_replace(".", "", $post['fjumlah_penyerapan']));
        $this->db->where('id_belanja', $id);
        $this->db->update($this->_table);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->id_belanja = decrypt_url($post['fid_anggaran']);
        $this->kode_rekening_belanja = $post['fkode_rekening_anggaran'];
        $this->uraian_belanja = $post['furaian_anggaran'];
        $this->tahun_anggaran = $post['ftahun_anggaran'];
        $this->anggaran_belanja = str_replace(".", "", $post['fanggaran_belanja']);
        $this->id_subkegiatan = decrypt_url($post['fid_subkegiatan']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->id_apbd = $post['fjenis_apbd'];
        $this->deleted = 0;
        $this->sisa_anggaran = str_replace(".", "", $post['fanggaran_belanja']);
        $this->db->update($this->_table, $this, array('id_belanja' => decrypt_url($post['fid_anggaran'])));
    }
    public function get_anggaran_laporan($tahun)
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');

        $this->db->where('anggaran.tahun_anggaran', $tahun);
        $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        $query = $this->db->get($this->_table);
        return $query->result();
    }
}

/* End of file kategori_m.php */
