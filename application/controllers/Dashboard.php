<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('anggaran_m');
        $this->load->model('penyerapan_m');
        $this->load->model('detail_anggaran_m');
        $this->load->helper('rupiah_helper');
        $this->load->helper('bulan_helper');
    }


    public function index($tahun = null)
    {
        if ($tahun == null) {
            $data['tahun'] = date('Y');
            $data['bulan'] = date('m');
            $data['total_anggaran'] = $this->detail_anggaran_m->get_total_all_anggaran_pertahun($data['tahun']);
            $data['total_penyerapan'] = $this->penyerapan_m->get_total_penyerapan($data['tahun']);
            $data['jadwal'] = $this->anggaran_m->get_jadwal_for_dashboard($data['bulan'], $data['tahun']);
            $this->template->load('shared/index', 'dashboard/index', $data);
        } else {
            $data['tahun'] = $tahun;
            $data['total_anggaran'] = $this->detail_anggaran_m->get_total_all_anggaran_pertahun($data['tahun']);
            $data['bulan'] = date('m');
            $data['jadwal'] = $this->anggaran_m->get_jadwal_for_dashboard($data['bulan'], $data['tahun']);

            $data['total_penyerapan'] = $this->penyerapan_m->get_total_penyerapan($tahun);
            $this->template->load('shared/index', 'dashboard/index', $data);
        }
    }
}

/* End of file Dashboard.php */
