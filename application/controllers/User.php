<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('user_m');
    }

    public function index()
    {
        $data['user'] = $this->user_m->get_all();
        $this->template->load('shared/index', 'user/index', $data);
    }
    public function create()
    {
        $user  = $this->user_m;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());
        if ($validation->run() == FALSE) {
            $this->template->load('shared/index', 'user/create');
        } else {
            $post = $this->input->post(null, TRUE);
            $user->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data user berhasil disimpan!');
                redirect('user', 'refresh');
            }
        }
    }
    public function add()
    {
        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong!!!');
        $this->form_validation->set_message('numeric', '%s Harus Berupa Angka!!!');
        $MasterUser = $this->master_user_m;
        $validation = $this->form_validation;
        $validation->set_rules($MasterUser->rules());
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('shared/index', 'user/index');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->master_user_m->save($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'User Berhasil Ditambahkan!');
                redirect('user/index', 'refresh');
            }
        }
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('user');
        $user = $this->user_m;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules_update());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->user_m->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'User Berhasil Diupdate!');
                redirect('user', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data User Tidak Diupdate!');
                redirect('user', 'refresh');
            }
        }
        $data['user'] = $this->user_m->get_by_id(decrypt_url($id));
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'Data User Tidak ditemukan!');
            redirect('user', 'refresh');
        }
        $this->template->load('shared/index', 'user/edit', $data);
    }
    public function delete($id)
    {
        $this->user_m->delete(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data User Berhsil Dihapus!');
            redirect('user', 'refresh');
        }
    }
}

/* End of file User.php */
