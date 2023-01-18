<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyerapan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('penyerapan_m');
        $this->load->model('subkegiatan_m');
        $this->load->model('anggaran_m');
        $this->load->helper('anggaran');
    }

    public function index()
    {
        $data['subkegiatan'] = $this->subkegiatan_m->get_all();
        $this->template->load('shared/index', 'penyerapan/index', $data);
    }
    public function detail($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        if (!$data['subkegiatan']) {
            $this->session->set_flashdata('error', 'Data anggaran tidak ditemukan!');
            redirect('penyerapan', 'refresh');
        }
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        // $data['total_penyerapan'] = $this->penyerapan_m->get_total_by_subkegiatan(decrypt_url($id));
        $data['penyerapan'] = $this->penyerapan_m->get_all_by_subkegiatan(decrypt_url($id));
        $data['anggaran'] = $this->anggaran_m->get_all_by_subkegiatan_penyerapan(decrypt_url($id));
        $data['id'] = decrypt_url($id);
        // $data['total_anggaran'] = $this->anggaran_m->get_total_by_subkegiatan(decrypt_url($id));
        $this->template->load('shared/index', 'penyerapan/detail', $data);
    }
    public function create($id = null)
    {
        $anggaran = $this->anggaran_m;
        $penyerapan  = $this->penyerapan_m;
        $validation = $this->form_validation;
        $validation->set_rules($penyerapan->rules());
        if ($validation->run() == FALSE) {
            $data['error_upload'] = null;
            $data['error_penyerapan'] = null;
            $data['anggaran'] = $this->anggaran_m->get_by_id(decrypt_url($id));
            $this->template->load('shared/index', 'penyerapan/create', $data);
        } else {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 11000;
            $config['encrypt_name']            = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('flampiran')) {
                $data['error_penyerapan'] = null;
                $data['anggaran'] = $this->anggaran_m->get_by_id(decrypt_url($id));
                $data['error_upload'] = array('error' => $this->upload->display_errors());
                $this->template->load('shared/index', 'penyerapan/create', $data);
            } else {
                if (str_replace(".", "", $this->input->post('fjumlah_penyerapan')) > $this->input->post('fsisa_anggaran')) {
                    $data['anggaran'] = $this->anggaran_m->get_by_id(decrypt_url($id));
                    $data['error_upload'] = null;
                    $data['error_penyerapan'] = array('error' => 'Jumlah penyerapan melebihi anggaran.');
                    $this->template->load('shared/index', 'penyerapan/create', $data);
                } else {
                    $post = $this->input->post(null, TRUE);
                    $id_belanja = decrypt_url($this->input->post('fid_belanja'));
                    $file = $this->upload->data("file_name");
                    $anggaran->update_sisa_anggaran($id_belanja, $post);
                    $penyerapan->Add($post, $file);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data penyerapan berhasil disimpan!');
                        redirect('penyerapan', 'refresh');
                    }
                }
            }
        }
    }
    function upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 11000;
        $config['encrypt_name']            = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('flampiran')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('form_upload', $error);
        } else {
            $data['nama_berkas'] = $this->upload->data("file_name");
            $data['keterangan_berkas'] = $this->input->post('keterangan_berkas');
            $data['tipe_berkas'] = $this->upload->data('file_ext');
            $data['ukuran_berkas'] = $this->upload->data('file_size');
            $this->db->insert('tb_berkas', $data);
            redirect('upload');
        }
    }
    public function histori($id)
    {
        $data = $this->penyerapan_m->get_by_anggaran($id);
        $jml = count($data);
        if ($jml == 0) { ?>
            <div class="text-center">
                <p>Data penyerapan belum tersedia.</p>
            </div>
        <?php } else {
        ?>
            <table id="TabelUser" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Uraian</th>
                        <th>Bulan Penyerapan</th>
                        <th>PIC Penyerapan</th>
                        <th>Jumlah Penyerapan</th>
                        <th>Lampiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $key) {
                    ?>
                        <tr>
                            <td><?= strtoupper($key->uraian_belanja)  ?></td>
                            <td><?= $key->bulan_penyerapan ?></td>
                            <td><?= strtoupper($key->nama_lengkap) ?></td>
                            <td><?= rupiah($key->jumlah_penyerapan)  ?></td>
                            <td><a href="<?= base_url('uploads/') . $key->lampiran ?>" target="_blank" class="text-blue">Lihat Lampiran</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
<?php }
    }
}

/* End of file Penyerapan.php */
