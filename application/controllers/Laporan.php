<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('penyerapan_m');
        $this->load->model('anggaran_m');
        $this->load->model('subkegiatan_m');
        $this->load->model('laporan_m');
        $this->load->helper('penyerapan');
    }
    public function index()
    {
        $laporan  = $this->laporan_m;
        $validation = $this->form_validation;
        $validation->set_rules($laporan->rules());
        if ($validation->run() == FALSE) {
            $data["tahun"] = null;
            $data["anggaran"] = null;
            $data["subkegiatan"] = $this->subkegiatan_m->get_all();
            $this->template->load('shared/index', 'laporan/index', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $data["subkegiatan"] = $this->subkegiatan_m->get_all();
            $data["total_anggaran"] = $this->anggaran_m->get_total_anggaran_laporan($post['ftahun_anggaran'], $post['fsubkegiatan']);
            $data["anggaran"] = $this->anggaran_m->get_anggaran_laporan($post['ftahun_anggaran'], $post['fsubkegiatan']);
            $data["tahun"] = $post['ftahun_anggaran'];
            $data["id_subkegiatan"] = $post['fsubkegiatan'];
            $this->template->load('shared/index', 'laporan/index', $data);
        }
    }
}

/* End of file Laporan.php */
