<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyerapan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('penyerapan_m');
        $this->load->model('subkegiatan_m');
        $this->load->model('anggaran_m');
    }

    public function index()
    {
        $data['subkegiatan'] = $this->subkegiatan_m->get_all();
        $this->template->load('shared/index', 'penyerapan/index', $data);
    }
    public function detail($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        if (!$data['subkegiatan']) {
            $this->session->set_flashdata('error', 'Data anggaran tidak ditemukan!');
            redirect('penyerapan', 'refresh');
        }
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        $data['total_penyerapan'] = $this->penyerapan_m->get_total_by_subkegiatan(decrypt_url($id));
        $data['penyerapan'] = $this->penyerapan_m->get_all_by_subkegiatan(decrypt_url($id));
        $data['anggaran'] = $this->anggaran_m->get_all_by_subkegiatan_penyerapan(decrypt_url($id));
        $data['id'] = decrypt_url($id);
        $data['total_anggaran'] = $this->anggaran_m->get_total_by_subkegiatan(decrypt_url($id));
        $this->template->load('shared/index', 'penyerapan/detail', $data);
    }
    public function create($id = null)
    {
        $anggaran = $this->anggaran_m;
        $penyerapan  = $this->penyerapan_m;
        $validation = $this->form_validation;
        $validation->set_rules($penyerapan->rules());
        if ($validation->run() == FALSE) {
            $data['error_upload'] = null;
            $data['anggaran'] = $this->anggaran_m->get_by_id(decrypt_url($id));
            $this->template->load('shared/index', 'penyerapan/create', $data);
        } else {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 11000;
            $config['encrypt_name']            = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('flampiran')) {
                $data['anggaran'] = $this->anggaran_m->get_by_id(decrypt_url($id));
                $data['error_upload'] = array('error' => $this->upload->display_errors());
                $this->template->load('shared/index', 'penyerapan/create', $data);
            } else {
                $post = $this->input->post(null, TRUE);
                $id_belanja = $this->input->post('fid_belanja');
                $file = $this->upload->data("file_name");
                $anggaran->update_penyerapan(decrypt_url($id_belanja));
                $penyerapan->Add($post, $file);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data penyerapan berhasil disimpan!');
                    redirect('penyerapan', 'refresh');
                }
            }
        }
    }
    function upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 11000;
        $config['encrypt_name']            = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('flampiran')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('form_upload', $error);
        } else {
            $data['nama_berkas'] = $this->upload->data("file_name");
            $data['keterangan_berkas'] = $this->input->post('keterangan_berkas');
            $data['tipe_berkas'] = $this->upload->data('file_ext');
            $data['ukuran_berkas'] = $this->upload->data('file_size');
            $this->db->insert('tb_berkas', $data);
            redirect('upload');
        }
    }
}

/* End of file Penyerapan.php */
