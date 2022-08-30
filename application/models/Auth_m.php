<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_m extends CI_Model
{

    private $_table = 'user';

    public $id_user;
    public $nama_lengkap;
    public $username;
    public $password;
    public $role;

    public function GetAll()
    {
        return $this->db->get($this->_table)->result();
    }
    public function Register()
    {
        $post = $this->input->post();
        $this->idUser = uniqid('us');
        $this->nik = $post['fnik'];
        $this->nama = $post['fnama'];
        $this->email = $post['femail'];
        $this->username = $post['fusername'];
        $this->password = md5($post['fpassword']);
        $this->role = $post['frole'];
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        return $this->db->delete($this->_table, array('idUser' => $id));
    }
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['fusername']);
        $this->db->where('password', md5($post['fpassword']));
        $query = $this->db->get();
        return $query;
    }
}

/* End of file Auth_m.php */
