<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('kegiatan_m');
        $this->load->model('subkegiatan_m');
        $this->load->model('anggaran_m');
    }

    public function index()
    {
        $data['subkegiatan'] = $this->subkegiatan_m->get_all();
        $data['anggaran'] = $this->anggaran_m->get_all();
        $this->template->load('shared/index', 'anggaran/index', $data);
    }
    public function create($id = null)
    {
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id($id);
        $this->template->load('shared/index', 'anggaran/create', $data);

        //     if (!isset($id)) redirect('anggaran');
        //    $subkegiatan = 
    }
}

/* End of file Anggaran.php */
