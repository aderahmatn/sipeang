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
        $this->load->model('apbd_m');
        $this->load->model('anggaranupdated_m');
    }

    public function index()
    {
        $data['subkegiatan'] = $this->subkegiatan_m->get_all();
        $data['anggaran'] = $this->anggaran_m->get_all();
        $this->template->load('shared/index', 'anggaran/index', $data);
    }
    public function create($id = null)
    {
        $anggaran  = $this->anggaran_m;
        $anggaran  = $this->anggaran_m;
        $validation = $this->form_validation;
        $validation->set_rules($anggaran->rules());
        if ($validation->run() == FALSE) {
            $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
            $data['apbd'] = $this->apbd_m->get_all();
            $this->template->load('shared/index', 'anggaran/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $anggaran->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data  anggaran berhasil disimpan!');
                // redirect('anggaran', 'refresh');
                $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
                $data['anggaran'] = $this->anggaran_m->get_by_subkegiatan(decrypt_url($id));
                $data['id'] = decrypt_url($id);
                $id = $id;
                redirect('anggaran/detail/' . $id, 'refresh');
            }
        }
        // $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        // $this->template->load('shared/index', 'anggaran/create', $data);
    }
    public function detail($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        if (!$data['subkegiatan']) {
            $this->session->set_flashdata('error', 'Data anggaran tidak ditemukan!');
            redirect('anggaran', 'refresh');
        }
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        $data['anggaran'] = $this->anggaran_m->get_by_subkegiatan(decrypt_url($id));
        $data['id'] = decrypt_url($id);
        $data['total_anggaran'] = $this->anggaran_m->get_total_by_subkegiatan(decrypt_url($id));
        $this->template->load('shared/index', 'anggaran/detail', $data);
    }
    public function edit($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $anggaran = $this->anggaran_m;
        $validation = $this->form_validation;
        $validation->set_rules($anggaran->rules());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->anggaran_m->update($post);
            $this->anggaranupdated_m->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'anggaran Berhasil Diupdate!');
                redirect('anggaran', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data anggaran Tidak Diupdate!');
                redirect('anggaran', 'refresh');
            }
        }
        $data['anggaran'] = $this->anggaran_m->get_by_id(decrypt_url($id));
        if (!$data['anggaran']) {
            $this->session->set_flashdata('error', 'Data anggaran Tidak ditemukan!');
            redirect('anggaran', 'refresh');
        }
        $data['apbd'] = $this->apbd_m->get_all();
        $this->template->load('shared/index', 'anggaran/edit', $data);
    }
    public function histori($id)
    {
        $data = $this->anggaranupdated_m->get_by_anggaran($id);
        $jml = count($data);
        if ($jml == 0) { ?>
            <div class="text-center">
                <p>Riwayat belum tersedia.</p>
            </div>
        <?php } else {
        ?>
            <table id="TabelUser" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode Rekening</th>
                        <th>Uraian</th>
                        <th>Anggaran</th>
                        <th>APBD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $key) {
                    ?>
                        <tr>
                            <td><?= $key->kode_rekening_updated ?></td>
                            <td><?= $key->uraian_belanja ?></td>
                            <td><?= rupiah($key->anggaran_belanja)  ?></td>
                            <td><?= strtoupper($key->nama_apbd) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }
    }
    public function json_test($id = null)
    {
        $data['data'] = $this->anggaran_m->get_all_by_tahun($id);
        print json_encode($data);
    }
    public function detail_dashboard($id = null)
    {
        $data['data'] = $this->anggaran_m->get_by_id($id); ?>
        <div class="row py-2 bg-light">
            <div class="col-2"><strong>Program </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= $data['data']->uraian_program ?> <br></div>
        </div>
        <div class="row py-2">
            <div class="col-2"><strong>Kegiatan </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= $data['data']->uraian_kegiatan ?> <br></div>
        </div>
        <div class="row py-2 bg-light">
            <div class="col-2"><strong>Sub Kegiatan </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= $data['data']->uraian_subkegiatan ?> <br></div>
        </div>
        <div class="row py-2 ">
            <div class="col-2"><strong>PIC </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= $data['data']->nama_lengkap ?> <br></div>
        </div>
        <div class="row py-2 bg-light">
            <div class="col-2"><strong>Total Anggaran </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= rupiah($data['data']->anggaran_belanja)  ?> <br></div>
        </div>
        <!-- <div class="row py-2">
            <div class="col-2"><strong>Total Penyerapan </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= rupiah($data['data']->jumlah_penyerapan)  ?> <br></div>
        </div> -->
<?php }
}

/* End of file Anggaran.php */
