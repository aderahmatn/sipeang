<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('permintaan_m');
    }
    public function index()
    {
        if ($this->session->userdata('departemen') != 'IT') {
            $dept = $this->session->userdata('id_departemen');
            $data['permintaan'] = $this->permintaan_m->get_all_by_dept($dept);
            $this->template->load('shared/index', 'permintaan/index', $data);
        } else {
            $data['permintaan'] = $this->permintaan_m->get_all_approved();
            $this->template->load('shared/index', 'permintaan/index', $data);
        }
    }
    public function create()
    {
        $permintaan  = $this->permintaan_m;
        $validation = $this->form_validation;
        $validation->set_rules($permintaan->rules());
        if ($validation->run() == FALSE) {
            $data['no_urut'] = $this->permintaan_m->CheckNoUrut();
            $this->template->load('shared/index', 'permintaan/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $permintaan->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data permintaan berhasil disimpan!');
                redirect('permintaan', 'refresh');
            }
        }
    }
    public function edit($id = null)
    {
        if (!isset($id)) redirect('permintaan');
        $permintaan  = $this->permintaan_m;
        $validation = $this->form_validation;
        $validation->set_rules($permintaan->rules());

        if ($validation->run() == FALSE) {
            $data['permintaan'] = $this->permintaan_m->get_by_id($id);
            if (!$data['permintaan']) {
                $this->session->set_flashdata('error', 'Data permintaan tidak ditemukan!');
                redirect('permintaan', 'refresh');
            }
            $this->template->load('shared/index', 'permintaan/edit', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $permintaan->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data permintaan berhasil diupdate!');
                redirect('permintaan', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data permintaan tidak ada yang diupdate!');
                redirect('permintaan', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        $this->permintaan_m->Delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data permintaan berhasil dihapus!');
            redirect('permintaan', 'refresh');
        }
    }
    public function approve($id)
    {
        $this->permintaan_m->approve($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Permintaan berhasil disetujui!');
            redirect('permintaan', 'refresh');
        }
    }
    public function reject($id)
    {
        $this->permintaan_m->reject($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Permintaan berhasil direject!');
            redirect('permintaan', 'refresh');
        }
    }
}

/* End of file Permintaan.php */
