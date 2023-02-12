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
        $this->load->helper('anggaran');
    }


    public function perencanaan($tahun = null)
    {
        if ($tahun == null) {
            $data['tahun'] = date('Y');
            $data['program'] = $this->anggaran_m->get_by_tahun($data['tahun']);
            $this->template->load('shared/index', 'laporan/perencanaan', $data);
        } else {
            $data['tahun'] = $tahun;
            $data['program'] = $this->anggaran_m->get_by_tahun($data['tahun']);
            $this->template->load('shared/index', 'laporan/perencanaan', $data);
        }
    }
    public function penyerapan()
    {

        $penyerapan  = $this->penyerapan_m;
        $validation = $this->form_validation;
        $validation->set_rules($penyerapan->rules_laporan());
        if ($validation->run() == FALSE) {
            $data['tgl_awal'] = null;
            $data['tgl_akhir'] = null;
            $data['tes'] = null;
            $data['penyerapan'] = null;
            $this->template->load('shared/index', 'laporan/penyerapan', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $data['tgl_awal'] = $post['ftgl_awal'];
            $data['tgl_akhir'] = $post['ftgl_akhir'];
            $data['tes'] = 'ada';
            $data['penyerapan'] = $this->penyerapan_m->get_by_date_range($post['ftgl_awal'], $post['ftgl_akhir']);
            $this->template->load('shared/index', 'laporan/penyerapan', $data);
        }
    }
}

/* End of file Laporan.php */
