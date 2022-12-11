<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apbd extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('apbd_m');
    }

    public function index()
    {
        $data['apbd'] = $this->apbd_m->get_all();
        $this->template->load('shared/index', 'apbd/index', $data);
    }
    public function create()
    {
        $apbd  = $this->apbd_m;
        $apbd  = $this->apbd_m;
        $validation = $this->form_validation;
        $validation->set_rules($apbd->rules());
        if ($validation->run() == FALSE) {
            $data['apbd'] = $this->apbd_m->get_all();
            $this->template->load('shared/index', 'apbd/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $apbd->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data  apbd berhasil disimpan!');
                redirect('apbd', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        $this->apbd_m->Delete(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data jenis APBD berhasil dihapus!');
            redirect('apbd', 'refresh');
        }
    }
}

/* End of file Apbd.php */
