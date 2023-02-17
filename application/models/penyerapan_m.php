<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penyerapan_m extends CI_Model
{
    private $_table = "penyerapan";
    private $_table_detail = "detail_anggaran";

    public $id_penyerapan;
    public $id_detail_anggaran;
    public $jumlah_penyerapan;
    public $lampiran;
    public $created_date;
    public $tanggal_penyerapan;
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
            [
                'field' => 'ftgl_penyerapan',
                'label' => 'Tanggal penyerapan',
                'rules' => 'required'
            ],
        ];
    }
    public function rules_laporan()
    {
        return [
            [
                'field' => 'ftgl_awal',
                'label' => 'Tanggal Awal',
                'rules' => 'required'
            ],
            [
                'field' => 'ftgl_akhir',
                'label' => 'Tanggal Akhir',
                'rules' => 'required'
            ],
        ];
    }

    public function get_by_date_range($tgl_awal, $tgl_akhir)
    {
        $this->db->select('*');
        $this->db->join('penyerapan', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->join('user', 'user.nip = penyerapan.created_by', 'left');
        $this->db->where('tanggal_penyerapan >=', $tgl_awal);
        $this->db->where('tanggal_penyerapan <=', $tgl_akhir);
        $this->db->order_by('penyerapan.created_date', 'desc');
        $this->db->group_by('program.id_program', 'desc');
        $this->db->from($this->_table_detail);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_kegiatan_by_date_range($tgl_awal, $tgl_akhir, $id_program)
    {
        $this->db->select('*');
        // $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('penyerapan', 'penyerapan.id_detail_anggaran = detail_anggaran.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('program.id_program', $id_program);
        $this->db->where('tanggal_penyerapan >=', $tgl_awal);
        $this->db->where('tanggal_penyerapan <=', $tgl_akhir);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->group_by('kegiatan.id_kegiatan', 'desc');
        $this->db->from($this->_table_detail);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_subkegiatan_by_date_range($tgl_awal, $tgl_akhir, $id_kegiatan)
    {
        $this->db->select('*');
        // $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->join('penyerapan', 'penyerapan.id_detail_anggaran = detail_anggaran.id_detail_anggaran', 'left');
        $this->db->where('kegiatan.id_kegiatan', $id_kegiatan);
        $this->db->where('tanggal_penyerapan >=', $tgl_awal);
        $this->db->where('tanggal_penyerapan <=', $tgl_akhir);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->group_by('subkegiatan.id_subkegiatan', 'desc');
        $this->db->from($this->_table_detail);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_detail_by_date_range($tgl_awal, $tgl_akhir, $id_subkegiatan)
    {
        $this->db->select('*');
        // $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('penyerapan', 'penyerapan.id_detail_anggaran = detail_anggaran.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('subkegiatan.id_subkegiatan', $id_subkegiatan);
        $this->db->where('tanggal_penyerapan >=', $tgl_awal);
        $this->db->where('tanggal_penyerapan <=', $tgl_akhir);
        $this->db->from($this->_table_detail);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_total_by_range($tgl_awal, $tgl_akhir, $id_detail_anggaran)
    {
        $this->db->select_sum('jumlah_penyerapan');
        $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('detail_anggaran.id_detail_anggaran', $id_detail_anggaran);
        $this->db->where('tanggal_penyerapan >=', $tgl_awal);
        $this->db->where('tanggal_penyerapan <=', $tgl_akhir);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->jumlah_penyerapan;
    }
    public function get_total_by_range_by_subkegiatan($tgl_awal, $tgl_akhir, $id_subkegiatan)
    {
        $this->db->select_sum('jumlah_penyerapan');
        $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('subkegiatan.id_subkegiatan', $id_subkegiatan);
        $this->db->where('tanggal_penyerapan >=', $tgl_awal);
        $this->db->where('tanggal_penyerapan <=', $tgl_akhir);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->jumlah_penyerapan;
    }
    public function get_total_by_range_by_kegiatan($tgl_awal, $tgl_akhir, $id_kegiatan)
    {
        $this->db->select_sum('jumlah_penyerapan');
        $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('kegiatan.id_kegiatan', $id_kegiatan);
        $this->db->where('tanggal_penyerapan >=', $tgl_awal);
        $this->db->where('tanggal_penyerapan <=', $tgl_akhir);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->jumlah_penyerapan;
    }
    public function get_total_by_range_by_program($tgl_awal, $tgl_akhir, $id_program)
    {
        $this->db->select_sum('jumlah_penyerapan');
        $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('program.id_program', $id_program);
        $this->db->where('tanggal_penyerapan >=', $tgl_awal);
        $this->db->where('tanggal_penyerapan <=', $tgl_akhir);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->jumlah_penyerapan;
    }
    public function add($post, $file)
    {
        $post = $this->input->post();
        $this->id_detail_anggaran = decrypt_url($post['fid_detail_anggaran']);
        $this->tanggal_penyerapan = $post['ftgl_penyerapan'];
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
        $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_detail_anggaran', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->where('anggaran.id_subkegiatan', $id);
        $this->db->order_by('id_penyerapan', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_anggaran($id = null)
    {
        $this->db->select('*');
        $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('user', 'user.nip = penyerapan.created_by', 'left');
        $this->db->where('detail_anggaran.id_belanja', $id);
        $this->db->order_by('penyerapan.created_date', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_total_by_id_belanja($id = null)
    {
        $this->db->select_sum('jumlah_penyerapan');
        $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->where('anggaran.id_belanja', $id);
        $query = $this->db->get($this->_table);
        return $query->row()->jumlah_penyerapan;
    }
    public function get_total_penyerapan($tahun)
    {
        $this->db->select_sum('jumlah_penyerapan');
        $this->db->join('detail_anggaran', 'detail_anggaran.id_detail_anggaran = penyerapan.id_detail_anggaran', 'left');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->where('anggaran.tahun_anggaran', $tahun);
        $query = $this->db->get($this->_table);
        return $query->row()->jumlah_penyerapan;
    }
    public function get_penyerapan_laporan($id_belanja, $bulan)
    {
        $this->db->select('jumlah_penyerapan');
        $this->db->where('id_belanja', $id_belanja);
        $this->db->where('bulan_penyerapan', $bulan);
        $query = $this->db->get($this->_table);
        $data = $query->row();
        if (!$data) {
            return "";
        } else {
            return $query->row()->jumlah_penyerapan;
        }
    }
    public function get_total_penyerapan_perbulan($bulan, $id_subkegiatan)
    {
        $this->db->select_sum('jumlah_penyerapan');
        $this->db->join('anggaran', 'anggaran.id_belanja = penyerapan.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        $this->db->where('subkegiatan.id_subkegiatan', $id_subkegiatan);
        $this->db->where('penyerapan.bulan_penyerapan', $bulan);
        $query = $this->db->get($this->_table);
        return $query->row()->jumlah_penyerapan;
    }
    public function cek_bulan_penyerapan($id_detail_anggaran)
    {
        $this->db->select('*');
        $this->db->where('id_detail_anggaran', $id_detail_anggaran);
        $query = $this->db->get($this->_table);
        return $query->row();
    }
}

/* End of file penyerapan_m.php */
