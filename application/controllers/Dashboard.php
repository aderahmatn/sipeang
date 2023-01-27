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
    }


    public function index($tahun = null)
    {
        if ($tahun == null) {
            $data['tahun'] = date('Y');
            $data['total_anggaran'] = $this->detail_anggaran_m->get_total_all_anggaran_pertahun($data['tahun']);
            // $data['anggaran'] = $this->anggaran_m->get_all_by_tahun($data['tahun']);
            // $data['total_anggaran'] = $this->anggaran_m->get_total_anggaran($data['tahun']);
            $data['total_penyerapan'] = $this->penyerapan_m->get_total_penyerapan($data['tahun']);
            // $data['sisa_anggaran'] = $this->anggaran_m->get_sisa_anggaran($data['tahun']);
            $this->template->load('shared/index', 'dashboard/index', $data);
        } else {
            $data['tahun'] = $tahun;
            $data['total_anggaran'] = $this->detail_anggaran_m->get_total_all_anggaran_pertahun($data['tahun']);
            // $data['total_anggaran'] = $this->anggaran_m->get_total_anggaran($tahun);
            // $data['anggaran'] = $this->anggaran_m->get_all_by_tahun($tahun);
            $data['total_penyerapan'] = $this->penyerapan_m->get_total_penyerapan($tahun);
            // $data['sisa_anggaran'] = $this->anggaran_m->get_sisa_anggaran($tahun);
            $this->template->load('shared/index', 'dashboard/index', $data);
        }
    }
}

/* End of file Dashboard.php */
