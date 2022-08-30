<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('program_m');
    }

    public function index()
    {
        $data['program'] = $this->program_m->get_all();
        $this->template->load('shared/index', 'program/index', $data);
    }
    public function create()
    {
        $program  = $this->program_m;
        $validation = $this->form_validation;
        $validation->set_rules($program->rules());
        if ($validation->run() == FALSE) {
            $this->template->load('shared/index', 'program/create');
        } else {
            $post = $this->input->post(null, TRUE);
            $program->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data program berhasil disimpan!');
                redirect('program', 'refresh');
            }
        }
    }
    public function add()
    {
        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong!!!');
        $this->form_validation->set_message('numeric', '%s Harus Berupa Angka!!!');
        $program = $this->program_m;
        $validation = $this->form_validation;
        $validation->set_rules($program->rules());
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('shared/index', 'program/index');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->program_m->save($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Program Berhasil Ditambahkan!');
                redirect('program/index', 'refresh');
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
        $data['user'] = $this->user_m->get_by_id($id);
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'Data User Tidak ditemukan!');
            redirect('user', 'refresh');
        }
        $this->template->load('shared/index', 'user/edit', $data);
    }
    public function delete($id)
    {
        $this->program_m->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Program Berhsil Dihapus!');
            redirect('program', 'refresh');
        }
    }
}

/* End of file User.php */
