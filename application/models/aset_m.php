<?php
defined('BASEPATH') or exit('No direct script access allowed');

class aset_m extends CI_Model
{
    private $_table = "aset";

    public $id_aset;
    public $kode_aset;
    public $nama_aset;
    public $tanggal_pembelian;
    public $supplier;
    public $deskripsi;
    public $deleted;
    public $no_urut;
    public $id_kategori;
    public $status_aset;
    public $serial_number;
    public $merk;
    public $harga_beli;
    public $site;

    public function rules()
    {
        return [
            [
                'field' => 'fnama_aset',
                'label' => 'Nama aset',
                'rules' => 'required'
            ],
            [
                'field' => 'ftgl_pembelian',
                'label' => 'Tanggal Pembelian',
                'rules' => 'required'
            ],
            [
                'field' => 'fsupplier',
                'label' => 'Supplier',
                'rules' => 'required'
            ],
            [
                'field' => 'fdeskripsi',
                'label' => 'Deskripsi aset',
                'rules' => 'required'
            ],
            [
                'field' => 'fkategori',
                'label' => 'Kategori aset',
                'rules' => 'required'
            ],
            [
                'field' => 'fserial_number',
                'label' => 'Serial Number aset',
                'rules' => 'required'
            ],
            [
                'field' => 'fmerk',
                'label' => 'Merk aset',
                'rules' => 'required'
            ],
            [
                'field' => 'fharga_beli',
                'label' => 'Harga beli',
                'rules' => 'required|numeric'
            ],
            [
                'field' => 'fsite',
                'label' => 'Site',
                'rules' => 'required'
            ],
        ];
    }
    public function get_by_dept()
    {
        $this->db->select('*');
        $this->db->join('detail_aset', 'detail_aset.id_aset = aset.id_aset', 'left');
        $this->db->join('permintaan', 'permintaan.id_permintaan = detail_aset.id_permintaan', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = permintaan.id_departemen', 'left');
        $this->db->from($this->_table);
        $this->db->where('aset.deleted', 0);
        $this->db->where('aset.status_aset !=', 'damage');
        $this->db->where('permintaan.id_departemen', $this->session->userdata('id_departemen'));
        $query = $this->db->get();
        return $query->result();
    }
    public function get_all()
    {
        $this->db->select('aset.*, kategori.*, permintaan.*, user.*, departemen.*, detail_aset.tanggal');
        $this->db->join('kategori', 'kategori.id_kategori = aset.id_kategori', 'left');
        $this->db->join('detail_aset', 'detail_aset.id_aset = aset.id_aset', 'left');
        $this->db->join('permintaan', 'permintaan.id_permintaan = detail_aset.id_permintaan', 'left');
        $this->db->join('user', 'user.id_user = permintaan.id_user', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = user.id_departemen', 'left');
        $this->db->from($this->_table);
        $this->db->where('aset.deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_all_idle()
    {
        $this->db->select('*');
        $this->db->join('kategori', 'kategori.id_kategori = aset.id_kategori');
        $this->db->from($this->_table);
        $this->db->where('aset.deleted', 0);
        $this->db->where('aset.status_aset', 'idle');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('detail_aset', 'detail_aset.id_aset = aset.id_aset', 'left');
        $this->db->join('permintaan', 'permintaan.id_permintaan = detail_aset.id_permintaan', 'left');
        $this->db->join('user', 'user.id_user = permintaan.id_user', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = user.id_departemen', 'left');
        $this->db->from($this->_table);
        $this->db->where('aset.id_aset', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->id_aset = $post['fid_aset'];
        $this->kode_aset = $post['fkode_aset'];
        $this->nama_aset = $post['fnama_aset'];
        $this->tanggal_pembelian = $post['ftgl_pembelian'];
        $this->supplier = $post['fsupplier'];
        $this->serial_number = $post['fserial_number'];
        $this->merk = $post['fmerk'];
        $this->harga_beli = $post['fharga_beli'];
        $this->site = $post['fsite'];
        $this->deskripsi = $post['fdeskripsi'];
        $this->no_urut = $this->CheckNoUrut();
        $this->id_kategori = $post['fkategori'];
        $this->status_aset = 'idle';
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_aset', $id);
        $this->db->update($this->_table);
    }
    public function damage($id)
    {
        $this->db->set('status_aset', 'damage');
        $this->db->where('id_aset', $id);
        $this->db->update($this->_table);
    }
    public function status_used($id)
    {
        $this->db->set('status_aset', 'used');
        $this->db->where('id_aset', $id);
        $this->db->update($this->_table);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->id_aset = $post['fid_aset'];
        $this->kode_aset = $post['fkode_aset'];
        $this->nama_aset = $post['fnama_aset'];
        $this->tanggal_pembelian = $post['ftgl_pembelian'];
        $this->supplier = $post['fsupplier'];
        $this->serial_number = $post['fserial_number'];
        $this->merk = $post['fmerk'];
        $this->harga_beli = $post['fharga_beli'];
        $this->site = $post['fsite'];
        $this->deskripsi = $post['fdeskripsi'];
        $this->id_kategori = $post['fkategori'];
        $this->no_urut = $post['fno'];
        $this->status_aset = $post['fstatus'];
        $this->deleted = 0;
        $this->db->update($this->_table, $this, array('id_aset' => $post['fid_aset']));
    }
    public function CheckNoUrut()
    {
        $query = $this->db->query("SELECT MAX(no_urut) as NoUrut from aset");
        $hasil = $query->row();
        $nomor = $hasil->NoUrut;
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $newnourut = $nomor + 1;
        return $newnourut;
    }
}

/* End of file aset_m.php */
