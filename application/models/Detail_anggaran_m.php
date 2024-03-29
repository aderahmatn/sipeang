<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_anggaran_m extends CI_Model
{

    private $_table = "detail_anggaran";

    public $id_detail_anggaran;
    public $id_belanja;
    public $bulan;
    public $jumlah_anggaran;
    public $sisa_anggaran;
    public $id_apbd;
    public $created_date;
    public $created_by;

    public function rules_tambah_anggaran()
    {
        return [
            [
                'field' => 'fbulan',
                'label' => 'Bulan',
                'rules' => 'required'
            ],
            [
                'field' => 'fjumlah_anggaran',
                'label' => 'Jumlah Anggaran',
                'rules' => 'required'
            ],
            [
                'field' => 'fapbd',
                'label' => 'Jenis APBD',
                'rules' => 'required'
            ],

        ];
    }
    public function rules_edit_anggaran()
    {
        return [
            [
                'field' => 'fjumlah_anggaran',
                'label' => 'Jumlah Anggaran',
                'rules' => 'required'
            ],
            [
                'field' => 'fapbd',
                'label' => 'Jenis APBD',
                'rules' => 'required'
            ],
        ];
    }

    public function add()
    {
        $post = $this->input->post();
        $this->id_belanja = decrypt_url($post['fid_belanja']);
        $this->jumlah_anggaran = str_replace(".", "", $post['fjumlah_anggaran']);
        $this->sisa_anggaran = str_replace(".", "", $post['fjumlah_anggaran']);
        $this->bulan = $post['fbulan'];
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->id_apbd = $post['fapbd'];
        $this->db->insert($this->_table, $this);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->id_detail_anggaran = decrypt_url($post['fid_detail_anggaran']);
        $this->jumlah_anggaran = str_replace(".", "", $post['fjumlah_anggaran']);
        $this->sisa_anggaran = $post['fsisa_anggaran'];
        $this->bulan = $post['fbulan'];
        $this->id_belanja = decrypt_url($post['fid_belanja']);
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->id_apbd = $post['fapbd'];
        $this->db->update($this->_table, $this, array('id_detail_anggaran' => decrypt_url($post['fid_detail_anggaran'])));
    }

    public function get_all($id = null)
    {
        $this->db->select('*');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('apbd', 'apbd.id_apbd = detail_anggaran.id_apbd', 'left');
        $this->db->where('anggaran.id_belanja', $id);
        $this->db->order_by('bulan', 'asc');

        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_total_anggaran_pertahun($id = null)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->where('id_belanja', $id);
        // $this->db->where('deleted', 0);
        $query = $this->db->get($this->_table);
        return $query->row()->jumlah_anggaran;
    }
    public function get_total_all_anggaran_pertahun($tahun)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'anggaran.id_subkegiatan = subkegiatan.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'kegiatan.id_program = program.id_program', 'left');
        $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->where('anggaran.tahun_anggaran', $tahun);
        $this->db->where('anggaran.deleted', 0);
        $this->db->where('program.deleted', 0);
        $this->db->where('kegiatan.deleted', 0);
        $this->db->where('subkegiatan.deleted', 0);
        $query = $this->db->get($this->_table);
        return $query->row()->jumlah_anggaran;
    }
    public function cek_bulan($bulan, $id_belanja)
    {
        $this->db->select('*');
        $array = array('id_belanja' => $id_belanja, 'bulan' => $bulan);
        $this->db->where($array);
        $query = $this->db->get($this->_table);
        return $query->row();
    }
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('user', 'user.id_user = subkegiatan.pic_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('detail_anggaran.id_detail_anggaran', $id);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function jumlah_anggaran($id_belanja)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->where('id_belanja', $id_belanja);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_sisa_anggaran($id, $bulan)
    {
        $this->db->select_sum('sisa_anggaran');
        $this->db->where('id_belanja', $id);
        $this->db->where('bulan <', $bulan);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function jumlah_anggaran_per_subkegiatan($id_subkegiatan)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->where('subkegiatan.id_subkegiatan', $id_subkegiatan);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function jumlah_anggaran_per_subkegiatan_per_bulan($bulan, $id_subkegiatan)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->where('subkegiatan.id_subkegiatan', $id_subkegiatan);
        $this->db->where('detail_anggaran.bulan', $bulan);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function jumlah_anggaran_per_kegiatan($id_kegiatan)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->where('kegiatan.id_kegiatan', $id_kegiatan);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function jumlah_anggaran_per_kegiatan_per_bulan($bulan, $id_kegiatan)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->where('kegiatan.id_kegiatan', $id_kegiatan);
        $this->db->where('detail_anggaran.bulan', $bulan);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function jumlah_anggaran_per_program($id_program)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('program.id_program', $id_program);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function jumlah_anggaran_per_program_per_bulan($bulan, $id_program)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->join('anggaran', 'anggaran.id_belanja = detail_anggaran.id_belanja', 'left');
        $this->db->join('subkegiatan', 'subkegiatan.id_subkegiatan = anggaran.id_subkegiatan', 'left');
        $this->db->join('kegiatan', 'subkegiatan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('program', 'program.id_program = kegiatan.id_program', 'left');
        $this->db->where('program.id_program', $id_program);
        $this->db->where('detail_anggaran.bulan', $bulan);
        if ($this->session->userdata('role') == 'pptk') {
            $this->db->where('subkegiatan.pic_subkegiatan', $this->session->userdata('id_user'));
        }
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
    public function update_sisa_anggaran($id, $sisa)
    {
        $this->db->set('sisa_anggaran', $sisa);
        $this->db->where('id_detail_anggaran', $id);
        $this->db->update($this->_table);
    }
    public function jumlah_anggaran_and_sisa_anggaran($id_belanja)
    {
        $this->db->select_sum('jumlah_anggaran');
        $this->db->select_sum('sisa_anggaran');
        $this->db->where('id_belanja', $id_belanja);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file Detail_anggaran_m.php */
