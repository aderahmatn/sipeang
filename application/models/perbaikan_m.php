<?php
defined('BASEPATH') or exit('No direct script access allowed');

class perbaikan_m extends CI_Model
{

    private $_table = "perbaikan";

    public $id_perbaikan;
    public $id_aset;
    public $id_user;
    public $tanggal_perbaikan;
    public $status_perbaikan;
    public $tanggal_close;
    public $keterangan_perbaikan;
    public $tindakan_perbaikan;
    public $pic_perbaikan;
    public $deleted;

    public function rules()
    {
        return [
            [
                'field' => 'fid_aset',
                'label' => 'Aset',
                'rules' => 'required'
            ],
            [
                'field' => 'fketerangan_perbaikan',
                'label' => 'Keterangan',
                'rules' => 'required'
            ],
        ];
    }
    public function rules_tindakan()
    {
        return [
            [
                'field' => 'ftindakan',
                'label' => 'Tindakan Perbaikan',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all_by_dept($dept)
    {
        $this->db->select('*');
        $this->db->join('user', 'user.id_user = perbaikan.id_user');
        $this->db->join('departemen', 'departemen.id_departemen = user.id_departemen');
        $this->db->join('aset', 'aset.id_aset = perbaikan.id_aset', 'left');
        $this->db->from($this->_table);
        $this->db->where('perbaikan.deleted', 0);
        $this->db->where('departemen.departemen', $dept);
        $this->db->order_by('perbaikan.tanggal_perbaikan', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_all()
    {
        $this->db->select('*');
        $this->db->join('user', 'user.id_user = perbaikan.id_user');
        $this->db->join('departemen', 'departemen.id_departemen = user.id_departemen');
        $this->db->join('aset', 'aset.id_aset = perbaikan.id_aset', 'left');
        $this->db->from($this->_table);
        $this->db->where('perbaikan.deleted', 0);
        $this->db->order_by('perbaikan.tanggal_perbaikan', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('user', 'user.id_user = perbaikan.id_user');
        $this->db->join('departemen', 'departemen.id_departemen = user.id_departemen');
        $this->db->join('aset', 'aset.id_aset = perbaikan.id_aset', 'left');
        $this->db->from($this->_table);
        $this->db->where('perbaikan.deleted', 0);
        $this->db->where('perbaikan.id_perbaikan', $id);
        $this->db->order_by('perbaikan.tanggal_perbaikan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->id_perbaikan = uniqid('pbk-');
        $this->id_aset = $post['fid_aset'];
        $this->id_user = $this->session->userdata('id_user');
        $this->tanggal_perbaikan = date('Y-m-d');
        $this->status_perbaikan = 'open';
        $this->keterangan_perbaikan = $post['fketerangan_perbaikan'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_perbaikan', $id);
        $this->db->update($this->_table);
    }
    public function update($id)
    {
        $post = $this->input->post();
        $this->db->set('id_aset', $post['fid_aset']);
        $this->db->set('keterangan_perbaikan', $post['fketerangan_perbaikan']);
        $this->db->where('id_perbaikan', $id);
        $this->db->update($this->_table);
    }
    public function tindakan($id)
    {
        $post = $this->input->post();
        $this->db->set('tindakan_perbaikan', $post['ftindakan']);
        $this->db->set('status_perbaikan', 'close');
        $this->db->set('tanggal_close', date('Y-m-d'));
        $this->db->set('pic_perbaikan', $this->session->userdata('nama_lengkap'));
        $this->db->where('id_perbaikan', $id);
        $this->db->update($this->_table);
    }
    public function get_by_aset($id)
    {
        $this->db->select('*');
        $this->db->join('user', 'user.id_user = perbaikan.id_user');
        $this->db->join('departemen', 'departemen.id_departemen = user.id_departemen');
        $this->db->join('aset', 'aset.id_aset = perbaikan.id_aset', 'left');
        $this->db->from($this->_table);
        $this->db->where('perbaikan.deleted', 0);
        $this->db->where('perbaikan.id_aset', $id);
        $this->db->order_by('perbaikan.tanggal_perbaikan', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file perbaikan_m.php */
