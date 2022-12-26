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

    public function export($tahun, $id_subkegiatan)
    {
        $data["subkegiatan"] = $this->subkegiatan_m->get_all();
        $data["total_anggaran"] = $this->anggaran_m->get_total_anggaran_laporan($tahun, $id_subkegiatan);
        $data["anggaran"] = $this->anggaran_m->get_anggaran_laporan($tahun, $id_subkegiatan);
        $data['tahun'] = $tahun;
        $data['id_subkegiatan'] = $id_subkegiatan;
        $this->load->view('pdf/pdf_report', $data);
    }
}

/* End of file Pdf.php */
