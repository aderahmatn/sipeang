<?php
defined('BASEPATH') or exit('No direct script access allowed');

class permintaan_m extends CI_Model
{
    private $_table = "permintaan";

    public $id_permintaan;
    public $no_permintaan;
    public $id_user;
    public $id_departemen;
    public $tanggal_permintaan;
    public $approve;
    public $status_permintaan;
    public $deskripsi_permintaan;
    public $deleted;

    public function rules()
    {
        return [
            [
                'field' => 'fdeskripsi',
                'label' => 'Deskripsi Permintaan',
                'rules' => 'required'
            ],

        ];
    }
    public function CheckNoUrut()
    {
        $query = $this->db->query("SELECT MAX(no_urut) as NoUrut from permintaan");
        $hasil = $query->row();
        $nomor = $hasil->NoUrut;
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $newnourut = $nomor + 1;
        return $newnourut;
    }
    public function get_all_approved()
    {
        $this->db->select('permintaan.*,aset.*, user.*, departemen.*');
        $this->db->join('user', 'user.id_user = permintaan.id_user');
        $this->db->join('departemen', 'departemen.id_departemen = permintaan.id_departemen', 'left');
        $this->db->join('detail_aset', 'detail_aset.id_permintaan = permintaan.id_permintaan', 'left');
        $this->db->join('aset', 'aset.id_aset = detail_aset.id_aset', 'left');
        $this->db->from($this->_table);
        $this->db->where('permintaan.deleted', 0);
        $this->db->where('permintaan.status_permintaan!=',  'hold');
        $this->db->where('permintaan.status_permintaan!=',  'reject');
        $this->db->order_by('permintaan.no_urut', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_all_by_dept($dept)
    {
        $this->db->select('permintaan.*,aset.*, user.*, departemen.*');
        $this->db->join('user', 'user.id_user = permintaan.id_user');
        $this->db->join('departemen', 'departemen.id_departemen = permintaan.id_departemen');
        $this->db->join('detail_aset', 'detail_aset.id_permintaan = permintaan.id_permintaan', 'left');
        $this->db->join('aset', 'aset.id_aset = detail_aset.id_aset', 'left');
        $this->db->from($this->_table);
        $this->db->where('permintaan.deleted', 0);
        $this->db->where('permintaan.id_departemen', $dept);
        $this->db->order_by('permintaan.no_urut', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('user', 'user.id_user = permintaan.id_user');
        $this->db->join('departemen', 'departemen.id_departemen = permintaan.id_departemen');
        $this->db->from($this->_table);
        $this->db->where('permintaan.deleted', 0);
        $this->db->where('permintaan.id_permintaan', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->id_permintaan = uniqid('req-');
        $this->no_permintaan = $post['fno_permintaan'];
        $this->id_user = $post['fid_user'];
        $this->tanggal_permintaan = $post['ftgl_permintaan'];
        $this->deskripsi_permintaan = $post['fdeskripsi'];
        $this->id_departemen = $post['fid_departemen'];
        $this->approve = 0;
        $this->status_permintaan = 'hold';
        $this->deleted = 0;
        $this->no_urut = $this->CheckNoUrut();
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_permintaan', $id);
        $this->db->update($this->_table);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->db->set('deskripsi_permintaan', $post['fdeskripsi']);
        $this->db->where('id_permintaan', $post['fid']);
        $this->db->update('permintaan');
    }
    public function approve($id)
    {
        $user = $this->session->userdata('nama_lengkap');
        $this->db->set('approve', 1);
        $this->db->set('status_permintaan', 'approved');
        $this->db->set('approve_by', $user);
        $this->db->where('id_permintaan', $id);
        $this->db->update('permintaan');
    }
    public function reject($id)
    {
        $user = $this->session->userdata('nama_lengkap');
        $this->db->set('approve', 1);
        $this->db->set('status_permintaan', 'reject');
        $this->db->set('approve_by', $user);
        $this->db->where('id_permintaan', $id);
        $this->db->update('permintaan');
    }
    public function status_done($id)
    {
        $post = $this->input->post();
        $this->db->set('status_permintaan', 'done');
        $this->db->where('id_permintaan', $id);
        $this->db->update('permintaan');
    }
}

/* End of file permintaan_m.php */
