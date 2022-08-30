<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('detail_m');
        $this->load->model('aset_m');
        $this->load->model('permintaan_m');
    }


    public function accept($id)
    {
        $permintaan  = $this->permintaan_m;
        $aset  = $this->aset_m;
        $detail  = $this->detail_m;
        $validation = $this->form_validation;
        $validation->set_rules($detail->rules());
        if ($validation->run() == FALSE) {
            $data['aset'] = $this->aset_m->get_all_idle();
            $data['permintaan'] = $this->permintaan_m->get_by_id($id);
            $this->template->load('shared/index', 'detail/create', $data);
        } else {
            $detail->Add($id);
            $permintaan->status_done($id);
            $aset->status_used($this->input->post('fid_aset'));
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data aset berhasil disimpan!');
                redirect('permintaan', 'refresh');
            }
        }
    }
}

/* End of file Detail.php */
