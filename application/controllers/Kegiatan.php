<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('kegiatan_m');
        $this->load->model('program_m');
    }

    public function index()
    {
        $data['kegiatan'] = $this->kegiatan_m->get_all();
        $this->template->load('shared/index', 'kegiatan/index', $data);
    }
    public function create()
    {
        $kegiatan  = $this->kegiatan_m;
        $validation = $this->form_validation;
        $validation->set_rules($kegiatan->rules());
        if ($validation->run() == FALSE) {
            $data['program'] = $this->program_m->get_all();
            $this->template->load('shared/index', 'kegiatan/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $kegiatan->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data kegiatan berhasil disimpan!');
                redirect('kegiatan', 'refresh');
            }
        }
    }
    public function add()
    {
        $this->form_validation->set_message('required', '%s Tidak Boleh Kosong!!!');
        $this->form_validation->set_message('numeric', '%s Harus Berupa Angka!!!');
        $kegiatan = $this->kegiatan_m;
        $validation = $this->form_validation;
        $validation->set_rules($kegiatan->rules());
        if ($this->form_validation->run() == FALSE) {
            $data['program'] = $this->program_m->get_all();
            $this->template->load('shared/index', 'kegiatan/index', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $this->kegiatan_m->save($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'kegiatan Berhasil Ditambahkan!');
                redirect('kegiatan/index', 'refresh');
            }
        }
    }

    public function edit($id)
    {
        if (!isset($id)) redirect('kegiatan');
        $kegiatan = $this->kegiatan_m;
        $validation = $this->form_validation;
        $validation->set_rules($kegiatan->rules_update());
        if ($this->form_validation->run()) {
            $post = $this->input->post();
            $this->kegiatan_m->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'kegiatan Berhasil Diupdate!');
                redirect('kegiatan', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data kegiatan Tidak Diupdate!');
                redirect('kegiatan', 'refresh');
            }
        }
        $data['kegiatan'] = $this->kegiatan_m->get_by_id($id);
        if (!$data['kegiatan']) {
            $this->session->set_flashdata('error', 'Data kegiatan Tidak ditemukan!');
            redirect('kegiatan', 'refresh');
        }
        $data['program'] = $this->program_m->get_all();
        $this->template->load('shared/index', 'kegiatan/edit', $data);
    }
    public function delete($id)
    {
        $this->kegiatan_m->delete(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Kegiatan Berhasil Dihapus!');
            redirect('kegiatan', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Data Kegiatan Gagal Dihapus!');
            redirect('kegiatan', 'refresh');
        }
    }
}

/* End of file User.php */
