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
        if (!isset($id)) redirect('program');
        $program = $this->program_m;
        $validation = $this->form_validation;
        $validation->set_rules($program->rules_update());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->program_m->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'program Berhasil Diupdate!');
                redirect('program', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data program Tidak Diupdate!');
                redirect('program', 'refresh');
            }
        }
        $data['program'] = $this->program_m->get_by_id(decrypt_url($id));
        if (!$data['program']) {
            $this->session->set_flashdata('error', 'Data program Tidak ditemukan!');
            redirect('program', 'refresh');
        }
        $this->template->load('shared/index', 'program/edit', $data);
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
