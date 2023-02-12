<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_m extends CI_Model
{

    private $_table = "user";

    public $id_user;
    public $nama_lengkap;
    public $email;
    public $role;
    public $username;
    public $password;
    public $nip;
    public $nohp;
    public function rules()
    {
        return [
            [
                'field' => 'fnama_user',
                'label' => 'Nama Lengkap',
                'rules' => 'required'
            ],
            [
                'field' => 'femail',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ],
            [
                'field' => 'frole',
                'label' => 'Role',
                'rules' => 'required'
            ],
            [
                'field' => 'fusername',
                'label' => 'Username',
                'rules' => 'required|is_unique[user.username]'
            ],
            [
                'field' => 'fpassword',
                'label' => 'Password',
                'rules' => 'required'
            ],
            [
                'field' => 'fnohp',
                'label' => 'Nomor Telegram',
                'rules' => 'required|numeric|min_length[11]|max_length[13]'
            ],
            [
                'field' => 'fnip',
                'label' => 'NIP',
                'rules' => 'required|numeric|min_length[20]|max_length[20]'
            ],
        ];
    }
    public function rules_update()
    {
        return [
            [
                'field' => 'fnama_user',
                'label' => 'Nama Lengkap',
                'rules' => 'required'
            ],
            [
                'field' => 'femail',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ],
            [
                'field' => 'frole',
                'label' => 'Role',
                'rules' => 'required'
            ],
            [
                'field' => 'fusername',
                'label' => 'Username',
                'rules' => 'required'
            ],
            [
                'field' => 'fpassword',
                'label' => 'Password',
                'rules' => 'required'
            ],
            [
                'field' => 'fnohp',
                'label' => 'Nomor Telegram',
                'rules' => 'required|numeric|min_length[11]|max_length[13]'
            ],
            [
                'field' => 'fnip',
                'label' => 'NIP',
                'rules' => 'required|numeric|min_length[18]|max_length[20]'
            ],
        ];
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('user.deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_pptk()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('user.deleted', 0);
        $this->db->where('user.role', 'pptk');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        return $this->db->get_where($this->_table, ["id_user" => $id])->row();
    }
    public function add()
    {
        $post = $this->input->post();
        $this->id_user = uniqid('user-');
        $this->nama_lengkap = $post['fnama_user'];
        $this->email = $post['femail'];
        $this->role = $post['frole'];
        $this->username = $post['fusername'];
        $this->nohp = $post['fnohp'];
        $this->nip = $post['fnip'];
        $this->password = md5($post['fpassword']);
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function Delete($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_user', $id);
        $this->db->update($this->_table);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->id_user = $post['fid_user'];
        $this->nama_lengkap = $post['fnama_user'];
        $this->email = $post['femail'];
        $this->nohp = $post['fnohp'];
        $this->role = $post['frole'];
        $this->username = $post['fusername'];
        $this->nip = $post['fnip'];
        $this->nohp = $post['fnohp'];
        $this->password = $post['fpassword'];
        $this->deleted = 0;
        $this->db->update($this->_table, $this, array('id_user' => $post['fid_user']));
    }
}

/* End of file user_m.php */
