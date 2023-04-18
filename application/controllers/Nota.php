<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('program_m');
        $this->load->model('kegiatan_m');
        $this->load->model('subkegiatan_m');
        $this->load->model('detail_anggaran_m');
        $this->load->model('nota_m');
        $this->load->model('anggaran_m');
        $this->load->model('detail_nota_m');
    }


    public function index()
    {
        $data['nota'] = $this->nota_m->get_all();
        $this->template->load('shared/index', 'nota/index', $data);
    }
    public function create()
    {
        $nota  = $this->nota_m;
        $validation = $this->form_validation;
        $validation->set_rules($nota->rules());
        if ($validation->run() == FALSE) {
            $data['nourut'] = $this->nota_m->cek_no_urut();
            $data['program'] = $this->program_m->get_all_by_pptk();
            $this->template->load('shared/index', 'nota/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $nota->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data nota berhasil disimpan!');
                redirect('nota', 'refresh');
            }
        }
    }
    public function listKegiatan($id_program)
    {
        // $id_program = $this->input->post('id_program');
        $kegiatan = $this->kegiatan_m->get_by_program($id_program);

        $lists = "<option hidden value='' selected>Pilih Kegiatan </option>";

        foreach ($kegiatan as $key) {
            $lists .= "<option value='" . $key->id_kegiatan . "'>" . strtoupper($key->uraian_kegiatan) . "</option>";
        }
        $callback = array('list_kegiatan' => $lists);
        echo json_encode($callback);
    }
    public function listSubKegiatan($id_kegiatan)
    {
        $subkegiatan = $this->subkegiatan_m->get_by_kegiatan($id_kegiatan);

        $lists = "<option hidden value='' selected>Pilih Sub Kegiatan </option>";

        foreach ($subkegiatan as $key) {
            $lists .= "<option value='" . $key->id_subkegiatan . "'>" . strtoupper($key->uraian_subkegiatan) . "</option>";
        }
        $callback = array('list_subkegiatan' => $lists);
        echo json_encode($callback);
    }

    public function delete($id)
    {
        $this->nota_m->Delete(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Nota berhasil dihapus!');
            redirect('nota', 'refresh');
        }
    }
    public function delete_detail($id_detail, $id_nota)
    {
        $this->detail_nota_m->Delete(decrypt_url($id_detail));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data detail berhasil dihapus!');
            redirect(base_url('nota/detail/') . $id_nota, 'refresh');
        }
    }
    public function detail($id = null)
    {
        $data['detail_nota'] = $this->detail_nota_m->get_by_id_nota(decrypt_url($id));
        $data['nota'] = $this->nota_m->get_by_id(decrypt_url($id));
        $data['jumlah_anggaran'] = $this->detail_nota_m->get_total_anggaran(decrypt_url($id));
        $data['sisa_anggaran'] = $this->detail_nota_m->get_total_sisa_anggaran(decrypt_url($id));
        $data['total_pencairan'] = $this->detail_nota_m->get_pencairan_anggaran(decrypt_url($id));
        $this->template->load('shared/index', 'nota/detail', $data);
    }
    public function create_detail($id = null)
    {
        $detail_nota  = $this->detail_nota_m;
        $validation = $this->form_validation;
        $validation->set_rules($detail_nota->rules());
        if ($validation->run() == FALSE) {
            $data['nota'] = $this->nota_m->get_by_id(decrypt_url($id));
            $data['anggaran'] = $this->anggaran_m->get_by_subkegiatan($data['nota']->id_subkegiatan);
            $this->template->load('shared/index', 'nota/create_detail', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $detail_nota->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data detail nota berhasil disimpan!');
                redirect(base_url('nota/detail/') . $id, 'refresh');
            }
        }
    }
    public function get_detail_anggaran($id_belanja)
    {
        $anggaran = $this->detail_anggaran_m->jumlah_anggaran_and_sisa_anggaran($id_belanja);

        echo json_encode($anggaran);
    }
    public function test()
    {
        $nourut = $this->detail_nota_m->get_total_anggaran(16);

        echo json_encode($nourut);
    }
}

/* End of file Nota.php */
