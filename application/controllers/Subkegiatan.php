<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkegiatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('kegiatan_m');
        $this->load->model('subkegiatan_m');
        $this->load->model('user_m');
    }

    public function index()
    {
        $data['subkegiatan'] = $this->subkegiatan_m->get_all();
        $this->template->load('shared/index', 'subkegiatan/index', $data);
    }
    public function create()
    {
        $subkegiatan  = $this->subkegiatan_m;
        $validation = $this->form_validation;
        $validation->set_rules($subkegiatan->rules());
        if ($validation->run() == FALSE) {
            $data['kegiatan'] = $this->kegiatan_m->get_all();
            $data['user'] = $this->user_m->get_all();
            $this->template->load('shared/index', 'subkegiatan/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $subkegiatan->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data sub kegiatan berhasil disimpan!');
                redirect('subkegiatan', 'refresh');
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
            $data['program'] = $this->kegiatan_m->get_all();
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

    public function edit($id = null)
    {
        if (!isset($id)) redirect('subkegiatan');
        $subkegiatan = $this->subkegiatan_m;
        $validation = $this->form_validation;
        $validation->set_rules($subkegiatan->rules_update());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->subkegiatan_m->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'subkegiatan Berhasil Diupdate!');
                redirect('subkegiatan', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data subkegiatan Tidak Diupdate!');
                redirect('subkegiatan', 'refresh');
            }
        }
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        if (!$data['subkegiatan']) {
            $this->session->set_flashdata('error', 'Data subkegiatan Tidak ditemukan!');
            redirect('subkegiatan', 'refresh');
        }
        $data['kegiatan'] = $this->kegiatan_m->get_all();
        $data['user'] = $this->user_m->get_all();
        $this->template->load('shared/index', 'subkegiatan/edit', $data);
    }
    public function delete($id)
    {
        $this->subkegiatan_m->delete(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Sub Kegiaran Berhasil Dihapus!');
            redirect('subkegiatan', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Data Sub Kegiaran Gagal Dihapus!');
            redirect('subkegiatan', 'refresh');
        }
    }
}

/* End of file User.php */
