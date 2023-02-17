<?php
defined('BASEPATH') or exit('No direct script access allowed');

class anggaran_m extends CI_Model
{
    private $_table = "anggaran";

    public $id_belanja;
    public $kode_rekening_belanja;
    public $uraian_belanja;
    public $tahun_anggaran;
    public $id_subkegiatan;
    public $created_date;
    public $created_by;
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

        ];
    }
    public function get_all()
    {
        $this->db->select('*');
        return $this->db->get_where($this->_table, ["anggaran.deleted" => 0])->result();
    }
    public function get_subkegiatan()
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->group_by('anggaran.id_subkegiatan');
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
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
    public function get_by_tahun($tahun)
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'kegiatan.id_kegiatan = subkegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->where('tahun_anggaran', $tahun);
        $this->db->group_by('program.id_program');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_kegiatan_by_tahun($id_program, $tahun)
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'kegiatan.id_kegiatan = subkegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->where('tahun_anggaran', $tahun);
        $this->db->where('kegiatan.id_program', $id_program);
        $this->db->group_by('kegiatan.id_kegiatan');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_subkegiatan_by_tahun($id_program, $tahun)
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'kegiatan.id_kegiatan = subkegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->where('tahun_anggaran', $tahun);
        $this->db->where('subkegiatan.id_kegiatan', $id_program);
        $this->db->group_by('subkegiatan.id_subkegiatan');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_detail_belanja_by_tahun($id, $tahun)
    {
        $this->db->select('*');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'kegiatan.id_kegiatan = subkegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->join('detail_anggaran', 'detail_anggaran.id_belanja = anggaran.id_belanja', 'left');
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->where('tahun_anggaran', $tahun);
        $this->db->where('anggaran.id_subkegiatan', $id);
        $this->db->group_by('anggaran.id_belanja');

        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->kode_rekening_belanja = $post['fkode_rekening_anggaran'];
        $this->uraian_belanja = $post['furaian_anggaran'];
        $this->tahun_anggaran = $post['ftahun_anggaran'];
        $this->id_subkegiatan = decrypt_url($post['fid_subkegiatan']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->deleted = 0;
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
        $this->id_subkegiatan = decrypt_url($post['fid_subkegiatan']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->deleted = 0;
        $this->db->update($this->_table, $this, array('id_belanja' => decrypt_url($post['fid_anggaran'])));
    }
    public function get_anggaran_laporan($tahun, $id_subkegiatan)
    {
        $this->db->select('*');
        // $this->db->select_sum('anggaran.anggaran_belanja');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'kegiatan.id_program = program.id_program', 'left');
        $this->db->where('anggaran.tahun_anggaran', $tahun);
        $this->db->where('anggaran.id_subkegiatan', $id_subkegiatan);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $query = $this->db->get($this->_table);
        return $query->result();
    }
    public function get_total_anggaran_laporan($tahun, $id_subkegiatan)
    {
        $this->db->select('*');
        $this->db->select_sum('anggaran.anggaran_belanja');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'kegiatan.id_program = program.id_program', 'left');
        $this->db->where('anggaran.tahun_anggaran', $tahun);
        $this->db->where('anggaran.id_subkegiatan', $id_subkegiatan);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $query = $this->db->get($this->_table);
        return $query->row()->anggaran_belanja;
    }
}

/* End of file kategori_m.php */
