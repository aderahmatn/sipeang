<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_m extends CI_Model
{

    public function rules()
    {
        return [
            [
                'field' => 'ftahun_anggaran',
                'label' => 'Tahun Anggaran',
                'rules' => 'required'
            ],
            [
                'field' => 'fsubkegiatan',
                'label' => 'Subkegiatan',
                'rules' => 'required'
            ],
        ];
    }
}

/* End of file Laporan_m.php */
