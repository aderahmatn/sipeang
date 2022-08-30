<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran extends CI_Controller
{

    public function index()
    {
        $this->template->load('shared/index', 'anggaran/index');
    }
}

/* End of file Anggaran.php */
