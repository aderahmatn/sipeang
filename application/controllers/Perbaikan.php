<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perbaikan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('perbaikan_m');
        $this->load->model('aset_m');
    }

    public function index()
    {
        if ($this->session->userdata('departemen') != 'IT') {
            $data['perbaikan'] = $this->perbaikan_m->get_all_by_dept($this->session->userdata('departemen'));
            $this->template->load('shared/index', 'perbaikan/index', $data);
        } else {
            $data['perbaikan'] = $this->perbaikan_m->get_all();
            $this->template->load('shared/index', 'perbaikan/index', $data);
        }
    }
    public function create()
    {
        $perbaikan  = $this->perbaikan_m;
        $validation = $this->form_validation;
        $validation->set_rules($perbaikan->rules());
        if ($validation->run() == FALSE) {
            $data['aset'] = $this->aset_m->get_by_dept();
            $this->template->load('shared/index', 'perbaikan/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $perbaikan->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data perbaikan berhasil disimpan!');
                redirect('perbaikan', 'refresh');
            }
        }
    }
    public function edit($id = null)
    {
        if (!isset($id)) redirect('perbaikan');
        $perbaikan  = $this->perbaikan_m;
        $validation = $this->form_validation;
        $validation->set_rules($perbaikan->rules());

        if ($validation->run() == FALSE) {
            $data['aset'] = $this->aset_m->get_by_dept();
            $data['perbaikan'] = $this->perbaikan_m->get_by_id($id);
            if (!$data['perbaikan']) {
                $this->session->set_flashdata('error', 'Data perbaikan tidak ditemukan!');
                redirect('perbaikan', 'refresh');
            }
            $this->template->load('shared/index', 'perbaikan/edit', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $perbaikan->update($id);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data perbaikan berhasil diupdate!');
                redirect('perbaikan', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data perbaikan tidak ada yang diupdate!');
                redirect('perbaikan', 'refresh');
            }
        }
    }
    public function tindakan($id = null)
    {
        if (!isset($id)) redirect('perbaikan');
        $perbaikan  = $this->perbaikan_m;
        $validation = $this->form_validation;
        $validation->set_rules($perbaikan->rules_tindakan());

        if ($validation->run() == FALSE) {
            $data['aset'] = $this->aset_m->get_by_dept();
            $data['perbaikan'] = $this->perbaikan_m->get_by_id($id);
            if (!$data['perbaikan']) {
                $this->session->set_flashdata('error', 'Data perbaikan tidak ditemukan!');
                redirect('perbaikan', 'refresh');
            }
            $this->template->load('shared/index', 'perbaikan/tindakan', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $perbaikan->tindakan($id);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data perbaikan berhasil diupdate!');
                redirect('perbaikan', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data perbaikan tidak ada yang diupdate!');
                redirect('perbaikan', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        $this->perbaikan_m->Delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data perbaikan berhasil dihapus!');
            redirect('perbaikan', 'refresh');
        }
    }
}

/* End of file Perbaikan.php */
