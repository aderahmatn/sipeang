<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('detail_nota_m');
        $this->load->model('nota_m');
        include_once APPPATH . '/third_party/fpdf/fpdf.php';
    }
    public function pdf($id)
    {
        $data['detail_nota'] = $this->detail_nota_m->get_by_id_nota(decrypt_url($id));
        $data['nota'] = $this->nota_m->get_by_id(decrypt_url($id));
        $data['jumlah_anggaran'] = $this->detail_nota_m->get_total_anggaran(decrypt_url($id));
        $data['sisa_anggaran'] = $this->detail_nota_m->get_total_sisa_anggaran(decrypt_url($id));
        $data['total_pencairan'] = $this->detail_nota_m->get_pencairan_anggaran(decrypt_url($id));
        $this->load->view('nota/nota_pdf', $data);
    }
}

/* End of file Export.php */
