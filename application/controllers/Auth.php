<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_m');
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->auth_m->login($post);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $params = array(
                'id_user' => $row->id_user,
                'email' => $row->email,
                'nip' => $row->nip,
                'role' => $row->role,
                'username' => $row->username,
                'nama_lengkap' => $row->nama_lengkap,
                'status' => 'login'
            );
            $this->session->set_userdata($params);
            redirect('dashboard', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'username / password salah!');
            redirect('auth/login', 'refresh');
        }
    }
    public function login()
    {
        check_already_login();
        $this->load->view('auth/login');
    }
    public function logout()
    {
        $params = array('id_user', 'role', 'status', 'username', 'nama_lengkap', 'email', 'nip');
        $this->session->unset_userdata($params);
        redirect('auth/login', 'refresh');
    }
}

/* End of file Auth.php */
