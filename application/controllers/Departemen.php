<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departemen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('departemen_m');
    }
    public function index()
    {
        $data['departemen'] = $this->departemen_m->get_all();
        $this->template->load('shared/index', 'departemen/index', $data);
    }
    public function create()
    {
        $departemen  = $this->departemen_m;
        $validation = $this->form_validation;
        $validation->set_rules($departemen->rules());
        if ($validation->run() == FALSE) {
            $this->template->load('shared/index', 'departemen/create');
        } else {
            $post = $this->input->post(null, TRUE);
            $departemen->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data departemen berhasil disimpan!');
                redirect('departemen', 'refresh');
            }
        }
    }
    public function edit($id = null)
    {
        if (!isset($id)) redirect('departemen');
        $departemen  = $this->departemen_m;
        $validation = $this->form_validation;
        $validation->set_rules($departemen->rules());

        if ($validation->run() == FALSE) {
            $data['departemen'] = $this->departemen_m->get_by_id($id);
            if (!$data['departemen']) {
                $this->session->set_flashdata('error', 'Data departemen tidak ditemukan!');
                redirect('departemen', 'refresh');
            }
            $this->template->load('shared/index', 'departemen/edit', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $departemen->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data departemen berhasil diupdate!');
                redirect('departemen', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data departemen tidak ada yang diupdate!');
                redirect('departemen', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        $this->departemen_m->Delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data departemen berhasil dihapus!');
            redirect('departemen', 'refresh');
        }
    }
}

/* End of file Departemen.php */
