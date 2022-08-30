<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('kategori_m');
    }
    public function index()
    {
        $data['kategori'] = $this->kategori_m->get_all();
        $this->template->load('shared/index', 'kategori/index', $data);
    }
    public function create()
    {
        $kategori  = $this->kategori_m;
        $validation = $this->form_validation;
        $validation->set_rules($kategori->rules());
        if ($validation->run() == FALSE) {
            $this->template->load('shared/index', 'kategori/create');
        } else {
            $post = $this->input->post(null, TRUE);
            $kategori->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data kategori berhasil disimpan!');
                redirect('kategori', 'refresh');
            }
        }
    }
    public function edit($id = null)
    {
        if (!isset($id)) redirect('alat');
        $kategori  = $this->kategori_m;
        $validation = $this->form_validation;
        $validation->set_rules($kategori->rules());

        if ($validation->run() == FALSE) {
            $data['kategori'] = $this->kategori_m->get_by_id($id);
            if (!$data['kategori']) {
                $this->session->set_flashdata('error', 'Data kategori tidak ditemukan!');
                redirect('kategori', 'refresh');
            }
            $this->template->load('shared/index', 'kategori/edit', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $kategori->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data kategori berhasil diupdate!');
                redirect('kategori', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data kategori tidak ada yang diupdate!');
                redirect('kategori', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        $this->kategori_m->Delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data kategori berhasil dihapus!');
            redirect('kategori', 'refresh');
        }
    }
}

/* End of file Kategori.php */
