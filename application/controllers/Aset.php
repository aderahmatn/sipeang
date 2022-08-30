<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('aset_m');
        $this->load->model('detail_m');
        $this->load->model('kategori_m');
        $this->load->model('perbaikan_m');
        include_once APPPATH . '/third_party/fpdf/code128.php';
    }
    public function index()
    {
        $data['aset'] = $this->aset_m->get_all();
        $this->template->load('shared/index', 'aset/index', $data);
    }
    public function create()
    {
        $aset  = $this->aset_m;
        $detail  = $this->detail_m;
        $validation = $this->form_validation;
        $validation->set_rules($aset->rules());
        if ($validation->run() == FALSE) {
            $data['kategori'] = $this->kategori_m->get_all();
            $data['no_urut'] = $this->aset_m->CheckNoUrut();
            $this->template->load('shared/index', 'aset/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $aset->Add($post);
            $detail->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data aset berhasil disimpan!');
                redirect('aset', 'refresh');
            }
        }
    }
    public function edit($id = null)
    {
        if (!isset($id)) redirect('aset');
        $aset  = $this->aset_m;
        $validation = $this->form_validation;
        $validation->set_rules($aset->rules());

        if ($validation->run() == FALSE) {
            $data['aset'] = $this->aset_m->get_by_id($id);
            $data['kategori'] = $this->kategori_m->get_all();

            if (!$data['aset']) {
                $this->session->set_flashdata('error', 'Data aset tidak ditemukan!');
                redirect('aset', 'refresh');
            }
            $this->template->load('shared/index', 'aset/edit', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $aset->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data aset berhasil diupdate!');
                redirect('aset', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data aset tidak ada yang diupdate!');
                // redirect('aset', 'refresh');
            }
        }
    }
    public function history($id)
    {
        $data['aset'] = $this->aset_m->get_by_id($id);
        $data['perbaikan'] = $this->perbaikan_m->get_by_aset($id);
        if (!$data['perbaikan']) {
            $this->session->set_flashdata('error', 'Data perbaikan tidak ditemukan!');
            redirect('aset', 'refresh');
        }
        // echo json_encode($data['perbaikan']);
        $this->template->load('shared/index', 'aset/history', $data);
    }
    public function delete($id)
    {
        $this->aset_m->Delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data aset berhasil dihapus!');
            redirect('aset', 'refresh');
        }
    }
    public function damage($id)
    {
        $this->aset_m->damage($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Status aset berhasil diupdate!');
            redirect('aset', 'refresh');
        }
    }
    public function showBarcode($code)
    {
        $data['code'] = $code;

        $this->load->view('aset/pdf_barcode', $data);
    }
    public function set_barcode($code)
    {
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');

        //generate barcode
        Zend_Barcode::render('code128', 'image', array('text' => $code, 'barHeight' => 100), array());
    }
}

/* End of file Aset.php */
