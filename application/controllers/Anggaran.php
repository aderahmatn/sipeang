<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('kegiatan_m');
        $this->load->model('subkegiatan_m');
        $this->load->model('anggaran_m');
        $this->load->model('apbd_m');
    }

    public function index()
    {
        $data['subkegiatan'] = $this->subkegiatan_m->get_all();
        $data['anggaran'] = $this->anggaran_m->get_all();
        $this->template->load('shared/index', 'anggaran/index', $data);
    }
    public function create($id = null)
    {
        $anggaran  = $this->anggaran_m;
        $anggaran  = $this->anggaran_m;
        $validation = $this->form_validation;
        $validation->set_rules($anggaran->rules());
        if ($validation->run() == FALSE) {
            $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
            $data['apbd'] = $this->apbd_m->get_all();
            $this->template->load('shared/index', 'anggaran/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $anggaran->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data  anggaran berhasil disimpan!');
                // redirect('anggaran', 'refresh');
                $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
                $data['anggaran'] = $this->anggaran_m->get_by_subkegiatan(decrypt_url($id));
                $data['id'] = decrypt_url($id);
                $id = $id;
                redirect('anggaran/detail/' . $id, 'refresh');
            }
        }
        // $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        // $this->template->load('shared/index', 'anggaran/create', $data);
    }
    public function detail($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        if (!$data['subkegiatan']) {
            $this->session->set_flashdata('error', 'Data anggaran tidak ditemukan!');
            redirect('anggaran', 'refresh');
        }
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        $data['anggaran'] = $this->anggaran_m->get_by_subkegiatan(decrypt_url($id));
        $data['id'] = decrypt_url($id);
        $this->template->load('shared/index', 'anggaran/detail', $data);
    }
    public function edit($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $anggaran = $this->anggaran_m;
        $validation = $this->form_validation;
        $validation->set_rules($anggaran->rules());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->anggaran_m->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'anggaran Berhasil Diupdate!');
                redirect('anggaran', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data anggaran Tidak Diupdate!');
                redirect('anggaran', 'refresh');
            }
        }
        $data['anggaran'] = $this->anggaran_m->get_by_id(decrypt_url($id));
        if (!$data['anggaran']) {
            $this->session->set_flashdata('error', 'Data anggaran Tidak ditemukan!');
            redirect('anggaran', 'refresh');
        }
        $data['apbd'] = $this->apbd_m->get_all();
        $this->template->load('shared/index', 'anggaran/edit', $data);
    }
}

/* End of file Anggaran.php */
