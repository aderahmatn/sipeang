<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('anggaran_m');
        $this->load->model('subkegiatan_m');
        $this->load->helper('penyerapan');
        include_once APPPATH . '/third_party/fpdf/fpdf.php';
    }

    public function perencanaan($tahun)
    {
        $data['tahun'] = $tahun;
        $data['program'] = $this->anggaran_m->get_by_tahun($data['tahun']);
        $this->load->view('pdf/pdf_perencanaan', $data);
    }
}

/* End of file Pdf.php */
