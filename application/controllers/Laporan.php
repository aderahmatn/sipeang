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
        $this->load->helper('penyerapan');
    }


    public function index()
    {
        // $data['penyerapan'] = $this->penyerapan_m->get_penyerapan_laporan(18, "2023-02");
        $data['anggaran'] = $this->anggaran_m->get_anggaran_laporan(2023);
        $this->template->load('shared/index', 'laporan/index', $data);
    }
}

/* End of file Laporan.php */
